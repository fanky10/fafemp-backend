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
