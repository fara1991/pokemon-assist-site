FROM docker.io/bitnami/laravel:7-debian-10

RUN sudo apt-get update -y && \
    sudo apt-get upgrade -y && \
    sudo apt-get autoremove -y && \
    sudo apt-get install -y zip unzip && \
    npm install cross-env 

USER root
RUN sudo ln -snf /usr/share/zoneinfo/Japan /etc/localtime && echo Japan > /etc/timezone

USER bitnami

 Composer install
COPY --from=composer:1.10.8 /usr/bin/composer /usr/bin/composer

