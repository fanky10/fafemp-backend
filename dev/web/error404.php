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

        <!-- Author -->
        <link type="text/plain" rel="author" href="humans.txt" />

        <script src="javascripts/modernizr.foundation.js"></script>
    </head>
    <body>

        <!-- Header and Nav -->
        <div class="logo">
            <div class="row">
                <div class="one columns isotipo">
                    <a href="index.html" title="Foro Argentino de Facultades y Escuelas de Medicina Públicas"><img src="images/logo-foro-argentino-de-facultades-y-escuelas-de-medicina-publicas.png" /></a></div>
                <div class="eight columns">
                    <h2 class="slogan">Contribuyendo a formar los profesionales de la salud que el país necesita</h2>
                    <h1 class="logotipo">Foro Argentino de Facultades y Escuelas de Medicina Públicas</h1>
                </div>
                <div class="three columns">
                    <ul class="social-box link-list right">
                        <li><a href="#" class="facebook">Facebook</a></li>
                        <li><a href="#" class="twitter">Twitter</a></li>
                        <li><a href="#" class="linkedin">LinkedIn</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- End Header and Nav -->
        <?php include_once 'menu_header.php' ?>
        <!-- First Band (Slider) -->
        <!-- The Orbit slider is initialized at the bottom of the page by calling .orbit() on #slider -->
        <?php
        $navigateTitle = "Error";
        include_once 'navigate.php'
        ?>
        <!-- Three-up Content Blocks -->
        <div class="content">
            <div class="row">
                <!-- Contact Details -->
                <div class="eight columns">
                    <h3>Error</h3>
                    <p>La página que ha solicitado no existe, estamos trabajando sobre ella.<br>Cualquier duda pongase en contacto a tráves de nuestro formulario de <a href="contacto.php">Contacto</a>.</p>
                </div>
                <!-- End Sidebar -->
            </div>
        </div>

        <!-- Footer -->
        <?php include_once 'footer.php'; ?>
        <!-- Included JS Files (Uncompressed) -->
        <!--
        
        <script src="javascripts/jquery.js"></script>
        
        <script src="javascripts/jquery.foundation.mediaQueryToggle.js"></script>
        
        <script src="javascripts/jquery.foundation.forms.js"></script>
        
        <script src="javascripts/jquery.foundation.reveal.js"></script>
        
        <script src="javascripts/jquery.foundation.orbit.js"></script>
        
        <script src="javascripts/jquery.foundation.navigation.js"></script>
        
        <script src="javascripts/jquery.foundation.buttons.js"></script>
        
        <script src="javascripts/jquery.foundation.tabs.js"></script>
        
        <script src="javascripts/jquery.foundation.tooltips.js"></script>
        
        <script src="javascripts/jquery.foundation.accordion.js"></script>
        
        <script src="javascripts/jquery.placeholder.js"></script>
        
        <script src="javascripts/jquery.foundation.alerts.js"></script>
        
        <script src="javascripts/jquery.foundation.topbar.js"></script>
        
        <script src="javascripts/jquery.foundation.joyride.js"></script>
        
        <script src="javascripts/jquery.foundation.clearing.js"></script>
        
        <script src="javascripts/jquery.foundation.magellan.js"></script>
        
        -->

        <!-- Included JS Files (Compressed) -->
        <script src="javascripts/jquery.js"></script>
        <script src="javascripts/foundation.min.js"></script>

        <!-- Initialize JS Plugins -->
        <script src="javascripts/jquery.prettyPhoto.js"></script>
        <script src="javascripts/jquery_validate.js"></script>
        <script src="javascripts/app.js"></script>
        <script src="javascripts/init.js"></script>

        <script type="text/javascript">
            $(function(){
                $('#formInscripcion').validate({
                    rules: {
                        'nombre': 'required',
                        'telefono': { required: true, number: true },
                        'ciudad': 'required',
                        'zip': { required: true, number: true },
                        'email': { required: true, email: true },
                        'mensaje': 'required' 
                    },
                    messages: {
                        'nombre': 'Debe ingresar el nombre.',
                        'apellido': 'Debe ingresar el apellido.',
                        'ciudad': 'Debe ingresar su ciudad.',
                        'telefono': { required: 'Debe ingresar su número de teléfono.', number: 'Debe ingresar un número.' },
                        'zip': { required: 'Debe ingresar el codigo de área de su ciudad.', number: 'Debe ingresar un número.' },
                        'email': { required: 'Debe ingresar un correo electrónico.', email: 'Debe ingresar el correo electrónico con el formato correcto. Por ejemplo: sunombre@localhost.com.' },
                        'mensaje': 'Por favor ingrese su mensaje.'
                    },
                    submitHandler: function(form) {
                        form.submit();
                    }
                });
            });
            $(document).ready(function(){
                $("a[rel^='prettyPhoto']").prettyPhoto({
                    theme: 'facebook',
                    social_tools: false
                });
            });
        </script>

    </body>
</html>
