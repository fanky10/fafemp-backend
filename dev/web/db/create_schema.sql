/**
* localhost configuration for user.
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

DROP TABLE IF EXISTS imagenes;

/**
* una noticia, puede tener muchas imagenes, una imagen pertenece a una noticia.
*/
CREATE TABLE imagenes (
    imagen_id integer unsigned not null primary key AUTO_INCREMENT,
    imagen_path varchar(200) not null,
    imagen_nombre varchar(200) not null,
    imagen_eliminada TINYINT(1) default 0,
    imagen_fec_hora timestamp not null default current_timestamp,
    imagen_nombre_archivo varchar(200) not null
)ENGINE=InnoDB;

DROP TABLE IF EXISTS imagenes_noticia;

CREATE TABLE imagenes_noticia (
    imagen_id integer unsigned not null,
    noticia_id integer unsigned not null, #una imagen no puede no saber a que noticia pertenece
    imagen_orden integer unsigned not null,
    primary key(imagen_id)#de esta forma una imagen tiene una noticia y una noticia muchas imagenes.
)ENGINE=InnoDB;

/**
* foreign keys
*/

ALTER TABLE imagenes_noticia ADD CONSTRAINT `FK_imagenes_noticia_id_1` FOREIGN KEY (`noticia_id`) REFERENCES `noticias` (`noticia_id`);
ALTER TABLE imagenes_noticia ADD CONSTRAINT `FK_imagenes_noticia_id_2` FOREIGN KEY (`imagen_id`) REFERENCES `imagenes` (`imagen_id`);


/**
* table usuario
*/


DROP TABLE IF EXISTS usuarios;

CREATE TABLE usuarios(
    usuario_user varchar(20) not null primary key,
    usuario_pass varchar(32) not null
)ENGINE=InnoDB;

/* REUNIONES */
DROP TABLE IF EXISTS reuniones;

CREATE TABLE reuniones(
    reunion_id integer unsigned not null primary key AUTO_INCREMENT,
    reunion_fec_ini datetime not null,
    reunion_fec_fin datetime not null,
    reunion_titulo varchar(100) not null,
    reunion_cuerpo text not null,
    reunion_eliminada TINYINT(1) default 0
)ENGINE=InnoDB;

DROP TABLE IF EXISTS imagenes_reunion;

/**
* una reunion, puede tener muchas imagenes, una imagen pertenece a una reunion.
*/

CREATE TABLE imagenes_reunion (
    imagen_id integer unsigned not null,
    reunion_id integer unsigned not null,
    imagen_orden integer unsigned not null,
    primary key (imagen_id)
)ENGINE=InnoDB;

/**
* foreign keys
*/

ALTER TABLE imagenes_reunion ADD CONSTRAINT `FK_imagenes_reunion_id_1` FOREIGN KEY (`reunion_id`) REFERENCES `reuniones` (`reunion_id`);
ALTER TABLE imagenes_reunion ADD CONSTRAINT `FK_imagenes_reunion_id_2` FOREIGN KEY (`imagen_id`) REFERENCES `imagenes` (`imagen_id`);


/* FIN REUNIONES*/


/* DOCUMENTOS */

DROP TABLE IF EXISTS documentos;

/**
* una noticia, puede tener muchas imagenes, una imagen pertenece a una noticia.
*/
CREATE TABLE documentos (
    documento_id integer unsigned not null primary key AUTO_INCREMENT,
    documento_path varchar(200) not null,
    documento_nombre varchar(200) not null,
    documento_eliminada TINYINT(1) default 0,
    documento_fec_hora timestamp not null default current_timestamp,
    documento_nombre_archivo varchar(200) not null
)ENGINE=InnoDB;


/**
* TABLE  documentos_reunion
*/

DROP TABLE IF EXISTS documentos_reunion;

CREATE TABLE documentos_reunion (
    documento_id integer unsigned not null,
    reunion_id integer unsigned not null,
    documento_orden integer unsigned not null,
    primary key (documento_id)
)ENGINE=InnoDB;

/**
* foreign keys
*/

ALTER TABLE documentos_reunion ADD CONSTRAINT `FK_documentos_reunion_id_1` FOREIGN KEY (`reunion_id`) REFERENCES `reuniones` (`reunion_id`);
ALTER TABLE documentos_reunion ADD CONSTRAINT `FK_documentos_reunion_id_2` FOREIGN KEY (`documento_id`) REFERENCES `documentos` (`documento_id`);



/**
* TABLE  documentos_noticia
*/

DROP TABLE IF EXISTS documentos_noticia;


CREATE TABLE documentos_noticia (
    documento_id integer unsigned not null,
    noticia_id integer unsigned not null, #un documento puede no saber a que noticia pertenece
    documento_orden integer unsigned not null,
    primary key(documento_id)#de esta forma un documento tiene una noticia y una noticia muchos documentos.
)ENGINE=InnoDB;

/**
* foreign keys
*/

ALTER TABLE documentos_noticia ADD CONSTRAINT `FK_documentos_noticia_id_1` FOREIGN KEY (`noticia_id`) REFERENCES `noticias` (`noticia_id`);
ALTER TABLE documentos_noticia ADD CONSTRAINT `FK_documentos_noticia_id_2` FOREIGN KEY (`documento_id`) REFERENCES `documentos` (`documento_id`);




/* FIN DOCUMENTOS*/