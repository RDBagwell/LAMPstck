FROM php:7-apache
COPY ./LAMPcontained/data /usr/src/dst_folder
WORKDIR /usr/src/dst_folder
RUN docker-php-ext-install pdo pdo_mysql
EXPOSE 80