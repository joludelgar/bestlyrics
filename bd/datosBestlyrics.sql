drop table if exists artistas cascade;

create table artistas (
    id            bigserial     constraint pk_artistas primary key,
    id_usuario    bigint        constraint fk_artistas_usuarios
                                references public.user (id)
                                on delete no action on update cascade,
    nombre        varchar(50)   not null,
    biografia     varchar(500),
    created_at    timestamptz   default current_timestamp
);

create index idx_artistas_nombre on artistas (nombre);
create index idx_artistas_created_at on artistas (created_at);

create table albumes (
    id            bigserial     constraint pk_albumes primary key,
    id_usuario    bigint        constraint fk_albumes_usuarios
                                references public.user (id)
                                on delete no action on update cascade,
    id_artista    bigint        constraint fk_albumes_artistas
                                references artistas (id)
                                on delete no action on update cascade,
    nombre        varchar(50)   not null,
    anio          numeric(4)    not null,
    created_at    timestamptz   default current_timestamp
);

create index idx_albumes_nombre on albumes (nombre);
create index idx_albumes_created_at on albumes (created_at);

drop table if exists generos cascade;

create table generos (
    id      bigserial     constraint pk_generos primary key,
    nombre  varchar(20)   not null
);

create index idx_generos_nombre on generos (nombre);

drop table if exists albumes_generos cascade;

create table albumes_generos (
    id          bigserial constraint pk_albumes_generos primary key,
    id_album    bigint    constraint fk_albumes_generos_albumes
                          references albumes (id)
                          on delete no action on update cascade,
    id_genero   bigint    constraint fk_albumes_generos_generos
                          references generos (id)
                          on delete no action on update cascade
);

drop table if exists canciones cascade;

create table canciones (
    id            bigserial     constraint pk_canciones primary key,
    id_usuario    bigint        constraint fk_canciones_usuarios
                                references public.user (id)
                                on delete no action on update cascade,
    id_album      bigint        constraint fk_canciones_albumes
                                references albumes (id)
                                on delete no action on update cascade,
    nombre        varchar(50)   not null,
    video         varchar(11),
    created_at    timestamptz   default current_timestamp
);

create index idx_canciones_nombre on canciones (nombre);
create index idx_canciones_created_at on canciones (created_at);

drop table if exists letras cascade;

create table letras (
    id            bigserial     constraint pk_letras primary key,
    id_cancion    bigint        constraint fk_letras_canciones
                                references canciones (id)
                                on delete no action on update cascade,
    letra         varchar(5000) not null,
    bloqueada     boolean       not null default false,
    created_at    timestamptz   default current_timestamp
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

drop table if exists idiomas cascade;

create table idiomas (
    id      bigserial     constraint pk_idiomas primary key,
    nombre  varchar(20)   not null
);

create index idx_idiomas_nombre on idiomas (nombre);

drop table if exists traducciones cascade;

create table traducciones (
    id            bigserial     constraint pk_traducciones primary key,
    id_cancion    bigint        constraint fk_traducciones_canciones
                                references canciones (id)
                                on delete no action on update cascade,
    id_idioma     bigint        constraint fk_traducciones_idiomas
                                references idiomas (id)
                                on delete no action on update cascade,
    bloqueada     boolean       not null default false,
    letra         varchar(5000) not null,
    created_at    timestamptz   default current_timestamp
);

create index idx_traducciones_created_at on traducciones (created_at);

drop table if exists traducciones_usuarios cascade;

create table traducciones_usuarios (
    id              bigserial constraint pk_traducciones_usuarios primary key,
    id_traduccion   bigint    constraint fk_traducciones_usuarios_letras
                              references traducciones (id)
                              on delete no action on update cascade,
    id_usuario      bigint    constraint fk_traducciones_usuarios_usuarios
                              references public.user (id)
                              on delete no action on update cascade,
    created_at      timestamptz   default current_timestamp
);

create index idx_traducciones_usuarios_created_at on traducciones_usuarios (created_at);

drop table if exists favoritos cascade;

create table favoritos (
    id       bigserial constraint pk_favoritos primary key,
    id_usuario     bigint    constraint fk_favoritos_usuarios
                             references public.user (id)
                             on delete no action on update cascade,
    id_cancion     bigint    constraint fk_favoritos_canciones
                             references canciones (id)
                             on delete no action on update cascade,
    created_at      timestamptz   default current_timestamp
);

create index idx_favoritos_created_at on favoritos (created_at);

drop table if exists votos cascade;

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

drop table if exists votos_traducciones cascade;

create table votos_traducciones (
    id  bigserial   constraint pk_votos_traducciones primary key,
    id_usuario bigint constraint fk_votos_traducciones_usuarios
                          references public.user (id)
                          on delete no action on update cascade,
    id_traduccion  bigint constraint fk_votos_traducciones_traducciones
                          references traducciones (id)
                          on delete no action on update cascade,
    voto      smallint    not null
);

/*----------WIP----------*/
