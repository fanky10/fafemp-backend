<?php
include_once '../init.php';
/**
  if ($_FILES["file"]["error"] > 0) {
  echo "Error: " . $_FILES["file"]["error"] . "<br>";
  } else {
  if(!file_exists(ROOT_DIR."/".$GLOBAL_SETTINGS["news.img.path"] )){
  echo "error! no folder to upload to :(";
  }
  echo "Titulo: " . $_POST["title"] . "<br/>";
  echo "Upload: " . $_FILES["file"]["name"] . "<br>";
  echo "Type: " . $_FILES["file"]["type"] . "<br>";
  echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
  echo "Stored in: " . $_FILES["file"]["tmp_name"]."<br>";
  echo "Configured location: " . $GLOBAL_SETTINGS["news.img.path"];
  $uploadForm = "hola?";
  $imgtmp = $_FILES["file"]["tmp_name"];
  $imgpath = ROOT_DIR."/".$GLOBAL_SETTINGS["news.img.path"] . "/" . $_FILES["file"]["name"];
  if (file_exists($imgpath)) {
  echo $_FILES["file"]["name"] . " already exists. ";
  } else {
  @move_uploaded_file($imgtmp, $imgpath) or error('receiving directory insuffiecient permission');
  echo "New location in: " . $imgpath;
  }
  }
  echo "<a href\"".$self."\"/>volver</a>";

  // The following function is an error handler which is used
  // to output an HTML error page if the file upload fails
  function error($error)
  {
  echo
  "<div id=\"Upload\">".
  '        <h1>Upload failure</h1>'.
  '        <p>An error has occurred: '.
  '        <span class="red">' . $error . '...</span>'.
  '         The upload form is reloading</p>'.
  '     </div>'.
  '</html>';
  exit;
  } // end error handler
 * 
 */
//  5MB maximum file size
$MAXIMUM_FILESIZE = 5 * 1024 * 1024;
//  Valid file extensions (images, word, excel, powerpoint)
$rEFileTypes =
        "/^\.(jpg|jpeg|gif|png|doc|docx|txt|rtf|pdf|xls|xlsx|
        ppt|pptx){1}$/i";
$dirBase = ROOT_DIR . "/" . $GLOBAL_SETTINGS["news.img.path"] . "/";

$isFile = is_uploaded_file($_FILES["file"]["tmp_name"]);
if ($_FILES["file"]["error"] > 0) {
    echo "Error: " . $_FILES["file"]["error"] . "<br>";
} else if ($isFile) {    //  do we have a file?//  sanatize file name
//     - remove extra spaces/convert to _,
//     - remove non 0-9a-Z._- characters,
//     - remove leading/trailing spaces
//  check if under 5MB,
//  check file extension for legal file types
    echo "it's a file...";
    $safe_filename = preg_replace(
            array("/\s+/", "/[^-\.\w]+/"), array("_", ""), trim($_FILES['file']['name']));
    if ($_FILES['file']['size'] <= $MAXIMUM_FILESIZE &&
            preg_match($rEFileTypes, strrchr($safe_filename, '.')) && strcmp("/Users/fanky/Sites/fafemp-backend/dev/web/news/images/", $dirBase) == 0) {
        $isMove = move_uploaded_file(
                $_FILES['file']['tmp_name'], $dirBase . $safe_filename);
        echo ($isMove ? "UPLOADED!" : "FAIL!!");
    }
} else {
    echo "Posible ataque del archivo subido: ";
    echo "nombre del archivo '" . $_FILES["file"]["tmp_name"] . "'.";
}
?> 
<?php
echo "Preview!";
echo "<br/>";
/* forma de mostrarla (un poco de css aqui please!)*/
echo "<img src=\"" . ROOT_URL. "/".$GLOBAL_SETTINGS["news.img.path"] . "/" . $safe_filename . "\" >";
?>
<br/>
<a href="upload_form.php">volver</a>