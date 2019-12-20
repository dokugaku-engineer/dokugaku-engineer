FROM nginx:1.17.3

WORKDIR /var/www/public

ARG env=development

COPY docker/nginx/nginx.${env}.conf /etc/nginx/nginx.conf
RUN rm /etc/nginx/conf.d/default.conf
COPY api/ /var/www/
COPY api/.env.${env} /var/www/.env
