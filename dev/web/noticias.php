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
        <?php include_once 'menu_header.php';?>
        <!-- First Band (Slider) -->
        <!-- The Orbit slider is initialized at the bottom of the page by calling .orbit() on #slider -->
        <div class="breadcrums">
            <div class="row">
                <div class="twelve columns">
                    <ul class="inline-list">
                        <li><a href="index.html">Home</a></li>
                        <li>></li>
                        <li>Noticias</li>
                    </ul>        
                </div>
            </div>
        </div>
        <!-- Three-up Content Blocks -->
        <div class="content">

            <?php include_once 'noticias_list.php'; ?>

        </div>

        <!-- Footer -->
        <div class="footer footer-line-gray">
            <footer class="row">
                <div class="twelve columns">
                    <div class="row">
                        <div class="four columns">
                            <h4>Contacto</h4>
                            <p class="last"><img src="images/ico-phone.png" alt="Teléfono" /> Tel: (0341) - 555555</p>
                            <p class="last"><img src="images/ico-phone.png" alt="Teléfono" /> Fax: (0341) - 555555</p>
                            <p><img src="images/ico-mail.png" alt="Mail" /> E-mail: <a href="mailto:info@fafemp.org">info@fafemp.org</a></p>
                            <p class="last"><img src="images/ico-home.png" alt="Dirección" /> <a href="https://maps.google.com.ar/maps?q=Santa+Fe+3100,+Rosario,+Argentina&hl=en&ll=-32.938062,-60.665216&spn=0.009581,0.021007&sll=-38.341656,-63.28125&sspn=34.259869,86.044922&oq=Santa+Fe+3100,+Rosario+-+Argentina&hnear=Santa+Fe+3100,+Alberto+Olmedo,+Rosario,+Santa+Fe&t=m&z=16&iwloc=lyrftr:m,1173664463940107749,-32.940043,-60.665302&output=embed?iframe=true&width=100%&height=100%" rel="prettyPhoto[iframes]">Santa Fe 3100, Rosario - Argentina</a></p>
                        </div>
                        <div class="four columns">
                            <h4>Google Maps</h4>
                            <a href="https://maps.google.com.ar/maps?q=Santa+Fe+3100,+Rosario,+Argentina&hl=en&ll=-32.938062,-60.665216&spn=0.009581,0.021007&sll=-38.341656,-63.28125&sspn=34.259869,86.044922&oq=Santa+Fe+3100,+Rosario+-+Argentina&hnear=Santa+Fe+3100,+Alberto+Olmedo,+Rosario,+Santa+Fe&t=m&z=16&iwloc=lyrftr:m,1173664463940107749,-32.940043,-60.665302&output=embed?iframe=true&width=100%&height=100%" rel="prettyPhoto[iframes]"><img src="images/google-maps-rosario-argentina.png" alt="Google Maps - Rosario - Argentina" /></a>
                        </div>
                        <div class="four columns">
                            <h4>Contacto Social</h4>
                            <ul class="social-box link-list">
                                <li><a href="#" class="facebook">Facebook</a></li>
                                <li><a href="#" class="twitter">Twitter</a></li>
                                <li><a href="#" class="linkedin">LinkedIn</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="row copyright">
                        <div class="twelve columns">
                            <hr class="footer-line" />
                            <p class="last">FAFEMP © 2013 - Foro Argentino de Facultades y Escuelas de Medicina Públicas.</p>
                        </div>
                    </div>
                </div> 
            </footer>
        </div>

        <!-- Included JS Files (Compressed) -->
        <script src="javascripts/jquery.js"></script>
        <script src="javascripts/foundation.min.js"></script>

        <!-- Initialize JS Plugins -->
        <script src="javascripts/jquery.prettyPhoto.js"></script>
        <script src="javascripts/jquery_validate.js"></script>
        <script src="javascripts/app.js"></script>
        <script src="javascripts/init.js"></script>

    </body>
</html>
