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

# Enable KV secrets engine
echo "🔧 Configuring Vault..."
vault secrets enable -path=secret kv-v2

# Enable Kubernetes auth
vault auth enable kubernetes

# Configure Kubernetes auth
echo "🔐 Configuring Kubernetes authentication..."
vault write auth/kubernetes/config \
    token_reviewer_jwt="$(kubectl get secret -n vault $(kubectl get serviceaccount -n vault vault -o jsonpath='{.secrets[0].name}') -o jsonpath='{.data.token}' | base64 --decode)" \
    kubernetes_host="https://kubernetes.default.svc.cluster.local" \
    kubernetes_ca_cert="$(kubectl config view --raw --minify --flatten -o jsonpath='{.clusters[].cluster.certificate-authority-data}' | base64 --decode)"

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

# Deploy Vault Secrets Operator
echo "🔄 Deploying Vault Secrets Operator..."
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