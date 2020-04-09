FROM amazonlinux:2.0.20190823.1

WORKDIR /var/www

# install package
RUN yum update -y
RUN yum install -y git vim sudo procps
RUN curl -sL https://rpm.nodesource.com/setup_10.x | bash -
RUN yum install -y nodejs npm
RUN npm install -g npm
RUN npm install -g gulp
COPY client/ /var/www/
RUN npm install --no-optional

ENV HOST 0.0.0.0
EXPOSE 3333 8081
CMD ["npm", "run", "dev"]
