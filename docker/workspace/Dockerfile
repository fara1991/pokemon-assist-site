FROM docker.io/bitnami/laravel:7-debian-10

RUN sudo apt-get update -y && \
    sudo apt-get upgrade -y && \
    sudo apt-get autoremove -y && \
    sudo apt-get install -y zip unzip wget && \
    npm install cross-env

# Composer install
COPY --from=composer:1.10.8 /usr/bin/composer /usr/bin/composer

