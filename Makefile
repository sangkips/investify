build:
	docker build \
		--build-arg BUILD_ID=1 \
		--target production \
		-f ./docker/common/php-fpm/Dockerfile \
		-t ektowett/investify:latest .

up:
	docker compose -f docker-compose.prod.yaml up
