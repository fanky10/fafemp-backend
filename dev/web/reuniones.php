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

        <title>Foro Argentino de Facultades y Escuelas de Medicina Públicas | Home</title>

        <!-- Included CSS Files (Uncompressed) -->
        <!--
        <link rel="stylesheet" href="stylesheets/foundation.css">
        -->

        <!-- Included CSS Files (Compressed) -->
        <link rel="stylesheet" href="stylesheets/foundation.css">
        <link rel="stylesheet" href="stylesheets/app.css">
        <link rel="stylesheet" href="stylesheets/prettyPhoto.css">
        
		<link rel='stylesheet' type='text/css' href='fullcalendar/fullcalendar.css' />
		<link rel='stylesheet' type='text/css' href='fullcalendar/fullcalendar.print.css' media='print' />
		<script type='text/javascript' src='jquery/jquery-1.8.1.min.js'></script>
		<script type='text/javascript' src='jquery/jquery-ui-1.8.23.custom.min.js'></script>
		<script type='text/javascript' src='fullcalendar/fullcalendar.min.js'></script>

        <!-- Author -->
        <link type="text/plain" rel="author" href="humans.txt" />

        <?php include_once 'reuniones_list.php'; ?>
		
		<style type='text/css'>
		
			body {
				margin-top: 40px;
				text-align: center;
				font-size: 14px;
				font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
				}
		
			#calendar {
				width: 750px;
				margin: 0 auto;
				}
		
		</style>
        
    </head>
    <body>
		<!-- Header and Nav -->
        <?php include_once 'header.php'; ?>

        <!-- End Header and Nav -->
        <?php $seccion = "reuniones";
        include_once 'menu_header.php'; ?>
        <!-- First Band (Slider) -->
        <!-- The Orbit slider is initialized at the bottom of the page by calling .orbit() on #slider -->
        <?php
        $navigateTitle = "Reuniones";
        include_once 'navigate.php'
        ?>

        <!-- Three-up Content Blocks -->
        <div class="content">
        	<div class="row">
        		<div class="twelve columns">
                    <hr class="sin-margin-top" />
                </div>
        		<div class="twelve columns">	
        			<div id='calendar'></div>
				</div>
			</div>
		</div>

        <!-- Footer -->
        <?php include_once 'footer.php'; ?> 

        <!-- Initialize JS Plugins -->
        <script src="javascripts/jquery.prettyPhoto.js"></script>
        <script src="javascripts/jquery_validate.js"></script>
        <script src="javascripts/app.js"></script>
        <script src="javascripts/init.js"></script>

    </body>
</html>
