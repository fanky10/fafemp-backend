<?php
require_once ('../initTesting.php');
$width = $GLOBAL_SETTINGS['news.img.slider.width'];
$height = $GLOBAL_SETTINGS['news.img.slider.height'];
?>
<html>
    <head>
        <script src="js/jquery.min.js"></script>
        <script src="js/jquery.Jcrop.min.js"></script>
        <link rel="stylesheet" href="css/jquery.Jcrop.css" type="text/css" />
    </head>
    <body>
        <div id="pbody">

                <h1><b>Jcrop</b> Test DEMO</h1>
                <script language="Javascript">
                    $(function() {
                        $('#target').Jcrop({
                                setSelect:   [ 0, 0, 500, 200 ],
                                minSize:[500,200],
                                maxSize:[500,200],
                                onChange: showPreview,
                                onSelect:    showPreview
                                

                        });
                        function showPreview(coords){
                            $("#preview").css({
                                marginLeft: '-' + Math.round(coords.x) + 'px',
                                marginTop: '-' + Math.round(coords.y) + 'px'
                            });
                        }
                    });

                </script>
                <img id="target" src="http://1.bp.blogspot.com/_EDFqmuHfAF0/S8n4HgX3R9I/AAAAAAAAEYs/96LX6FPp0fo/s1600/Karina+Jelinek-109.jpg" >
                <br/>
                <div style="width:500px;height:200px;overflow:hidden;margin-left:5px;border: .2em dotted #900;">
                    <img id="preview" src="http://1.bp.blogspot.com/_EDFqmuHfAF0/S8n4HgX3R9I/AAAAAAAAEYs/96LX6FPp0fo/s1600/Karina+Jelinek-109.jpg"  >
                </div>
                    
                    
        </div>
        
    </body>
    
</html>