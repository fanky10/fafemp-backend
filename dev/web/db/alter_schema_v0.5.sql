ALTER TABLE noticias ADD COLUMN noticia_slider_imagen_id integer unsigned null; 

ALTER TABLE noticias ADD CONSTRAINT `FK_noticia_id_1` FOREIGN KEY (`noticia_slider_imagen_id`) REFERENCES `imagenes` (`imagen_id`);
