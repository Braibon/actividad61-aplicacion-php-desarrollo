# 1. Indicamos la imagen base que vamos a utilizar 
FROM ubuntu:24.04

# 2. Evitamos que nos pida confirmaciones manuales durante la instalación [cite: 506]
ENV DEBIAN_FRONTEND=noninteractive
ENV TZ=Europe/Madrid

# 3. Variables de entorno por defecto para tu BD de la NBA [cite: 509-514]
# (Aunque tu docker-compose usará las del archivo .env, es buena práctica ponerlas aquí)
ENV MARIADB_ROOT_PASSWORD=AntonioDiaz@2005
ENV MARIADB_DATABASE=db_NBA
ENV MARIADB_USERNAME=usuarioAnDi
ENV MARIADB_PASSWORD=AntonioDiaz@2005


# 4. Actualizamos el sistema e instalamos Apache, PHP y el conector MySQL [cite: 516-523]
RUN apt-get update \
    && apt-get install -y apache2 \
    && apt-get install -y php \
    && apt-get install -y libapache2-mod-php \
    && apt-get install -y php-mysql \
    && rm -rf /var/lib/apt/lists/*

# 5. Copiamos la configuración de tu sitio web en Apache [cite: 527-528]
COPY ./src /var/www/html/
COPY ./conf/000-default.conf /etc/apache2/sites-available/

# 6. Informamos de que el contenedor utilizará el puerto 80 [cite: 529-531]
EXPOSE 80

# 7. Primer comando que ejecutará el contenedor: iniciar Apache 
ENTRYPOINT ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]