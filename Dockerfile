FROM composer:2 AS composer

FROM dunglas/frankenphp

# Namesti potrebne PHP razširitve
RUN install-php-extensions intl zip \
    && apt-get update \
    && apt-get install -y --no-install-recommends git unzip nodejs npm \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /app
COPY . /app

# Kopiraj composer iz prvega stage-a
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Expose Caddy port
EXPOSE 80

CMD ["frankenphp", "run", "--config", "/etc/caddy/Caddyfile"]

