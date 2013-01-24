<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>prueba jcrop</title>
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.Jcrop.min.js"></script>
        <link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />
        <script language="Javascript">
            jQuery(function($) {
                $('#target').Jcrop(
                {
                    onSelect: updateCoords,
                    bgColor:     'black',
                    bgOpacity:   .4,
                    setSelect:   [ 100, 100, 920, 290 ],
                    aspectRatio: 92/29
                });
            });
            function showCoords(c)
            
            {
                // variables can be accessed here as
                // c.x, c.y, c.x2, c.y2, c.w, c.h
            };
            function updateCoords(c)
            {
                $('#x').val(c.x);
                $('#y').val(c.y);
                $('#w').val(c.w);
                $('#h').val(c.h);
            };
            function checkCoords()
            {
                if (parseInt($('#w').val())) return true;
                alert('Seleccione un área');
                return false;
            }; 
            
        </script>
    </head>
    <body>
        <img src="facultad.jpg" id="target" />
        <form onsubmit="return checkCoords();" method="post" action="crop.php">
            <input id="x" type="hidden" name="x" value="101">
            <input id="y" type="hidden" name="y" value="349">
            <input id="w" type="hidden" name="w" value="0">
            <input id="h" type="hidden" name="h" value="0">
            <input type="submit" value="Cortar imagen">
        </form>

    </body>
</html>

