FROM registry.access.redhat.com/ubi8/ubi:latest

RUN yum --disableplugin=subscription-manager -y module enable php:7.3 \
  && yum --disableplugin=subscription-manager -y install httpd php net-tools nmap-ncat iproute iputils hostname bind-utils openldap-clients jq \
#  && yum --disableplugin=subscription-manager -y install https://dl.fedoraproject.org/pub/epel/epel-release-latest-8.noarch.rpm \
#  && yum --disableplugin=subscription-manager -y install siege \
  && yum --disableplugin=subscription-manager clean all

ADD index.php /var/www/html

RUN sed -i 's/Listen 80/Listen 8080/' /etc/httpd/conf/httpd.conf \
  && sed -i 's/listen.acl_users = apache,nginx/listen.acl_users =/' /etc/php-fpm.d/www.conf \
  && mkdir /run/php-fpm \
  && chgrp -R 0 /var/log/httpd /var/run/httpd /run/php-fpm \
  && chmod -R g=u /var/log/httpd /var/run/httpd /run/php-fpm

EXPOSE 8080
USER 1001
CMD php-fpm & httpd -D FOREGROUND
