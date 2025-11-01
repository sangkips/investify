#!/bin/bash

set -e

echo "🔐 Setting up HashiCorp Vault for Laravel secrets..."

# Deploy Vault
echo "📦 Deploying Vault..."
kubectl apply -f k8s/vault-setup.yaml

# Wait for Vault to be ready
echo "⏳ Waiting for Vault to be ready..."
kubectl wait --namespace vault \
  --for=condition=ready pod \
  --selector=app=vault \
  --timeout=300s

# Port forward to access Vault (run in background)
echo "🔌 Setting up port forward to Vault..."
kubectl port-forward -n vault svc/vault 8200:8200 &
VAULT_PF_PID=$!

# Wait a moment for port forward to establish
sleep 5

# Set Vault environment variables
export VAULT_ADDR="http://127.0.0.1:8200"
export VAULT_TOKEN="root"

# Install vault CLI if not present
if ! command -v vault &> /dev/null; then
    echo "📦 Installing Vault CLI..."
    wget -O- https://apt.releases.hashicorp.com/gpg | sudo gpg --dearmor -o /usr/share/keyrings/hashicorp-archive-keyring.gpg
    echo "deb [signed-by=/usr/share/keyrings/hashicorp-archive-keyring.gpg] https://apt.releases.hashicorp.com $(lsb_release -cs) main" | sudo tee /etc/apt/sources.list.d/hashicorp.list
    sudo apt update && sudo apt install vault
fi

# Wait for Vault to be accessible
echo "⏳ Waiting for Vault API to be accessible..."
for i in {1..30}; do
    if vault status &>/dev/null; then
        break
    fi
    echo "Waiting for Vault... ($i/30)"
    sleep 2
done

# Enable KV secrets engine (ignore if already exists)
echo "🔧 Configuring Vault..."
vault secrets enable -path=secret kv-v2 2>/dev/null || echo "KV secrets engine already enabled"

# Enable Kubernetes auth (ignore if already exists)
vault auth enable kubernetes 2>/dev/null || echo "Kubernetes auth already enabled"

# Configure Kubernetes auth
echo "🔐 Configuring Kubernetes authentication..."

# Create a service account token secret for Vault (needed for newer K8s versions)
kubectl apply -f - <<EOF
apiVersion: v1
kind: Secret
metadata:
  name: vault-token-secret
  namespace: vault
  annotations:
    kubernetes.io/service-account.name: vault
type: kubernetes.io/service-account-token
EOF

# Wait for the token to be created
sleep 5

# Get the token and configure Vault
TOKEN_REVIEW_JWT=$(kubectl get secret vault-token-secret -n vault -o jsonpath='{.data.token}' | base64 --decode)
KUBE_CA_CERT=$(kubectl config view --raw --minify --flatten -o jsonpath='{.clusters[].cluster.certificate-authority-data}' | base64 --decode)

vault write auth/kubernetes/config \
    token_reviewer_jwt="$TOKEN_REVIEW_JWT" \
    kubernetes_host="https://kubernetes.default.svc.cluster.local" \
    kubernetes_ca_cert="$KUBE_CA_CERT"

# Create policy for Laravel app
echo "📝 Creating Laravel policy..."
vault policy write laravel-policy - <<EOF
path "secret/data/laravel/*" {
  capabilities = ["read"]
}
EOF

# Create Kubernetes role
echo "👤 Creating Kubernetes role..."
vault write auth/kubernetes/role/laravel-app \
    bound_service_account_names=laravel-chart \
    bound_service_account_namespaces=laravel-app \
    policies=laravel-policy \
    ttl=24h

# Create Laravel secrets
echo "🔑 Creating Laravel secrets..."
vault kv put secret/laravel/config \
    app-key="base64:$(openssl rand -base64 32)" \
    db-host="laravel-chart-postgresql" \
    db-database="laravel" \
    db-username="laravel" \
    db-password="$(openssl rand -base64 32)" \
    redis-host="laravel-chart-redis" \
    redis-password="$(openssl rand -base64 32)" \
    mail-username="your-email@gmail.com" \
    mail-password="your-app-password" \
    mail-from-address="noreply@investify.com"

# Kill the port forward
kill $VAULT_PF_PID 2>/dev/null || true

# Install Helm if not present
if ! command -v helm &> /dev/null; then
    echo "📦 Installing Helm..."
    curl https://raw.githubusercontent.com/helm/helm/main/scripts/get-helm-3 | bash
fi

# Deploy Vault Secrets Operator using Helm
echo "🔄 Installing Vault Secrets Operator..."
helm repo add hashicorp https://helm.releases.hashicorp.com 2>/dev/null || true
helm repo update

# Install the operator with CRDs
helm upgrade --install vault-secrets-operator hashicorp/vault-secrets-operator \
    --namespace vault-secrets-operator-system \
    --create-namespace \
    --version "0.4.3" \
    --wait

# Wait for CRDs to be available
echo "⏳ Waiting for Vault Secrets Operator CRDs..."
for i in {1..30}; do
    if kubectl get crd vaultstaticsecrets.secrets.hashicorp.com &>/dev/null; then
        echo "✅ CRDs are ready"
        break
    fi
    echo "Waiting for CRDs... ($i/30)"
    sleep 2
done

# Now deploy the Vault resources
echo "🔄 Deploying Vault connection and secrets..."
kubectl apply -f k8s/vault-secrets-operator.yaml

echo "✅ Vault setup complete!"
echo ""
echo "📋 Vault Information:"
echo "===================="
echo "🌐 Vault URL: http://vault.vault.svc.cluster.local:8200"
echo "🔑 Root Token: root"
echo "📁 Secrets Path: secret/laravel/config"
echo ""
echo "🔧 To access Vault UI externally:"
echo "kubectl port-forward -n vault svc/vault 8200:8200"
echo "Then visit: http://localhost:8200"