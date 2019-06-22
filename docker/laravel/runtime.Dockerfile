FROM atillay/lemp-php

# Install Laravel
RUN composer global require laravel/installer

# Add composer binaries (laravel) to $PATH
ENV PATH="${PATH}:/root/.composer/vendor/bin"

# Set workdir
RUN mkdir -p /var/www/public
WORKDIR "/var/www/public"

# Set up docker entrypoint
COPY . /var/dockerbin/
RUN chmod +x /var/dockerbin/entrypoint.sh
ENTRYPOINT ["/var/dockerbin/entrypoint.sh"]

CMD ["php-fpm"]