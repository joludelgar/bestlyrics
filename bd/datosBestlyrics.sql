drop table if exists artistas cascade;

create table artistas (
    id            bigserial     constraint pk_artistas primary key,
    id_usuario    bigint        constraint fk_artistas_usuarios
                                references public.user (id)
                                on delete no action on update cascade,
    nombre        varchar(255)   not null,
    biografia     text,
    created_at    timestamptz   default current_timestamp
);

create index idx_artistas_nombre on artistas (nombre);
create index idx_artistas_created_at on artistas (created_at);

drop table if exists generos cascade;

create table generos (
    id      bigserial     constraint pk_generos primary key,
    nombre  varchar(255)   not null
);

create index idx_generos_nombre on generos (nombre);

insert into generos (nombre) values ('Alternativa'), ('Blues'), ('Infantil'),
    ('Clásica'), ('Country'), ('Dance'), ('Electrónica'), ('Folk'), ('Rap'), ('Jazz'),
    ('Ópera'), ('Pop'), ('R&B/Soul'), ('Reggae'), ('Rock'), ('Cantautor'), ('BSO'),
    ('Latina');

drop table if exists albumes cascade;

create table albumes (
    id            bigserial     constraint pk_albumes primary key,
    id_usuario    bigint        constraint fk_albumes_usuarios
                                references public.user (id)
                                on delete no action on update cascade,
    id_artista    bigint        constraint fk_albumes_artistas
                                references artistas (id)
                                on delete no action on update cascade,
    id_genero   bigint          not null constraint fk_albumes_generos
                                references generos (id)
                                on delete no action on update cascade,
    nombre        varchar(255)   not null,
    anio          numeric(4)    not null,
    created_at    timestamptz   default current_timestamp
);

create index idx_albumes_nombre on albumes (nombre);
create index idx_albumes_created_at on albumes (created_at);

drop table if exists canciones cascade;

create table canciones (
    id            bigserial     constraint pk_canciones primary key,
    id_usuario    bigint        constraint fk_canciones_usuarios
                                references public.user (id)
                                on delete no action on update cascade,
    id_album      bigint        constraint fk_canciones_albumes
                                references albumes (id)
                                on delete no action on update cascade,
    id_letra_original      bigint        constraint fk_canciones_letra_original
                                references letras (id)
                                on delete no action on update cascade,
    nombre        varchar(255)   not null,
    video         varchar(255),
    created_at    timestamptz   default current_timestamp
);

create index idx_canciones_nombre on canciones (nombre);
create index idx_canciones_created_at on canciones (created_at);

drop table if exists idiomas cascade;

create table idiomas (
    id      bigserial     constraint pk_idiomas primary key,
    nombre  varchar(255)   not null
);

create index idx_idiomas_nombre on idiomas (nombre);

insert into idiomas (nombre) values ('Chino'), ('Español'), ('Inglés'), ('Árabe'),
    ('Portugués'), ('Ruso'), ('Japonés'), ('Alemán'), ('Francés'), ('Italiano'), ('Turco'),
    ('Polaco'), ('Checo'), ('Croata');

drop table if exists letras cascade;

create table letras (
    id            bigserial     constraint pk_letras primary key,
    id_cancion    bigint        constraint fk_letras_canciones
                                references canciones (id)
                                on delete no action on update cascade,
    id_idioma     bigint        not null constraint fk_letras_idiomas
                                references idiomas (id)
                                on delete no action on update cascade,
    letra         text          not null,
    bloqueada     boolean       not null default false,
    created_at    timestamptz   default current_timestamp,
    constraint uq_cancion_idioma unique (id_cancion, id_idioma)
);

create index idx_letras_created_at on letras (created_at);

drop table if exists letras_usuarios cascade;

create table letras_usuarios (
    id          bigserial constraint pk_letras_usuarios primary key,
    id_letra    bigint    constraint fk_letras_usuarios_letras
                          references letras (id)
                          on delete no action on update cascade,
    id_usuario  bigint    constraint fk_letras_usuarios_usuarios
                          references public.user (id)
                          on delete no action on update cascade,
    created_at    timestamptz   default current_timestamp
);

create index idx_letras_usuarios_created_at on letras_usuarios (created_at);

drop table if exists favoritos cascade;

create table favoritos (
    id       bigserial constraint pk_favoritos primary key,
    id_usuario     bigint    constraint fk_favoritos_usuarios
                             references public.user (id)
                             on delete no action on update cascade,
    id_cancion     bigint    constraint fk_favoritos_canciones
                             references canciones (id)
                             on delete no action on update cascade,
    created_at      timestamptz   default current_timestamp,
    constraint uq_usuario_cancion unique (id_usuario, id_cancion)
);

create index idx_favoritos_created_at on favoritos (created_at);

drop table if exists votos_letras cascade;

create table votos_letras (
    id  bigserial   constraint pk_votos_letras primary key,
    id_usuario bigint constraint fk_votos_letras_usuarios
                          references public.user (id)
                          on delete no action on update cascade,
    id_letra  bigint constraint fk_votos_letras_letras
                          references letras (id)
                          on delete no action on update cascade,
    voto      smallint    not null
);

drop table if exists reportes cascade;

create table reportes (
    id  bigserial   constraint pk_reportes primary key,
    id_reportador bigint constraint fk_votos_letras_usuarios
                          references public.user (id)
                          on delete no action on update cascade,
    comentario     text not null,
    enlace          varchar(255) not null
);

create view top_mensual as
    select count(c.id), c.*
      from canciones as c join favoritos as f on c.id = f.id_cancion
     WHERE extract(month FROM f.created_at) = extract(month FROM current_date)
      group by c.id
     order by count(c.id) DESC;

/*----------WIP----------*/
