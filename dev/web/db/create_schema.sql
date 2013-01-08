/**
* first time you execute the sql script, as root create dabase and grant privileges to it.
* create database fafemp_web;
* grant all privileges on fafemp_web.* to fafemp_root@'localhost' identified by 'root';
*/

/**
* reglas de negocio a aplicar en las noticias, la noticia tiene un titulo, una fecha-hora, un cuerpo y (al menos por ahora) una sola imagen.
*/
DROP TABLE IF EXISTS noticias;

CREATE TABLE noticias(
    noticia_id integer not null primary key AUTO_INCREMENT,
    noticia_fec_hora timestamp not null,
    noticia_titulo varchar(100) not null,
    noticia_cuerpo text not null,
    noticia_imagen_id integer null #puede ser que no tenga imagen.
);

DROP TABLE IF EXISTS imagenes;

CREATE TABLE imagenes (
    imagen_id integer not null primary key AUTO_INCREMENT,
    imagen_path varchar(200) not null,
    imagen_nombre varchar(200) not null
);

/**
* foreign keys
*/

ALTER TABLE noticias ADD CONSTRAINT `FK_imagen_id_1` FOREIGN KEY (`noticia_imagen_id`) REFERENCES `imagenes` (`imagen_id`);


CREATE TABLE usuarios(
    usuario_user varchar(20) not null primary key,
    usuario_pass varchar(32) not null
);


