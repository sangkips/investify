# VPS Deployment Setup Guide

This guide walks you through deploying your Laravel application on a VPS using k3s, ArgoCD, and HashiCorp Vault.

## 🖥️ Prerequisites

### VPS Requirements
- **OS**: Ubuntu 20.04+ or similar Linux distribution
- **RAM**: Minimum 4GB (8GB recommended)
- **CPU**: Minimum 2 cores (4 cores recommended)
- **Storage**: Minimum 40GB SSD
- **Network**: Public IP address with ports 80, 443, and 22 open

### Domain Requirements
- Domain name pointing to your VPS IP address
- Subdomains configured:
  - `investify.autoscaleops.com` → Your VPS IP
  - `argocd.autoscaleops.com` → Your VPS IP
  - `vault.autoscaleops.com` → Your VPS IP

## 🚀 Step-by-Step Deployment

### Step 1: Connect to Your VPS

```bash
# SSH into your VPS (replace with your actual IP and username)
ssh root@your-vps-ip
# or
ssh ubuntu@your-vps-ip
```

### Step 2: Initial VPS Setup

```bash
# Update system packages
sudo apt update && sudo apt upgrade -y

# Install essential packages
sudo apt install -y curl wget git unzip software-properties-common

# Create a non-root user (if not already done)
sudo adduser laravel
sudo usermod -aG sudo laravel
sudo su - laravel
```

### Step 3: Clone Repository on VPS

```bash
# Clone your repository
git clone https://github.com/sangkips/investify.git
cd investify

# Make scripts executable
chmod +x scripts/*.sh
```

### Step 4: Run Complete Setup

```bash
# This will install everything: k3s, ArgoCD, Vault, and deploy your app
./scripts/deploy-complete.sh
```

**What this script does:**
- Installs k3s (lightweight Kubernetes)
- Sets up NGINX Ingress Controller
- Installs cert-manager for SSL certificates
- Deploys ArgoCD for GitOps
- Sets up HashiCorp Vault for secrets
- Deploys PostgreSQL and Redis
- Configures your Laravel application

### Step 5: Configure GitHub Repository Secrets

After the VPS setup completes, you need to configure GitHub secrets for CI/CD:

```bash
# On your VPS, get the kubeconfig (base64 encoded)
cat ~/.kube/config | base64 -w 0
```

**Add these secrets to your GitHub repository** (Settings → Secrets and variables → Actions):

| Secret Name | Value | Description |
|-------------|-------|-------------|
| `DOCKER_USERNAME` | your-dockerhub-username | Docker Hub username |
| `DOCKER_PASSWORD` | your-dockerhub-token | Docker Hub access token |
| `KUBE_CONFIG` | base64-encoded-kubeconfig | Output from command above |
| `ARGOCD_SERVER` | argocd.autoscaleops.com | ArgoCD server URL |
| `ARGOCD_USERNAME` | admin | ArgoCD username |
| `ARGOCD_PASSWORD` | your-argocd-password | From setup script output |

### Step 6: Verify Deployment

```bash
# Check if all pods are running
kubectl get pods -n laravel-app

# Check services
kubectl get services -n laravel-app

# Check ingress
kubectl get ingress -n laravel-app

# View application logs
kubectl logs -f deployment/laravel-chart -n laravel-app
```

## 🔧 Post-Deployment Configuration

### Update Vault Secrets

```bash
# Port forward to access Vault
kubectl port-forward -n vault svc/vault 8200:8200 &

# Set environment variables
export VAULT_ADDR="http://127.0.0.1:8200"
export VAULT_TOKEN="root"

# Update secrets with your actual values
vault kv put secret/laravel/config \
    app-key="base64:$(php artisan key:generate --show)" \
    db-host="laravel-chart-postgresql" \
    db-database="laravel" \
    db-username="laravel" \
    db-password="your-secure-database-password" \
    redis-host="laravel-chart-redis" \
    redis-password="your-secure-redis-password" \
    mail-username="your-email@gmail.com" \
    mail-password="your-gmail-app-password" \
    mail-from-address="noreply@investify.com"
```

### Configure SSL Certificates

The setup automatically configures Let's Encrypt certificates. Verify they're working:

```bash
# Check certificate status
kubectl get certificates -n laravel-app
kubectl describe certificate investify-tls -n laravel-app
```

## 🌐 Access Your Applications

After successful deployment:

- **Laravel Application**: https://investify.autoscaleops.com
- **ArgoCD Dashboard**: https://argocd.autoscaleops.com
- **Vault UI**: https://vault.autoscaleops.com

## 🔄 CI/CD Workflow

Once GitHub secrets are configured:

1. **Push code** to your `main` branch
2. **GitHub Actions** automatically:
   - Runs tests
   - Builds Docker image
   - Pushes to Docker Hub
   - Updates Helm chart
   - Triggers ArgoCD sync
3. **ArgoCD** deploys the new version to your cluster

## 🛠️ Troubleshooting

### Common Issues

**1. Pods not starting:**
```bash
kubectl describe pod <pod-name> -n laravel-app
kubectl logs <pod-name> -n laravel-app
```

**2. SSL certificate issues:**
```bash
kubectl logs -n cert-manager deployment/cert-manager
kubectl get challenges -n laravel-app
```

**3. Database connection issues:**
```bash
kubectl logs deployment/laravel-chart-postgresql -n laravel-app
kubectl exec -it deployment/laravel-chart-postgresql -n laravel-app -- psql -U laravel -d laravel
```

### Useful Commands

```bash
# Restart deployment
kubectl rollout restart deployment/laravel-chart -n laravel-app

# Scale application
kubectl scale deployment laravel-chart --replicas=3 -n laravel-app

# Check resource usage
kubectl top pods -n laravel-app
kubectl top nodes

# Access ArgoCD CLI
kubectl port-forward -n argocd svc/argocd-server 8080:443
```

## 🔐 Security Recommendations

1. **Change default passwords** immediately after setup
2. **Enable firewall** and restrict unnecessary ports
3. **Regular updates** of all components
4. **Backup** your data regularly
5. **Monitor** logs and metrics

## 📞 Support

If you encounter issues:
1. Check the troubleshooting section above
2. Review logs using the provided commands
3. Ensure DNS records are properly configured
4. Verify all secrets are correctly set in GitHub

## 🎯 Next Steps

After successful deployment:
1. Set up monitoring (Prometheus/Grafana)
2. Configure log aggregation
3. Implement backup strategies
4. Set up alerting
5. Performance optimization