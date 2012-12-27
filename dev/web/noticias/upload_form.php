<html>
    <body>

        <form action="upload_file.php" method="POST"
              enctype="multipart/form-data">
            <label for="title">Titulo Noticia</label>
            <input id="title" type="text" name="title"/>
            <br/>
            <label for="file">Imagen:</label>
            <input type="file" name="file" id="file"/><br>
            <input type="submit" name="submit" value="Submit"/>
        </form>

    </body>
</html>