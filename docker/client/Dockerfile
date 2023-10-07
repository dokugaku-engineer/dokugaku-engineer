FROM amazonlinux:2023

WORKDIR /var/www

RUN dnf update -y
RUN dnf groupinstall -y "Development Tools"
RUN dnf install -y git vim sudo procps make
RUN dnf install https://rpm.nodesource.com/pub_18.x/nodistro/repo/nodesource-release-nodistro-1.noarch.rpm -y \
  && dnf install nodejs -y --setopt=nodesource-nodejs.module_hotfixes=1
RUN npm install -g npm
COPY client/ /var/www/
RUN npm install --no-optional

ENV HOST 0.0.0.0
EXPOSE 3333 8081
CMD ["npm", "run", "dev"]
