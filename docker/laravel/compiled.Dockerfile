FROM atillay/lemp-php

# !!! Must be compiled with project root as context

# Install Laravel
RUN composer global require laravel/installer

# Add composer binaries (laravel) to $PATH
ENV PATH="${PATH}:/root/.composer/vendor/bin"

# Set workdir
RUN mkdir -p /var/www/public
WORKDIR "/var/www/public"

# Set up docker entrypoint
COPY ./docker/laravel/ /var/dockerbin/
RUN chmod +x /var/dockerbin/entrypoint.sh

# Put the application code in the image
COPY ./code/ /var/www/public/
RUN chown -R www-data:www-data /var/www/public/

ENTRYPOINT ["/var/dockerbin/entrypoint.sh"]
CMD ["php-fpm"]