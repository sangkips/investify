#!/bin/bash

set -e

echo "🚀 Complete Laravel Deployment Setup"
echo "===================================="

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

# Check if running as root
if [[ $EUID -eq 0 ]]; then
   print_error "This script should not be run as root"
   exit 1
fi

# Update system
print_step "Updating system packages..."
sudo apt update && sudo apt upgrade -y

# Install required packages
print_step "Installing required packages..."
sudo apt install -y curl wget git unzip software-properties-common apt-transport-https ca-certificates gnupg lsb-release

# Step 1: Setup k3s
print_step "Setting up k3s cluster..."
if ! command -v k3s &> /dev/null; then
    ./scripts/setup-k3s.sh
    print_success "k3s cluster setup complete"
else
    print_warning "k3s already installed, skipping..."
fi

# Step 2: Setup Vault
print_step "Setting up HashiCorp Vault..."
./scripts/setup-vault.sh
print_success "Vault setup complete"

# Step 3: Create namespace for Laravel app
print_step "Creating Laravel application namespace..."
kubectl create namespace laravel-app --dry-run=client -o yaml | kubectl apply -f -

# Step 4: Deploy ArgoCD application
print_step "Deploying ArgoCD application..."
kubectl apply -f argocd/application.yaml

# Step 5: Wait for application to sync
print_step "Waiting for ArgoCD to sync the application..."
sleep 30

# Check ArgoCD application status
print_step "Checking ArgoCD application status..."
kubectl get applications -n argocd

# Step 6: Get service information
print_step "Getting service information..."
kubectl get services -n laravel-app
kubectl get ingress -n laravel-app

# Step 7: Display important information
echo ""
echo -e "${GREEN}🎉 Deployment Complete!${NC}"
echo "========================"
echo ""
echo "📋 Access Information:"
echo "====================="

# Get ArgoCD password
ARGOCD_PASSWORD=$(kubectl -n argocd get secret argocd-initial-admin-secret -o jsonpath="{.data.password}" | base64 -d 2>/dev/null || echo "Not available")
echo "🔄 ArgoCD:"
echo "   URL: https://argocd.autoscaleops.com"
echo "   Username: admin"
echo "   Password: $ARGOCD_PASSWORD"
echo ""

echo "🔐 Vault:"
echo "   URL: https://vault.autoscaleops.com"
echo "   Root Token: root"
echo ""

echo "🌐 Laravel App:"
echo "   URL: https://investify.autoscaleops.com"
echo ""

echo "📊 Monitoring Commands:"
echo "======================"
echo "kubectl get pods -n laravel-app"
echo "kubectl get services -n laravel-app"
echo "kubectl get ingress -n laravel-app"
echo "kubectl logs -f deployment/laravel-chart -n laravel-app"
echo ""

echo "🔧 Useful Commands:"
echo "=================="
echo "# Port forward to Vault:"
echo "kubectl port-forward -n vault svc/vault 8200:8200"
echo ""
echo "# Port forward to ArgoCD:"
echo "kubectl port-forward -n argocd svc/argocd-server 8080:443"
echo ""
echo "# Check application logs:"
echo "kubectl logs -f -l app.kubernetes.io/name=laravel-chart -n laravel-app"
echo ""

print_warning "Don't forget to:"
print_warning "1. Configure your DNS records to point to your server IP"
print_warning "2. Update Vault secrets with your actual credentials"
print_warning "3. Set up GitHub repository secrets for CI/CD"

echo ""
print_success "Setup completed successfully! 🎉"