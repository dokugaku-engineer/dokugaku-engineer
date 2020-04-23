FROM nginx:1.17.10

WORKDIR /var/www/public

ARG env=development

COPY docker/nginx/nginx.${env}.conf /etc/nginx/nginx.conf
RUN rm /etc/nginx/conf.d/default.conf
COPY api/ /var/www/

# SSHしたいときはコメントアウトを解除する
RUN apt-get update
RUN apt-get install -y openssh-server
RUN sed -i 's/#Port 22/Port 20022/' /etc/ssh/sshd_config
RUN sed -i 's/#PermitRootLogin prohibit-password/PermitRootLogin yes/' /etc/ssh/sshd_config
RUN sed -i 's/#PasswordAuthentication.*/PasswordAuthentication\ yes/' /etc/ssh/sshd_config
RUN sed -i 's/#PermitUserEnvironment.*/PermitUserEnvironment\ yes/' /etc/ssh/sshd_config
RUN echo "daemon off;" >> /etc/nginx/nginx.conf
EXPOSE 20022
