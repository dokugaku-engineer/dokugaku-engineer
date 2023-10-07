FROM amazonlinux:2.0.20190823.1

WORKDIR /var/www

# install package
RUN yum update -y
RUN yum groupinstall -y "Development Tools"
RUN yum install -y git vim sudo procps make
RUN yum update glibc -y
RUN yum install https://rpm.nodesource.com/pub_16.x/nodistro/repo/nodesource-release-nodistro-1.noarch.rpm -y \
  && yum install nodejs -y --setopt=nodesource-nodejs.module_hotfixes=1
RUN npm install -g npm@8.19.4
RUN npm install -g gulp node-gyp
COPY client/ /var/www/
RUN npm install --no-optional

ENV HOST 0.0.0.0
EXPOSE 3333 8081
CMD ["npm", "run", "dev"]
