<!DOCTYPE html>
<html>
    <head>
        <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
        <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
        <meta charset=utf-8 />
        <title>JS Bin</title>
        <!--[if IE]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <style>
            article, aside, figure, footer, header, hgroup, 
            menu, nav, section { display: block; }
        </style>
        <script type="text/javascript" >
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#blah')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(200);
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
            function readURL(input,width,height){
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#imgprev')
                        .attr('src', e.target.result)
                        .width(width)
                        .height(height);
                        
                    };

                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    </head>
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

        <br/>
        <input type='file' onchange="readURL(this);" />
        <br/>
        <img id="blah" src="#" alt="Here is your preview :P" />
        <br/>
        <br/>
        <!-- por si necesito usar css en el slider -->
        <div id="slider">
            <?php
            include_once '../init.php';
            $width = $GLOBAL_SETTINGS['news.img.slider.width'];
            $height = $GLOBAL_SETTINGS['news.img.slider.height'];
            $title = "Preview..."; //fill with jscript
            echo '<input type="file" onchange="readURL(this,'.$width.','.$height.');" />';
            echo '<br/>';
            echo '<img id="imgprev" src="#" /><span class="slider-caption">' . $title . '</span>';
            ?>
        </div>

    </body>
</html>