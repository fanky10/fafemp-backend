<?php
require_once ('../initTesting.php');
$width = $GLOBAL_SETTINGS['news.img.slider.width'];
$height = $GLOBAL_SETTINGS['news.img.slider.height'];
$output_filename = 'thumbnails/result.jpg';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $jpeg_quality = 90;
 
    $src = 'img/jp_landscape.jpg';
    $img_r = imagecreatefromjpeg($src);
    $dst_r = imagecreatetruecolor($width, $height);
 
    imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],$width,$height,$_POST['w'],$_POST['h']);
    imagejpeg($dst_r,time().'.jpg',$jpeg_quality);
 
//    header('Content-type: image/jpeg');
//    imagejpeg($dst_r,null,$jpeg_quality);
    imagejpeg($dst_r, $output_filename, $jpeg_quality);
    echo '<img id="result" src="'.$output_filename.'"/>';
    exit;
}

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
                        var config = {
                            sliderWidth:<?php echo $width;?>,
                            sliderHeight:<?php echo $height;?>
                        };
                        $('#target').Jcrop({
                                setSelect:   [ 0, 0, config.sliderWidth ,config.sliderHeight],
                                aspectRatio: config.sliderWidth / config.sliderHeight,
//                                minSize: [config.originalImageWidth ,config.originalImageHeight],
//                                maxSize: [config.originalImageWidth ,config.originalImageHeight],
                                onChange: showPreview,
                                onSelect: showPreview
                                

                        });
                        function showPreview(coords){
                            console.log('values: sliderWidth: '+config.sliderWidth + ', config.sliderHeight: ' + config.sliderHeight );
                            console.log('values: imageWidth: '+$('#target').width() + ', config.imageHeight: ' + $('#target').height() );
                            var rx = config.sliderWidth / coords.w;
                            var ry = config.sliderHeight / coords.h;
                            console.log('values: ratioX: '+rx + ', ratioY: ' + ry );
                            
                            var cssValues = {
                                width: Math.round(rx * $('#target').width()) + 'px',
                                height: Math.round(ry *  $('#target').height()) + 'px',
                                marginLeft: '-' + Math.round(rx * coords.x) + 'px',
                                marginTop: '-' + Math.round(ry * coords.y) + 'px'
                            }
                            console.log('values: ['+cssValues.width + ',' + cssValues.height +']');
                            $("#preview").css(cssValues);
                            updateCoords(coords);
                        }
                        
                        function updateCoords(c){
                            $('#x').val(c.x);
                            $('#y').val(c.y);
                            $('#w').val(c.w);
                            $('#h').val(c.h);
                        };
                    });

                </script>
                <img id="target" src="img/jp_landscape.jpg" >
                <br/>
                <?php
                echo '<div style="width:'.$width.'px;height:'.$height.'px;overflow:hidden;margin-left:5px;border: .2em dotted #900;">';
                    echo'<img id="preview" src="img/jp_landscape.jpg"  >';
                echo '</div>';
                ?>
                
                
                <!-- This is the form that our event handler fills -->
                <form action="?" method="POST" onsubmit="return checkCoords();">
                    <input type="hidden" id="x" name="x" />
                    <input type="hidden" id="y" name="y" />
                    <input type="hidden" id="w" name="w" />
                    <input type="hidden" id="h" name="h" />
                    <input type="hidden" id="tw" name="tw" />
                    <input type="hidden" id="th" name="th" />
                    Select a crop image size below then click: <input type="submit" value="Crop Image" />
                </form>
                    
        </div>
        
    </body>
    
</html>