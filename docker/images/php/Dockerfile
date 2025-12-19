FROM php:8.2-cli

RUN apt-get update

RUN apt-get install vim -y && \
    apt-get install openssl -y && \
    apt-get install libssl-dev -y && \
    apt-get install wget -y && \
    apt-get install procps -y && \
    apt-get install -y inotify-tools && \
    apt-get install git -y && \
    apt-get install libpq-dev -y && \
    apt-get install libc-ares2 -y && \
    apt-get install -y libc-ares-dev && \
    apt-get install -y libcurl4-openssl-dev && \
    docker-php-ext-install sockets

# Clone the OpenSwoole repository and install
RUN cd /tmp && \
    git clone https://github.com/openswoole/ext-openswoole.git && \
    cd ext-openswoole && \
    phpize && \
    ./configure --enable-openssl \
                --enable-mysqlnd \
                --enable-sockets \
                --enable-http2 \
                --enable-hook-curl \
                --with-postgres \
                --enable-cares && \
    make && make install

# Add OpenSwoole extension to php.ini
RUN touch /usr/local/etc/php/conf.d/openswoole.ini && \
    echo 'extension=openswoole.so' > /usr/local/etc/php/conf.d/openswoole.ini

# Install Composer from official image
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN mkdir -p /app/data

WORKDIR /app

# Install Composer dependencies
COPY ./app/php/composer.json /app/composer.json
RUN composer install --no-dev --optimize-autoloader

# COPY ./app /app

EXPOSE 8101
# CMD ["/usr/local/bin/php", "/app/index.php"]
CMD ["/app/start.sh"]
