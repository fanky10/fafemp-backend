<html>
    <body>

        <form action="noticias_add.php" method="POST"
              enctype="multipart/form-data">
            <label for="titulo">Titulo Noticia</label>
            <input id="titulo" type="text" name="titulo"/>
            <br/>
            <label for="cuerpo">Cuerpo Noticia</label>
            <!--
            <input id="cuerpo" type="text" name="cuerpo"/>
            -->
            <textarea id="cuerpo" name="cuerpo" rows="4" cols="50">
                Ponga aqui un texto (:
            </textarea> 
            <br/>
            <label for="file">Imagen:</label>
            <input type="file" name="file" id="file"/><br>
            <input type="submit" name="submit" value="Submit"/>
        </form>

    </body>
</html>