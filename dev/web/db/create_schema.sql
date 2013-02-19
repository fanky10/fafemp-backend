/**
* localhost configuration for user.
*/
drop database if exists fafemp_web;
create database fafemp_web;
grant all privileges on fafemp_web.* to fafemp_root@'localhost' identified by 'root';
connect fafemp_web;


/* NOTICIAS */
DROP TABLE IF EXISTS noticias;

CREATE TABLE noticias(
    noticia_id integer unsigned not null primary key AUTO_INCREMENT,
    noticia_fec_hora timestamp not null,
    noticia_titulo varchar(100) not null,
    noticia_cuerpo text not null,
    noticia_eliminada TINYINT(1) default 0
)ENGINE=InnoDB;

DROP TABLE IF EXISTS imagenes_noticia;

/**
* una noticia, puede tener muchas imagenes, una imagen pertenece a una noticia.
*/

CREATE TABLE imagenes_noticia (
    imagen_id integer unsigned not null primary key AUTO_INCREMENT,
    imagen_path varchar(200) not null,
    imagen_nombre varchar(200) not null,
    imagen_noticia_id integer unsigned not null, #una imagen no puede no saber a que noticia pertenece
    imagen_eliminada TINYINT(1) default 0,
    imagen_fec_hora timestamp not null default current_timestamp,
    imagen_nombre_archivo varchar(200) not null,
    imagen_orden integer unsigned not null
)ENGINE=InnoDB;

/**
* foreign keys
*/

ALTER TABLE imagenes_noticia ADD CONSTRAINT `FK_imagenes_noticia_id_1` FOREIGN KEY (`imagen_noticia_id`) REFERENCES `noticias` (`noticia_id`);
/* FIN NOTICIAS */

/* REUNIONES */
DROP TABLE IF EXISTS reuniones;

CREATE TABLE reuniones(
    reunion_id integer not null primary key AUTO_INCREMENT,
    reunion_fec_ini date not null,
    reunion_fec_fin date not null,
    reunion_titulo varchar(100) not null,
    reunion_cuerpo text not null,
    reunion_eliminada TINYINT(1) default 0
);

DROP TABLE IF EXISTS imagenes_reunion;

/**
* una reunion, puede tener muchas imagenes, una imagen pertenece a una reunion.
*/

CREATE TABLE imagenes_reunion (
    imagen_id integer not null primary key AUTO_INCREMENT,
    imagen_path varchar(200) not null,
    imagen_nombre varchar(200) not null,
    imagen_reunion_id integer not null,
    imagen_eliminada TINYINT(1) default 0,
    imagen_fec_hora timestamp not null default current_timestamp,
    imagen_nombre_archivo varchar(200) not null,
    imagen_orden integer unsigned not null
);

/**
* foreign keys
*/

ALTER TABLE imagenes_reunion ADD CONSTRAINT `FK_imagenes_reunion_id_1` FOREIGN KEY (`imagen_reunion_id`) REFERENCES `reuniones` (`reunion_id`);

/* FIN REUNIONES*/

/* USUARIOS */
DROP TABLE IF EXISTS usuarios;

CREATE TABLE usuarios(
    usuario_user varchar(20) not null primary key,
    usuario_pass varchar(32) not null
)ENGINE=InnoDB;
/* FIN USUARIOS */