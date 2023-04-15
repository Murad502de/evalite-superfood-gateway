# Для начала указываем исходный образ, он будет использован как основа
FROM webdevops/php:8.2-alpine

# крон
# RUN docker-service-enable cron

# для отладки
# RUN pecl install xdebug

# Куда же без composer'а.
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# копируем задания крона, файл должен находится в этой папке и называться cronjobs
# COPY ./cronjobs /etc

# настройки php
# COPY ./php.ini /opt/docker/etc/php

# натройки xdebug
# COPY ./xdebug.ini /usr/local/etc/php/conf.d

# запуск крона
# RUN crontab /etc/cronjobs


