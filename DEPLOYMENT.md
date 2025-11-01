# Laravel VPS Deployment with k3s, ArgoCD, and HashiCorp Vault

This guide provides a complete deployment setup for your Laravel application using modern DevOps practices.

## 🏗️ Architecture Overview

```
┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐
│   GitHub        │    │   Docker Hub    │    │   VPS Server    │
│   Repository    │────│   Registry      │────│   k3s Cluster   │
└─────────────────┘    └─────────────────┘    └─────────────────┘
                                                       │
                       ┌─────────────────────────────────┼─────────────────────────────────┐
                       │                                 │                                 │
                ┌──────▼──────┐                   ┌──────▼──────┐                 ┌──────▼──────┐
                │   ArgoCD    │                   │    Vault    │                 │   Laravel   │
                │  (GitOps)   │                   │ (Secrets)   │                 │    App      │
                └─────────────┘                   └─────────────┘                 └─────────────┘
                                                                                         │
                                                  ┌─────────────────────────────────────┼─────────────────────────────────┐
                                                  │                                     │                                 │
                                           ┌──────▼──────┐                      ┌──────▼──────┐                 ┌──────▼──────┐
                                           │ PostgreSQL  │                      │    Redis    │                 │   Ingress   │
                                           │ Database    │                      │   Cache     │                 │   (NGINX)   │
                                           └─────────────┘                      └─────────────┘                 └─────────────┘
```

## 🚀 Quick Start

### Prerequisites

- Ubuntu 20.04+ VPS with at least 4GB RAM and 2 CPU cores
- Domain name pointing to your VPS IP
- Docker Hub account
- GitHub repository

### 1. Clone and Setup

```bash
git clone https://github.com/sangkips/investify.git
cd investify
chmod +x scripts/*.sh
```

### 2. Complete Deployment

```bash
./scripts/deploy-complete.sh
```

This script will:
- Install and configure k3s
- Deploy NGINX Ingress Controller
- Install cert-manager for SSL certificates
- Deploy ArgoCD for GitOps
- Setup HashiCorp Vault for secrets management
- Deploy PostgreSQL and Redis
- Deploy your Laravel application

## 🔧 Manual Setup (Step by Step)

### Step 1: Setup k3s Cluster

```bash
./scripts/setup-k3s.sh
```

### Step 2: Setup HashiCorp Vault

```bash
./scripts/setup-vault.sh
```

### Step 3: Configure GitHub Secrets

Add these secrets to your GitHub repository:

```
DOCKER_USERNAME=your-dockerhub-username
DOCKER_PASSWORD=your-dockerhub-password
KUBE_CONFIG=base64-encoded-kubeconfig
ARGOCD_SERVER=argocd.autoscaleops.com
ARGOCD_USERNAME=admin
ARGOCD_PASSWORD=your-argocd-password
```

### Step 4: Deploy Application

```bash
kubectl apply -f argocd/application.yaml
```

## 🔐 Secrets Management

### Vault Configuration

Secrets are stored in HashiCorp Vault at path `secret/laravel/config`:

```bash
# Access Vault UI
kubectl port-forward -n vault svc/vault 8200:8200
# Visit: http://localhost:8200
# Token: root
```

### Update Secrets

```bash
export VAULT_ADDR="http://127.0.0.1:8200"
export VAULT_TOKEN="root"

vault kv put secret/laravel/config \
    app-key="base64:your-app-key" \
    db-host="laravel-chart-postgresql" \
    db-database="laravel" \
    db-username="laravel" \
    db-password="your-secure-password" \
    redis-host="laravel-chart-redis" \
    redis-password="your-redis-password" \
    mail-username="your-email@gmail.com" \
    mail-password="your-app-password" \
    mail-from-address="noreply@investify.com"
```

## 🔄 CI/CD Pipeline

The GitHub Actions workflow (`.github/workflows/ci-cd.yml`) automatically:

1. **Test**: Runs PHPUnit tests with PostgreSQL
2. **Build**: Creates multi-arch Docker images
3. **Push**: Pushes to Docker Hub
4. **Deploy**: Updates Helm values and syncs ArgoCD

### Triggering Deployments

Deployments are triggered automatically on:
- Push to `main` branch
- Pull requests (testing only)

## 📊 Monitoring and Maintenance

### Check Application Status

```bash
# Check pods
kubectl get pods -n laravel-app

# Check services
kubectl get services -n laravel-app

# Check ingress
kubectl get ingress -n laravel-app

# View logs
kubectl logs -f deployment/laravel-chart -n laravel-app
```

### ArgoCD Management

```bash
# Access ArgoCD UI
kubectl port-forward -n argocd svc/argocd-server 8080:443
# Visit: https://localhost:8080
```

### Database Management

```bash
# Connect to PostgreSQL
kubectl exec -it -n laravel-app deployment/laravel-chart-postgresql -- psql -U laravel -d laravel

# Run migrations manually
kubectl exec -it -n laravel-app deployment/laravel-chart -- php artisan migrate
```

## 🌐 DNS Configuration

Configure your DNS records:

```
A     investify.autoscaleops.com    -> YOUR_VPS_IP
A     argocd.autoscaleops.com       -> YOUR_VPS_IP
A     vault.autoscaleops.com        -> YOUR_VPS_IP
```

## 🔒 Security Considerations

1. **Change default passwords** in Vault after deployment
2. **Enable firewall** and restrict access to necessary ports only
3. **Regular updates** of all components
4. **Backup** your Vault data and PostgreSQL database
5. **Monitor** logs for suspicious activities

## 🛠️ Troubleshooting

### Common Issues

1. **Pods not starting**: Check resource limits and node capacity
2. **SSL certificate issues**: Verify DNS configuration and cert-manager logs
3. **Database connection errors**: Check PostgreSQL pod status and secrets
4. **ArgoCD sync failures**: Verify repository access and Helm chart syntax

### Debug Commands

```bash
# Check all resources
kubectl get all -n laravel-app

# Describe problematic pods
kubectl describe pod <pod-name> -n laravel-app

# Check events
kubectl get events -n laravel-app --sort-by='.lastTimestamp'

# Check ArgoCD application
kubectl get applications -n argocd
kubectl describe application laravel-app -n argocd
```

## 📈 Scaling

### Horizontal Pod Autoscaler

The application includes HPA configuration:

```yaml
autoscaling:
  enabled: true
  minReplicas: 2
  maxReplicas: 10
  targetCPUUtilizationPercentage: 80
```

### Manual Scaling

```bash
# Scale application
kubectl scale deployment laravel-chart --replicas=5 -n laravel-app

# Scale database (not recommended for production)
kubectl scale statefulset laravel-chart-postgresql --replicas=1 -n laravel-app
```

## 🔄 Updates and Rollbacks

### Application Updates

Updates are handled automatically via GitOps:
1. Push code changes to `main` branch
2. GitHub Actions builds and pushes new image
3. ArgoCD detects changes and deploys automatically

### Manual Rollback

```bash
# Via ArgoCD CLI
argocd app rollback laravel-app

# Via kubectl
kubectl rollout undo deployment/laravel-chart -n laravel-app
```

## 📞 Support

For issues and questions:
1. Check the troubleshooting section
2. Review logs using the provided commands
3. Consult the official documentation for each component

## 🎯 Next Steps

After successful deployment:
1. Configure monitoring (Prometheus/Grafana)
2. Set up log aggregation (ELK stack)
3. Implement backup strategies
4. Configure alerting
5. Performance optimization