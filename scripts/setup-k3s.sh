#!/bin/bash

set -e

echo "🚀 Setting up k3s cluster for Laravel deployment..."

# Install k3s with proper permissions
echo "📦 Installing k3s..."
curl -sfL https://get.k3s.io | INSTALL_K3S_EXEC="--disable traefik --write-kubeconfig-mode 644" sh -

# Wait for k3s to be ready
echo "⏳ Waiting for k3s to be ready..."
sudo k3s kubectl wait --for=condition=Ready nodes --all --timeout=300s

# Set up kubeconfig for regular user
echo "🔧 Setting up kubeconfig..."
mkdir -p ~/.kube
sudo cp /etc/rancher/k3s/k3s.yaml ~/.kube/config
sudo chown $(id -u):$(id -g) ~/.kube/config
export KUBECONFIG=~/.kube/config

# Add to bashrc for persistence
echo 'export KUBECONFIG=~/.kube/config' >> ~/.bashrc

# Install Helm
echo "📦 Installing Helm..."
curl https://raw.githubusercontent.com/helm/helm/main/scripts/get-helm-3 | bash

# Install nginx-ingress
echo "🌐 Installing NGINX Ingress Controller..."
kubectl apply -f https://raw.githubusercontent.com/kubernetes/ingress-nginx/controller-v1.8.2/deploy/static/provider/cloud/deploy.yaml

# Wait for nginx-ingress to be ready
echo "⏳ Waiting for NGINX Ingress Controller..."
kubectl wait --namespace ingress-nginx \
  --for=condition=ready pod \
  --selector=app.kubernetes.io/component=controller \
  --timeout=300s

# Install cert-manager
echo "🔒 Installing cert-manager..."
kubectl apply -f https://github.com/cert-manager/cert-manager/releases/download/v1.13.2/cert-manager.yaml

# Wait for cert-manager to be ready
echo "⏳ Waiting for cert-manager..."
kubectl wait --namespace cert-manager \
  --for=condition=ready pod \
  --selector=app.kubernetes.io/instance=cert-manager \
  --timeout=300s

# Install ArgoCD
echo "🔄 Installing ArgoCD..."
kubectl create namespace argocd --dry-run=client -o yaml | kubectl apply -f -
kubectl apply -n argocd -f https://raw.githubusercontent.com/argoproj/argo-cd/stable/manifests/install.yaml

# Wait for ArgoCD to be ready
echo "⏳ Waiting for ArgoCD..."
kubectl wait --namespace argocd \
  --for=condition=ready pod \
  --selector=app.kubernetes.io/name=argocd-server \
  --timeout=300s

# Create ArgoCD ingress
echo "🌐 Creating ArgoCD ingress..."
cat <<EOF | kubectl apply -f -
apiVersion: networking.k8s.io/v1
kind: Ingress
metadata:
  name: argocd-server-ingress
  namespace: argocd
  annotations:
    nginx.ingress.kubernetes.io/ssl-redirect: "true"
    nginx.ingress.kubernetes.io/backend-protocol: "GRPC"
    cert-manager.io/cluster-issuer: "letsencrypt-prod"
spec:
  ingressClassName: nginx
  tls:
  - hosts:
    - argocd.autoscaleops.com
    secretName: argocd-tls
  rules:
  - host: argocd.autoscaleops.com
    http:
      paths:
      - path: /
        pathType: Prefix
        backend:
          service:
            name: argocd-server
            port:
              number: 443
EOF

# Create Let's Encrypt ClusterIssuer
echo "🔒 Creating Let's Encrypt ClusterIssuer..."
cat <<EOF | kubectl apply -f -
apiVersion: cert-manager.io/v1
kind: ClusterIssuer
metadata:
  name: letsencrypt-prod
spec:
  acme:
    server: https://acme-v02.api.letsencrypt.org/directory
    email: admin@autoscaleops.com
    privateKeySecretRef:
      name: letsencrypt-prod
    solvers:
    - http01:
        ingress:
          class: nginx
EOF

# Get ArgoCD admin password
echo "🔑 Getting ArgoCD admin password..."
ARGOCD_PASSWORD=$(kubectl -n argocd get secret argocd-initial-admin-secret -o jsonpath="{.data.password}" | base64 -d)

echo "✅ k3s setup complete!"
echo ""
echo "📋 Important Information:"
echo "========================"
echo "🔧 Kubeconfig: ~/.kube/config"
echo "🌐 ArgoCD URL: https://argocd.autoscaleops.com"
echo "👤 ArgoCD Username: admin"
echo "🔑 ArgoCD Password: $ARGOCD_PASSWORD"
echo ""
echo "🚀 Next steps:"
echo "1. Set up Vault secrets"
echo "2. Deploy the Laravel application via ArgoCD"
echo "3. Configure DNS for your domains"