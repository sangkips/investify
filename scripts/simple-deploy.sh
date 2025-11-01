#!/bin/bash

echo "🚀 Simple Laravel Deployment (No Vault/ArgoCD complexity)"
echo "========================================================"

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

print_step() {
    echo -e "${BLUE}📋 $1${NC}"
}

print_success() {
    echo -e "${GREEN}✅ $1${NC}"
}

print_warning() {
    echo -e "${YELLOW}⚠️  $1${NC}"
}

print_error() {
    echo -e "${RED}❌ $1${NC}"
}

# Function to run commands with error handling
run_command() {
    if ! "$@"; then
        print_error "Failed to execute: $*"
        print_warning "Continuing with deployment..."
        return 1
    fi
    return 0
}

# Step 1: Setup k3s if not already installed
print_step "Checking k3s installation..."
if ! command -v k3s &> /dev/null; then
    print_step "Installing k3s..."
    curl -sfL https://get.k3s.io | INSTALL_K3S_EXEC="--disable traefik --write-kubeconfig-mode 644" sh -
    
    # Set up kubeconfig
    mkdir -p ~/.kube
    sudo cp /etc/rancher/k3s/k3s.yaml ~/.kube/config
    sudo chown $(id -u):$(id -g) ~/.kube/config
    export KUBECONFIG=~/.kube/config
    echo 'export KUBECONFIG=~/.kube/config' >> ~/.bashrc
    
    print_success "k3s installed successfully"
else
    print_warning "k3s already installed"
    # Ensure kubeconfig is set up
    if [ ! -f ~/.kube/config ]; then
        mkdir -p ~/.kube
        sudo cp /etc/rancher/k3s/k3s.yaml ~/.kube/config 2>/dev/null || true
        sudo chown $(id -u):$(id -g) ~/.kube/config 2>/dev/null || true
    fi
    export KUBECONFIG=~/.kube/config
fi

# Wait for k3s to be ready
print_step "Waiting for k3s to be ready..."
for i in {1..30}; do
    if kubectl get nodes &>/dev/null; then
        print_success "k3s is ready"
        break
    fi
    echo "Waiting for k3s... ($i/30)"
    sleep 2
done

# Step 2: Install NGINX Ingress
print_step "Installing NGINX Ingress Controller..."
if ! kubectl get namespace ingress-nginx &>/dev/null; then
    kubectl apply -f https://raw.githubusercontent.com/kubernetes/ingress-nginx/controller-v1.8.2/deploy/static/provider/cloud/deploy.yaml
    
    print_step "Waiting for NGINX Ingress Controller..."
    kubectl wait --namespace ingress-nginx \
      --for=condition=ready pod \
      --selector=app.kubernetes.io/component=controller \
      --timeout=300s || print_warning "NGINX Ingress may still be starting"
else
    print_warning "NGINX Ingress already installed"
fi

# Step 3: Install cert-manager
print_step "Installing cert-manager..."
if ! kubectl get namespace cert-manager &>/dev/null; then
    kubectl apply -f https://github.com/cert-manager/cert-manager/releases/download/v1.13.2/cert-manager.yaml
    
    print_step "Waiting for cert-manager..."
    kubectl wait --namespace cert-manager \
      --for=condition=ready pod \
      --selector=app.kubernetes.io/instance=cert-manager \
      --timeout=300s || print_warning "cert-manager may still be starting"
else
    print_warning "cert-manager already installed"
fi

# Step 4: Create Let's Encrypt ClusterIssuer
print_step "Creating Let's Encrypt ClusterIssuer..."
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

# Step 5: Create Laravel namespace
print_step "Creating Laravel namespace..."
kubectl create namespace laravel-app --dry-run=client -o yaml | kubectl apply -f -

# Step 6: Build Docker image locally (if Docker is available)
print_step "Building Laravel Docker image..."
if command -v docker &> /dev/null; then
    if docker build -t laravel-app:latest . ; then
        print_success "Docker image built successfully"
        
        # Import image into k3s
        docker save laravel-app:latest | sudo k3s ctr images import -
        print_success "Image imported into k3s"
    else
        print_error "Failed to build Docker image"
        print_warning "You may need to build and push to a registry manually"
    fi
else
    print_warning "Docker not available, skipping image build"
fi

# Step 7: Create secrets
print_step "Creating Laravel secrets..."
cat <<EOF | kubectl apply -f -
apiVersion: v1
kind: Secret
metadata:
  name: laravel-secrets
  namespace: laravel-app
type: Opaque
data:
  app-key: $(echo -n "base64:$(openssl rand -base64 32)" | base64 -w 0)
  db-host: $(echo -n "postgresql" | base64 -w 0)
  db-database: $(echo -n "laravel" | base64 -w 0)
  db-username: $(echo -n "laravel" | base64 -w 0)
  db-password: $(echo -n "$(openssl rand -base64 32)" | base64 -w 0)
  redis-host: $(echo -n "redis" | base64 -w 0)
  redis-password: $(echo -n "$(openssl rand -base64 32)" | base64 -w 0)
  mail-username: $(echo -n "your-email@gmail.com" | base64 -w 0)
  mail-password: $(echo -n "your-app-password" | base64 -w 0)
  mail-from-address: $(echo -n "noreply@investify.com" | base64 -w 0)
EOF

# Step 8: Deploy using Helm
print_step "Deploying Laravel application with Helm..."
if command -v helm &> /dev/null; then
    # Update image configuration to use local image
    sed -i 's/pullPolicy: IfNotPresent/pullPolicy: Never/' helm/laravel-chart/values.yaml
    sed -i 's/repository: sangkips\/laravel-app/repository: laravel-app/' helm/laravel-chart/values.yaml
    
    # Deploy with Helm
    helm upgrade --install laravel-chart ./helm/laravel-chart \
      --namespace laravel-app \
      --create-namespace \
      --wait \
      --timeout 10m || print_warning "Helm deployment may have issues, check manually"
else
    print_step "Installing Helm..."
    curl https://raw.githubusercontent.com/helm/helm/main/scripts/get-helm-3 | bash
    
    # Deploy with Helm
    helm upgrade --install laravel-chart ./helm/laravel-chart \
      --namespace laravel-app \
      --create-namespace \
      --wait \
      --timeout 10m || print_warning "Helm deployment may have issues, check manually"
fi

# Step 9: Check deployment status
print_step "Checking deployment status..."
kubectl get pods -n laravel-app
kubectl get services -n laravel-app
kubectl get ingress -n laravel-app

echo ""
print_success "🎉 Simple deployment complete!"
echo ""
echo "📋 Access Information:"
echo "====================="
echo "🌐 Laravel App: https://investify.autoscaleops.com"
echo "   (Wait a few minutes for SSL certificate)"
echo ""
echo "📊 Useful Commands:"
echo "=================="
echo "kubectl get pods -n laravel-app"
echo "kubectl logs -f deployment/laravel-chart -n laravel-app"
echo "kubectl describe ingress -n laravel-app"
echo ""
print_warning "Make sure your DNS points investify.autoscaleops.com to this server's IP"