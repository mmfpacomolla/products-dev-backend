#Imagen base
FROM debian

LABEL org.opencontainers.image.authors="miguelmira.informatica@iespacomolla.es"

#Actualizaciones + instalación de VIM + instalación del servidor web NGINX + PHP
RUN apt update && \
    apt install -y vim && \
    apt install -y nginx && \
    apt install -y php8.2-fpm && \
    apt install -y php-yaml && \
    apt install -y php-mysql

#Expongo el puerto de NGINX
EXPOSE 80

#Habilito php-fpm y nginx para que arranque cada vez que el contenedor se inicie
ENTRYPOINT ["/bin/bash", "-c", "php-fpm8.2; nginx -g 'daemon off;' "]