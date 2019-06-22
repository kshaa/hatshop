# Hatshop
A Laravel site to upload "Hats", "Charms" & trade them. 
Forked from [kshaa/laravel-sandbox](https://github.com/kshaa/laravel-sandbox), extended for deploying to Kubernetes.  

# Info
Includes user roles:
- Regular users "Traders" - can upload items, create trades & do purchases
- Special users "Trade managers" - who can approve new uploaded items
- Special users "Administrators" - who can delegate roles for all users

# Quickstart
```
# Run all containers
docker-compose up -d 

# Link hat model storage as public
docker-compose run php artisan storage:link

# Create database structure & seed it
docker-compose run php artisan migrate:fresh
docker-compose run php artisan db:seed
```