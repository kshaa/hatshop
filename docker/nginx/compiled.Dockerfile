FROM atillay/lemp-nginx

# !!! Must be compiled with project root as context

# Put application code in the container
COPY ./code/ /var/www/public
