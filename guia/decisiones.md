Decisiones adoptadas y su justificación
========================================

Una de las decisiones tomadas ha sido la de no implementar los requisitos: [R33: Valorar letra](https://github.com/joludelgar/bestlyrics/issues/33) y [R34: Sección de letras modificadas](https://github.com/joludelgar/bestlyrics/issues/34). La no implementación se debe a la falta de tiempo para la realización del proyecto y al considerar que estos requisitos no son realmente fundamentales para el correcto funcionamiento de la aplicación y para lo que fué diseñada.

También he decidido que tanto las imágenes de los artistas y los álbumes solo pueden subirse una primera vez y estas ya no se podrán modificar (a no ser que el administrador elimine la imagen). Se ha adoptado esta opción ya que se considera que una imagen de una artista o un álbum no tiene por que ser cambiada a no ser de que se trate de un error.

Respecto a decisiones sobre la base de datos:
* Se ha decidido que el genero debe establecerlo el álbum. Normalmente, en la vida real, es el álbum el que determina el género de música que ha adoptado el artista para las canciones de ese álbum. Es poco habitual que dentro de un álbum haya muchas variedades de géneros musicales.
* Se ha decidido establecer en una tabla aparte un historial sobre las letras añadidas y los cambios que los usuarios hacen sobre ellas. De esta forma podemos controlar que cambios hace cada usuario.
* Por último, se ha decidido que para las traducciones de las letras, cada vez que se crea una letra se debe indicar el idioma. La primera vez se establecerá como el idioma de la canción original y de esta forma podemos ver las traducciones de una manera más sencilla y sin volver a repetir la tabla de letras para las traducciones.
