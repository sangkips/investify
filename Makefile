# Start containers
docker-compose up -d

# Stop containers
docker-compose down

# View logs
docker-compose logs -f

# Run artisan commands
docker-compose exec app php artisan migrate

# Access MySQL
docker-compose exec db mysql -u root -p

install dependencies

docker-compose exec app composer install
docker-compose exec app php artisan key:generate
docker-compose exec app php artisan migrate

# Build
docker-compose up -d --build

# commonly use commands on production

# Ensure proper permissions
sudo chown -R $USER:www-data storage
sudo chmod -R 775 storage

# Set up SSL certificates
sudo certbot certonly --standalone -d yourdomain.com

# Monitor logs
docker-compose -f docker-compose.prod.yml logs -f

# Backup database
docker-compose -f docker-compose.prod.yml exec db mysqldump -u root -p database_name > backup.sql

# Restart services
docker-compose -f docker-compose.prod.yml restart

# View container status
docker-compose -f docker-compose.prod.yml ps

# Update specific service
docker-compose -f docker-compose.prod.yml up -d --no-deps --build app

# Check logs
docker-compose -f docker-compose.prod.yml logs -f nginx

# Manual deployment process

# SSH into your server
ssh user@your-server

# Clone your repository
git clone your-repository
cd your-project

# Copy production environment file
cp .env.example .env
# Edit .env with production values

# Make deploy script executable
chmod +x scripts/deploy.sh

# Run deployment
./scripts/deploy.sh


