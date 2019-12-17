FROM nginx:1.17.3

WORKDIR /var/www

COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf
RUN rm /etc/nginx/conf.d/default.conf
COPY api/ /var/www
