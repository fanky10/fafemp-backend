/**
* first time you execute the sql script, as root create dabase and grant privileges to it.
* create database fafemp_web;
* grant all privileges on fafemp_web.* to fafemp_root@'localhost' identified by 'root';
*/
drop database if exists fafemp_web;
create database fafemp_web;
grant all privileges on fafemp_web.* to fafemp_root@'localhost' identified by 'root';
connect fafemp_web;
/**
* reglas de negocio a aplicar en las noticias, la noticia tiene un titulo, una fecha-hora, un cuerpo y (al menos por ahora) una sola imagen.
*/
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
    imagen_noticia_id integer unsigned not null #una imagen no puede no saber de que noticia es
)ENGINE=InnoDB;

/**
* foreign keys
*/

ALTER TABLE imagenes_noticia ADD CONSTRAINT `FK_imagenes_noticia_id_1` FOREIGN KEY (`imagen_noticia_id`) REFERENCES `noticias` (`noticia_id`);

DROP TABLE IF EXISTS usuarios;

CREATE TABLE usuarios(
    usuario_user varchar(20) not null primary key,
    usuario_pass varchar(32) not null
)ENGINE=InnoDB;


