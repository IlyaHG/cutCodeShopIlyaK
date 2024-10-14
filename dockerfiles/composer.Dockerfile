FROM composer:latest

WORKDIR /var/www/app_cut

ENTRYPOINT ["composer", "--ignore-platform-reqs"]
