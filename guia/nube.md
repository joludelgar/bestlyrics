Instrucciones de instalación y despliegue en la nube
==========================================

Para la instalar y desplegar la aplicación en la nube a través de Heroku se realizaran los siguientes pasos:

 1. Tener una cuenta en Heroku y crear una aplicación. Se debe instalar
    el comando `heroku` para trabajar por linea de comando o bien
    hacerlo desde la página web.

 2. Se deben crear las variables de entornos que dispongamos en local y añadir la variable de entorno  `YII_ENV=prod`

 3. Crear una base de datos en Heroku. Para ello, debemos añadir el addon heroku-postgresql. También es necesario crear un dump de la base de datos local a través del siguiente comando:
    ` pg_dump -Fc --no-acl --no-owner -h localhost -U bestlyrics bestlyrics > db.dump `

    Se debe subir el archivo en la nube y obtener el enlace del archivo. A continuación realizar un restore de la base de datos de Heroku:
    ` heroku pg:backups:restore 'enlace_al_archivo' DATABASE_URL `

 4. Por último, ejecutar los siguientes comandos:

```
cd bestlyrics
heroku login
heroku git:remote -a nombre_aplicacion_heroku
git push heroku master
```
