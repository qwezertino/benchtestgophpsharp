FROM php:8.3-cli

RUN docker-php-ext-install opcache

RUN mkdir -p /app/data

WORKDIR /app

EXPOSE 8101

CMD ["php", "-S", "0.0.0.0:8101", "-t", "/app"]
