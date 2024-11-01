# scripts/deploy.sh
#!/bin/bash
echo "Starting deployment..."

# Pull latest code
git pull origin main

# Copy production environment file
cp .env.production .env

# Build production Docker images
docker-compose -f docker-compose.prod.yaml build

# Start containers
docker-compose -f docker-compose.prod.yaml up -d

# Install dependencies and build assets
docker-compose exec app composer install --optimize-autoloader --no-dev
docker-compose exec app npm install
docker-compose exec app npm run build

# Run migrations
docker-compose -f docker-compose.prod.yaml exec -T app php artisan migrate --force

# Clear caches
docker-compose -f docker-compose.prod.yaml exec -T app php artisan cache:clear
docker-compose -f docker-compose.prod.yaml exec -T app php artisan config:clear
docker-compose -f docker-compose.prod.yaml exec -T app php artisan route:clear

echo "Deployment completed!"
