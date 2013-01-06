<?php include 'admin_check.php' ?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8" />

    <!-- Set the viewport width to device width for mobile -->
    <meta name="viewport" content="width=device-width" />

    <title>Foro Argentino de Facultades y Escuelas de Medicina Públicas | Sitio Administración</title>

    <!-- Included CSS Files (Uncompressed) -->
    <!--
    <link rel="stylesheet" href="stylesheets/foundation.css">
    -->

    <!-- Included CSS Files (Compressed) -->
    <link rel="stylesheet" href="../stylesheets/foundation.css">
    <link rel="stylesheet" href="../stylesheets/app.css">
    <link rel="stylesheet" href="../stylesheets/prettyPhoto.css">

    <!-- Author -->
    <link type="text/plain" rel="author" href="humans.txt" />

    <script src="javascripts/modernizr.foundation.js"></script>
</head>
<body>

    <?php
    include_once 'admin_header.php';
    ?>

    <!-- The Orbit slider is initialized at the bottom of the page by calling .orbit() on #slider -->
		<div class="breadcrums">
			<div class="row">
				<div class="twelve columns">
					<ul class="inline-list">
						<li><a href="index.html">Admin Panel</a></li>
						<li>></li>
						<li>Menu Administrador</li>
					</ul>
				</div>
			</div>
		</div>
	
		<!-- Three-up Content Blocks -->
	
		<div class="content">
			<div class="row">
				<div class="nine columns">
					
					<div class="row" align="center">
					
						<div class="twelve columns">
							<br/><br/>
						</div>
					
						<div class="twelve columns">
							<form id="form1" name="form1" method="post" action="cambio_pass_form.php">
								<input type="submit" name="cambio_pass" id="logout" value="Cambiar contraseña" />
							</form>
						</div>
						<div class="twelve columns">
							<br/>
						</div>
						<div class="twelve columns">
							<form id="form2" name="form2" method="post" action="logout.php">
								<input type="submit" name="logout" id="logout" value="Desconectarme" />
							</form>
						</div>
						<div class="twelve columns">
							<br/>
						</div>
						<div class="twelve columns">
							<form id="form2" name="form2" method="post" action="noticias_carga.php">
								<input type="submit" name="add_noticia" id="add_noticia" value="Cargar noticia" />
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
    


    <?php include_once 'admin_footer.php'; ?>
    <!-- Included JS Files (Compressed) -->
    <script src="javascripts/jquery.js"></script>
    <script src="javascripts/foundation.min.js"></script>

    <!-- Initialize JS Plugins -->
    <script src="javascripts/jquery.prettyPhoto.js"></script>
    <script src="javascripts/app.js"></script>
    <script src="javascripts/init.js"></script>

</body>
</html>



<?php
$msg = "Bienvenido " . $_SESSION['user'];
?>
<!--
<html>
<head>
    <title>User Panel</title>
</head>
<body>
<p> <?php // echo $msg;     ?> </p>

<form id="form2" name="form2" method="post" action="cambio_pass_form.php">
  <input type="submit" name="cambio_pass" id="logout" value="Cambiar contraseña" />
</form>

<form id="form2" name="form3" method="post" action="logout.php">
  <input type="submit" name="logout" id="logout" value="Desconectarme" />
</form>

<a href="noticias_add_form.php">Cargar nueva noticia!</a>
<a href="noticias_carga.php">Cargar nueva noticia! (Poli style)</a>


</body>
</html>-->