<<<<<<< HEAD
<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
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
        <div align="center" class="menu">
            <div class="row" style="height:460px" >
                <div class="four columns"></div>
                <div class="four columns" style="margin-top: 150px;" >
                    <form id="login" name="login" method="POST" action="index.php">
                        <ul class="nav link-list" align="center">
                            <li class="usuario" align="center">
                                <label for="usuario">Ingrese Usuario</label>
                                <input id="usuario" class="twelve required" type="text" name="user">
                            </li>
                        </ul>
                        <ul class="nav link-list" align="center">
                            <li class="password">
                                <label for="password">Ingrese Pasword</label>
                                <input id="password" class="twelve required" type="password" name="pass">
                            </li>
                        </ul>
                        <ul class="nav link-list" align="center">
                            <li class="login" align="center">
                                <button type="submit" class="radius button">login</button>
                                <input id="submitted" type="hidden" value="true" name="submitted">
                            </li>
                        </ul>
                    </form>
                    <p style="text-align:left">
                        <label class="error" for="email" generated="true">
                            <?php
                            if (isset($_GET['msg']) && $_GET['msg'] == "error") {
                                echo "Usuario o contraseña incorrectos";
                            }
                            ?>
                        </label>
                    </p>
                </div>
                <div class="four columns"></div>
            </div>
        </div>
        <!-- First Band (Slider) -->
        <!-- The Orbit slider is initialized at the bottom of the page by calling .orbit() on #slider -->


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
=======
<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->
<head>
<meta charset="utf-8" />

<!-- Set the viewport width to device width for mobile -->
<meta name="viewport" content="width=device-width" />

<title>Foro Argentino de Facultades y Escuelas de Medicina Públicas |
	Sitio Administración</title>

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

	<!-- First Band (Slider) -->
	<!-- The Orbit slider is initialized at the bottom of the page by calling .orbit() on #slider -->
	<div class="breadcrums">
		<div class="row">
			<div class="twelve columns">
				<ul class="inline-list">
					<li><a href="index.html">Home</a></li>
					<li>></li>
					<li>Login Admin</li>
				</ul>
			</div>
		</div>
	</div>

	<!-- Three-up Content Blocks -->
	<div class="content">
		<div class="row">
			<!-- Contact Details -->
			<div class="nine columns">
				<h3>Login Administrador de noticias</h3>
				<p>Ingrese usuario y password para ingresar al administrador de
					noticias.</p>
				<form id="login" name="login" method="POST" action="index.php">
					<h5>Login</h5>
					<br /> <br />
					<div class="row">
						<div class="four columns">
							<label for="usuario">Ingrese Usuario</label> 
							<input id="usuario" class="twelve required" type="text" name="user">
						</div>
						<div class="four columns">
							<label for="password">Ingrese Pasword</label> 
							<input id="password" class="twelve required" type="password" name="pass">
						</div>
						<div class="four columns">
							<br/>
							<button type="submit" class="radius button">login</button>
							<input id="submitted" type="hidden" value="true" name="submitted">
						</div>
					</div>
					<br/><br/>
				</form>
				<p style="text-align: left">
					<?php 
					if(isset($_GET['msg']) && $_GET['msg']=="error"){
                            echo "Usuario o contraseña incorrectos";
                        }

                        ?>
				</p>
			</div>
		</div>
	</div>


	<!-- The Orbit slider is initialized at the bottom of the page by calling .orbit() on #slider -->


	<?php include_once 'admin_footer.php';?>

	<!-- Included JS Files (Compressed) -->
	<script src="javascripts/jquery.js"></script>
	<script src="javascripts/foundation.min.js"></script>

	<!-- Initialize JS Plugins -->
	<script src="javascripts/jquery.prettyPhoto.js"></script>
	<script src="javascripts/app.js"></script>
	<script src="javascripts/init.js"></script>

</body>
</html>
>>>>>>> origin/master
