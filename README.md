## Proyecto de tienda hecho con laravel + docker
Este es un proyecto realizado con laravel y docker.


## Iniciar servicios

Para iniciar los servicios **docker** asociados al proyecto debemos abrir una terminal o línea de comandos en el directorio del repositorio e insertar el siguiente **comando**:

    docker-compose up -d

Este comando **podría tardar varios minutos** dependiendo de tu equipo y sus características.

## Parar servicios

Para parar los servicios de docker asociados a nuestro proyecto debemos abrir una terminal o línea de comandos en la carpeta del repositorio e insertar el siguiente comando:

    docker-compose down

## Acceder mediante terminal

    docker exec -it laravel sh

## LOGS

    docker logs -f --tail 100 laravel

## En caso de fallo de permisos en la carpeta

    sudo chmod 777 -R shop

## Carpeta **shop**

En esta carpeta encontraremos todos los archivos php/html que usaremos en el proyecto.

## TODO
>Pendiente de analizar y organizar las tareas.
