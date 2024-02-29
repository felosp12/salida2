# Este es un comentario en un Dockerfile. Los comentarios empiezan con el símbolo "#".

# Establece la imagen base que vamos a usar. En este caso, usamos una imagen con PHP y Apache.
FROM php:7.4-apache

# Establece el directorio de trabajo dentro del contenedor donde estarán los archivos de tu aplicación.
WORKDIR /var/www/html

# Copia los archivos de tu aplicación desde tu computadora al contenedor.
COPY . .

# Indica que el contenedor debe exponer el puerto 80, que es el puerto por defecto de Apache.
EXPOSE 80
