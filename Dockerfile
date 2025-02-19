FROM ubuntu:22.04

# to avoid user interaction during installation like time zone or any other questions 
ENV DEBIAN_FRONTEND=noninteractive

RUN apt update && apt install -y nginx php8.1-fpm php-mysql 

COPY ./web-server/default /etc/nginx/sites-available/default

RUN ln -sf /etc/nginx/sites-available/default /etc/nginx/sites-enabled/default

COPY ./web-server/index.php /usr/share/nginx/html/index.php

EXPOSE 80

#[nginx -g 'daemon off';]  without this the container would stop thhis is needed to keep the container running in the foreground  
# Why service ?  systemctl doesn't come with the image ubuntu:22.04
CMD ["bash", "-c", "service  php8.1-fpm start && nginx -g 'daemon off;'"]
