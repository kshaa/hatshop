# Dockerized LEMP for Laravel
Forked from [atillay/docker-lemp](https://github.com/atillay/docker-lemp), refactored for ease-of-use and extended for quick Laravel setup.

# Quickstart
```
# Configure docker services
cp .env.sample .env

# Build Laravel Dockerfile
docker-compose build 

# Run all containers
docker-compose up -d 

# Create a new Laravel application codebase named "myapp"
docker-compose run php createapp myapp

# Link hat model storage as public
docker-compose run php artisan storage:link

# Run Laravel Artisan CLI commands
docker-compose run php artisan [...] 
```