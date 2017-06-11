Definición detallada de los requisitos
======================================

| **R01:**             | Registro de usuarios |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe permitir el registro de usuarios. |
| Descripción larga    | La aplicación contendrá un formulario de registro, donde el usuario debe indicar un nombre de usuario, un email valido y una contraseña. Si el nombre de usuario ya existe o el email ya existe o es de un formato incorrecto, el registro no se llevara a cabo y se notificara al usuario. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº de issue          | [1](https://github.com/joludelgar/bestlyrics/issues/1) |


----------
| **R02:**             | Correo de confirmación |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe enviar un correo de confirmación en el registro de usuarios. |
| Descripción larga    | Una vez el usuario haya completado el formulario de registro y lo haya enviado, se mandara un correo de confirmación al email especificado. Si no se confirma no será posible iniciar sesión en la aplicación. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº de issue          | [2](https://github.com/joludelgar/bestlyrics/issues/2) |

----------
| **R03:**             | Inicio de sesión de usuarios |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe permitir el inicio de sesión de los usuarios registrados. |
| Descripción larga    | La aplicación contendrá un formulario de inicio de sesión donde un usuario que ha sido registrado y confirmado podrá iniciar sesión en la aplicación introduciendo su nombre de usuario y su contraseña. Si los datos introducidos fueran incorrectos se informaría al usuario. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº de issue          | [3](https://github.com/joludelgar/bestlyrics/issues/3) |

----------
| **R04:**             | Cerrar sesión |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe permitir cerrar sesión a los usuarios que han iniciado sesión. |
| Descripción larga    | La aplicación, cuando un usuario tenga una sesión abierta, contendrá un botón en el menú que al pulsarlo se cerrará la sesión del usuario. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº de issue          | [4](https://github.com/joludelgar/bestlyrics/issues/4) |

----------
| **R05:**             | Recordar sesión de usuario |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe recordar la sesión iniciada de los usuarios. |
| Descripción larga    | En el formulario de inicio de sesión se implantara una casilla de verificación donde el usuario indicara si desea mantener la sesión iniciada una vez este cierre la aplicación. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº de issue          | [5](https://github.com/joludelgar/bestlyrics/issues/5) |

----------
| **R06:**             | Recuperación de contraseña |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe permitir el cambio de contraseña de los usuarios que lo soliciten. |
| Descripción larga    | En el formulario de inicio de sesión se implantara un enlace que redirigirá a un formulario donde el usuario debe indicar el email de la cuenta de la que desea recuperar la contraseña. Cuando introduzca el email se le enviara un correo con un enlace que contendrá un formulario para indicar una nueva contraseña. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº de issue          | [6](https://github.com/joludelgar/bestlyrics/issues/6) |

----------
| **R07:**             | Modificar datos de usuario |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe permitir modificar los datos de los usuarios registrados. |
| Descripción larga    | La aplicación debe disponer de una sección donde los usuarios podrán modificar varios aspectos de su perfil, tanto datos personales como los datos de la cuenta. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº de issue          | [7](https://github.com/joludelgar/bestlyrics/issues/7) |

----------
| **R08:**             | Mostrar perfil de usuario |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe mostrar un perfil público de los usuarios registrados. |
| Descripción larga    | Cada usuario de la aplicación dispondrá de un perfil público donde se mostraran los datos personales, el avatar y sus letras de canciones favoritas. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | v2 |
| Nº de issue          | [8](https://github.com/joludelgar/bestlyrics/issues/8) |

----------
| **R09:**             | Avatares de usuarios |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe permitir subir y mostrar un avatar a los usuarios registrados. |
| Descripción larga    | En la sección donde los usuarios pueden modificar sus datos se debe implementar un formulario para la subida de imágenes que se usaran como avatares de los usuarios. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | v3 |
| Nº de issue          | [9](https://github.com/joludelgar/bestlyrics/issues/9) |

----------
| **R10:**             | Añadir artistas |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe permitir añadir artistas. |
| Descripción larga    | Los usuarios autenticados al buscar un artista en el buscador de la aplicación y al no ser encontrado tendrá la posibilidad de añadir un nuevo artista a través de un formulario donde se comprobara que no exista. Los artistas contaran con un nombre, una biografía y etiquetas indicando el género de música que realiza. También se ofrecerá la posibilidad de añadir un archivo de imagen del artista. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº de issue          | [10](https://github.com/joludelgar/bestlyrics/issues/10) |

----------
| **R11:**             | Modificar artistas |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe permitir modificar artistas. |
| Descripción larga    | Cuando un usuario autenticado accede al perfil de un artista ya creado se podrán modificar tanto los datos como la imagen. Si el administrador considera que el artista no requiere más cambios en algún parámetro podrá deshabilitar la modificación. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº de issue          | [11](https://github.com/joludelgar/bestlyrics/issues/11) |

----------
| **R12:**             | Añadir álbumes |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe permitir añadir álbumes. |
| Descripción larga    | Cuando un usuario autenticado accede al perfil de un artista podrá añadir álbumes a través de un formulario indicando diferentes datos como el nombre o el año de lanzamiento. También contara con la posibilidad de añadir un archivo de imagen como portada del álbum. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº de issue          | [12](https://github.com/joludelgar/bestlyrics/issues/12) |

----------
| **R13:**             | Modificar álbumes |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe permitir modificar álbumes. |
| Descripción larga    | Cuando un usuario autenticado accede a un álbum de un artista ya creado se podrá modificar los diferentes datos y la portada del álbum. Si el administrador considera que el artista no requiere más cambios en algún parámetro podrá deshabilitar la modificación. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº de issue          | [13](https://github.com/joludelgar/bestlyrics/issues/13) |

----------
| **R14:**             | Añadir canciones |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe permitir añadir canciones. |
| Descripción larga    | Cuando un usuario autenticado accede al perfil de un álbum podrá añadir canciones a través de un formulario. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº de issue          | [14](https://github.com/joludelgar/bestlyrics/issues/14) |

----------
| **R15:**             | Modificar canciones |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe permitir modificar canciones. |
| Descripción larga    | Cuando un usuario autenticado accede al perfil de un álbum podrá modificar el nombre de las canciones a través de un formulario. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº de issue          | [15](https://github.com/joludelgar/bestlyrics/issues/15) |

----------
| **R16:**             | Añadir letras |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe permitir añadir letras a las canciones. |
| Descripción larga    | Cuando un usuario autenticado accede al perfil de una canción podrá añadir una letra a través de un formulario. Se indicaran al usuario normas básicas para la correcta forma de añadir las letras. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº de issue          | [16](https://github.com/joludelgar/bestlyrics/issues/16) |

----------
| **R17:**             | Modificar letras |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe permitir modificar letras a las canciones. |
| Descripción larga    | Cuando un usuario autenticado accede al perfil de una canción podrá modificar la letra a través de un formulario. La letra anterior quedara presente para que el usuario no deba escribir toda la letra completa si los cambios son menores. Se indicaran al usuario normas básicas para la correcta forma de modificar las letras. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº de issue          | [17](https://github.com/joludelgar/bestlyrics/issues/17) |

----------
| **R18:**             | Búsqueda de canciones, artistas o álbumes |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe permitir buscar por nombre de canción, nombre de artista o nombre de álbum. |
| Descripción larga    | La aplicación ofrecerá un buscador a los usuarios. En este buscador se podrán realizar búsquedas tanto de canciones como de artistas o álbumes. El buscador mostrara una vista preliminar de las coincidencias encontradas según el usuario va escribiendo en el cuadro de búsqueda. Si el usuario desea una vista más detallada solo debe enviar el resultado de la búsqueda y se mostrara una lista más detallada con coincidencias de la búsqueda realizada. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Media |
| Entrega planificada  | v2 |
| Entrega realizada    | v3 |
| Nº de issue          | [18](https://github.com/joludelgar/bestlyrics/issues/18) |

----------
| **R19:**             | Añadir letra de canción como favorito |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe permitir añadir una letra de una canción como favorito. |
| Descripción larga    | En el perfil de una letra de canción se mostrara un icono de favorito, donde el usuario podrá interactuar y añadir la letra a sus favoritos. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Media |
| Entrega planificada  | v2 |
| Entrega realizada    | v2 |
| Nº de issue          | [19](https://github.com/joludelgar/bestlyrics/issues/19) |

----------
| **R20:**             | Eliminar letra de canción como favorito |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe permitir eliminar una letra de una canción como favorito. |
| Descripción larga    | En el perfil de una letra de canción se mostrara un icono de favorito, donde el usuario podrá interactuar y eliminar la letra a sus favoritos. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Media |
| Entrega planificada  | v2 |
| Entrega realizada    | v2 |
| Nº de issue          | [20](https://github.com/joludelgar/bestlyrics/issues/20) |

----------
| **R21:**             | Top de letras |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe mostrar un top de letras de canciones. |
| Descripción larga    | La aplicación debe mostrar un top de letras que estará basado en función a la cantidad de favoritos que una canción obtiene en un mes. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Media |
| Entrega planificada  | v2 |
| Entrega realizada    | v2 |
| Nº de issue          | [21](https://github.com/joludelgar/bestlyrics/issues/21) |

----------
| **R22:**             | Nuevas letras |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe mostrar un listado de nuevas letras de canciones. |
| Descripción larga    | La aplicación debe mostrar una lista de nuevas letras añadidas en la aplicación. Cada nueva letra añadida actualizara constantemente esta lista. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v2 |
| Entrega realizada    | v1 |
| Nº de issue          | [22](https://github.com/joludelgar/bestlyrics/issues/22) |

----------
| **R23:**             | Añadir traducción de letra |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe permitir añadir una traducción de la letra a las canciones. |
| Descripción larga    | Cuando un usuario autenticado accede al perfil de una canción podrá añadir una traducción de una letra a través de un formulario. El usuario podrá indicar el idioma de la traducción. Se indicaran al usuario normas básicas para la correcta forma de añadir las letras. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | v2 |
| Nº de issue          | [23](https://github.com/joludelgar/bestlyrics/issues/23) |

----------
| **R24:**             | Modificar traducción de letra |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe permitir modificar una traducción de la letra a las canciones. |
| Descripción larga    | Cuando un usuario autenticado accede al perfil de una canción podrá modificar la traducción de una letra a través de un formulario. La letra anterior quedara presente para que el usuario no deba escribir toda la letra completa si los cambios son menores. Se indicaran al usuario normas básicas para la correcta forma de modificar las letras. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | v2 |
| Nº de issue          | [24](https://github.com/joludelgar/bestlyrics/issues/24) |

----------
| **R25:**             | Redimensionar imágenes |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe redimensionar las imágenes. |
| Descripción larga    | Las imágenes subidas por los usuarios deben ser redimensionadas para la perfecta visualización de estas imágenes. Las imágenes de los avatares tendrán varios tamaños en función del lugar desde el que se visualice. El tamaño de la imagen del perfil será de mayor tamaño en comparación con las imágenes que podrán ser visualizadas del avatar en otros aspectos de la aplicación. Las imágenes subidas de los álbumes y de los artistas también deben ser redimensionadas para la correcta visualización. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Difícil |
| Entrega planificada  | v1 |
| Entrega realizada    | v3 |
| Nº de issue          | [25](https://github.com/joludelgar/bestlyrics/issues/25) |

----------
| **R26:**             | Añadir video |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe permitir añadir videos a las canciones. |
| Descripción larga    | Cuando un usuario autenticado accede al perfil de una canción podrá añadir un video de la canción relacionada a través de un formulario. El usuario podrá insertar la URL de un video de la plataforma Youtube. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº de issue          | [26](https://github.com/joludelgar/bestlyrics/issues/26) |

----------
| **R27:**             | Modificar video |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe permitir modificar los videos de las canciones. |
| Descripción larga    | Cuando un usuario autenticado accede al perfil de una canción podrá modificar el video de la canción relacionada a través de un formulario. El usuario podrá insertar la URL de un video de la plataforma Youtube. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº de issue          | [27](https://github.com/joludelgar/bestlyrics/issues/27) |

----------
| **R28:**             | Añadir comentario |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe permitir añadir comentarios a las letras de las canciones. |
| Descripción larga    | Los usuarios autenticados podrán añadir comentarios en las fichas de las canciones. El comentario mostrara el avatar, el nombre de usuario y el tiempo desde que el usuario realizo el comentario. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº de issue          | [28](https://github.com/joludelgar/bestlyrics/issues/28) |

----------
| **R29:**             | Modificar comentarios |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe permitir modificar comentarios de las letras de las canciones. |
| Descripción larga    | El administrador de la aplicación podrá modificar los comentarios de los usuarios. Los usuarios no podrán realizar esta acción. |
| Prioridad            | Opcional |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | Sin entrega |
| Nº de issue          | [29](https://github.com/joludelgar/bestlyrics/issues/29) |

----------
| **R30:**             | Eliminar comentarios |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe permitir eliminar comentarios de las letras de las canciones. |
| Descripción larga    | El administrador de la aplicación podrá eliminar los comentarios de los usuarios. Los usuarios no podrán realizar esta acción. |
| Prioridad            | Opcional |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | Sin entrega |
| Nº de issue          | [30](https://github.com/joludelgar/bestlyrics/issues/30) |

----------
| **R31:**             | Responder comentarios |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe permitir responder comentarios de otros usuarios. |
| Descripción larga    | Los usuarios autenticados podrán responder a los otros comentarios realizados por otros usuarios. La cantidad de respuestas múltiples será establecida mediante un límite. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Fácil |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº de issue          | [31](https://github.com/joludelgar/bestlyrics/issues/31) |

----------
| **R32:**             | Reportar contenido |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe permitir a los usuarios reportar los diferentes elementos editables de la aplicación. |
| Descripción larga    | Todas las páginas de un artista, un álbum, una letra o un perfil de un usuario contendrán un enlace para reportar algún problema. El enlace mostrara un formulario donde el usuario puede informar al administrador del problema. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Media |
| Entrega planificada  | v2 |
| Entrega realizada    | v3 |
| Nº de issue          | [32](https://github.com/joludelgar/bestlyrics/issues/32) |

----------
| **R33:**             | Valorar letra |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe permitir a los usuarios valorar las letras de las canciones. |
| Descripción larga    | Las canciones obtendrán votos positivos y negativos de los usuarios. Si los votos negativos superan el 70% de votos totales se establecerá que la letra de la canción debe ser revisada y modificada. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Dificil |
| Entrega planificada  | v2 |
| Entrega realizada    | Sin entrega |
| Nº de issue          | [33](https://github.com/joludelgar/bestlyrics/issues/33) |

----------
| **R34:**             | Sección de letras modificadas |
| ----------           | ---------- |
| Descripción corta    | La aplicación debe permitir a los usuarios consultar una lista de letras que deben ser modificadas. |
| Descripción larga    | La aplicación debe ofrecer a los usuarios una lista con las canciones donde la letra contiene en su mayoría votos negativos. Una vez que letra se modifica los votos se reinician y la canción deja de aparecer en la lista. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Media |
| Entrega planificada  | v2 |
| Entrega realizada    | Sin entrega |
| Nº de issue          | [34](https://github.com/joludelgar/bestlyrics/issues/34) |

----------
| **R35:**             | Nivel de usuario |
| ----------           | ---------- |
| Descripción corta    | Los usuarios tendrán un nivel de comunidad que le permitirá realizar ciertas funciones. |
| Descripción larga    | Cuando un usuario añade un artista, un álbum, una canción, una letra, una imagen, un video, vota positivamente o negativamente una letra la aplicación le asignara una serie de puntos que le harán subir niveles. Cuando un usuario alcanza un nivel especificado podrá comenzar a modificar letras. |
| Prioridad            | Opcional |
| Tipo                 | Funcional |
| Complejidad          | Media |
| Entrega planificada  | v3 |
| Entrega realizada    | Sin entrega |
| Nº de issue          | [35](https://github.com/joludelgar/bestlyrics/issues/35) |

----------
| **R36:**             | Registro de comunidad |
| ----------           | ---------- |
| Descripción corta    | La aplicación ofrecerá los últimos cambios realizados en la aplicación. |
| Descripción larga    | La aplicación ofrecerá una sección donde se podrá consultar todos los cambios realizados por los usuarios. También se mostrara una lista de los usuarios que más aportaciones han realizado en el mes. |
| Prioridad            | Opcional |
| Tipo                 | Funcional |
| Complejidad          | Media |
| Entrega planificada  | v3 |
| Entrega realizada    | Sin entrega |
| Nº de issue          | [36](https://github.com/joludelgar/bestlyrics/issues/36) |

----------
| **R70:**             | Almacenamiento de archivos |
| ----------           | ---------- |
| Descripción corta    | La aplicación almacenará los archivos subidos por los usuarios. |
| Descripción larga    | La aplicación usará AWS S3 para la subida y el almacenamiento de archivos en la nube. Las imágenes que suban los usuarios serán almacenadas en la nube, y la aplicación usará esas imágenes. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Difícil |
| Entrega planificada  | v2 |
| Entrega realizada    | v3 |
| Nº de issue          | [70](https://github.com/joludelgar/bestlyrics/issues/70) |

----------
| **R71:**             | Login por Google |
| ----------           | ---------- |
| Descripción corta    | Los usuarios podrán registrarse e iniciar sesión a través de Google. |
| Descripción larga    | Los usuarios cuando se sitúen en el formulario de inicio de sesión o en el de registro podrán iniciar sesión o registrarse a través de Google pulsando un botón. |
| Prioridad            | Importante |
| Tipo                 | Funcional |
| Complejidad          | Media |
| Entrega planificada  | v1 |
| Entrega realizada    | v1 |
| Nº de issue          | [71](https://github.com/joludelgar/bestlyrics/issues/71) |

----------
| **R72:**             | Popups |
| ----------           | ---------- |
| Descripción corta    | La aplicación mostrará diferentes popups para la visualización de contenido e imágenes. |
| Descripción larga    | La aplicación usará un plugin de jQuery para mostrar al usuario diferentes popups para visualizar contenido, formularios y contenido multimedia. |
| Prioridad            | Opcional |
| Tipo                 | Funcional |
| Complejidad          | Media |
| Entrega planificada  | v3 |
| Entrega realizada    | Sin entrega |
| Nº de issue          | [72](https://github.com/joludelgar/bestlyrics/issues/72) |
