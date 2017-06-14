Instrucciones de instalación y despliegue en Local
==================================================

#### Requisitos
- php >= 7.0.0
- PostgreSQL >= 9.5
- composer
- Cuenta en AWS S3
- API key de Google+
- Tener un servidor correctamente configurado (como Apache2)

#### Instalación

1. Tener un servidor (ej. Apache2) correctamente configurado con un nombre de dominio creado (ej. bestlyrics.local) y enlazado a `bestlyrics/web/`.

2. Instalar *[composer](https://getcomposer.org/download/)*.

3. Ejecutar los siguientes comandos.

```
git clone https://github.com/joludelgar/bestlyrics.git
cd bestlyrics
composer install
composer run-script post-create-project-cmd
cd web
chmod -R 777 uploads
```

4. Instalar *PostgreSQL* y ejecutar los siguientes comandos desde la raíz del proyecto.

```
cd db
./create.sh
./migrations.sh
./load.sh
```

> Se creará una base de datos llamada `bestlyrics` con un usuario `bestlyrics` y contraseña `bestlyrics`.

5. Cambiar la configuración de la aplicación:
    + Cambiar el nombre del administrador.
        - Modifica el nombre de usuario del array de admins en `/config/web.php` por tu nombre de usuario en la aplicación.
    + Cuenta de Amazon S3.
        - En `/config/web.php` cambiar las propiedades para que concuerde con la configuración proporcionada en AWS S3.
        - AWS_KEY: variable de entorno para la clave de AWS.
        - AWS_SECRET: variable de entorno para la clave secreta de AWS.
    + Correo electrónico
        - Cambiar el correo electrónico en `/config/web.php` y `/config/params.php`.
        - SMTP_PASS: variable de entorno para la contraseña del correo electrónico.
    + Google+ api
        - GOOGLE_ID: variable de entorno para el id de la API Google+.
        - GOOGLE_PASS: variable de entorno para la key de la API Google+

> Todas las claves y contraseñas se recomiendan guardar y disponer a la aplicación a través de variables de entorno.
