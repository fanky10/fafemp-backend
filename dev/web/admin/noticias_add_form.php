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

        <title>Foro Argentino de Facultades y Escuelas de Medicina
            Públicas | ADMIN SITE</title>

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

        <!-- Header and Nav -->
        <div class="logo">
            <div class="row">
                <div class="one columns isotipo">
                    <a href="index.html"
                       title="Foro Argentino de Facultades y Escuelas de Medicina Públicas"><img
                            src="../images/logo-foro-argentino-de-facultades-y-escuelas-de-medicina-publicas.png" /></a>
                </div>
                <div class="eight columns">
                    <h2 class="slogan">Sitio Administracion - carga de noticias</h2>
                    <h1 class="logotipo">Foro Argentino de Facultades y Escuelas de
                        Medicina Públicas</h1>
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
        <div align="center" class="menu">
            <div class="row" style="height: 460px">
                <div class="four columns"></div>
                <div class="four columns" style="margin-top: 20px;">

                    <form action="noticias_add.php" method="POST"
                          enctype="multipart/form-data">
                        <ul class="nav link-list" align="center">
                            <li class="titulo" align="center">
                                <label for="titulo">Ingrese titulo de la noticia</label> 
                                <input id="titulo" class="twelve required" type="text" name="titulo">
                            </li>
                        </ul>
                        <ul class="nav link-list" align="center">
                            <li class="desc_noticia">
                                <label for="descripcion">Ingrese descripcion de la noticia</label> 
                                <textarea class="twelve required" id="cuerpo" name="cuerpo" rows="4" cols="50">
                                </textarea>
                            </li>
                        </ul>
                        <ul class="nav link-list" align="center">
                            <li class="img_noticia">
                                <label for="imagen">Seleccione imagen de la noticia</label> 
                                <input type="file" name="file" id="file"/><br>
                            </li>
                        </ul>
                        <ul class="nav link-list" align="center">
                            <li class="submit" align="center">
                                <input type="submit" name="submit" value="Submit"/>
                            </li>
                        </ul>
                    </form>

                </div>
                <div class="four columns"></div>
            </div>
        </div>
        <!-- First Band (Slider) -->
        <!-- The Orbit slider is initialized at the bottom of the page by calling .orbit() on #slider -->


        <!-- Three-up Content Blocks -->
        <div class="content">


            <!-- Footer -->
            <div class="sponsor"></div>

            <!-- Footer -->
            <div class="footer footer-line-white">
                <footer class="row">
                    <div class="twelve columns">
                        <div class="row">
                            <div class="four columns"></div>
                            <div class="four columns"></div>
                            <div class="four columns"></div>
                        </div>
                        <div class="row copyright">
                            <div class="twelve columns">
                                <hr class="footer-line" />
                                <p class="last">FAFEMP © 2013 - Foro Argentino de Facultades
                                    y Escuelas de Medicina Públicas.</p>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
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
            <script src="javascripts/app.js"></script>
            <script src="javascripts/init.js"></script>

            <script type="text/javascript">
                $(window).load(function() {
                    $('#slider').orbit({
                        animation : 'fade',
                        pauseOnHover : true,
                        startClockOnMouseOut : true,
                        bullets : true, // true or false to activate the bullet navigation
                        bulletThumbs : true
                    });
                });
                $(document).ready(function() {
                    $("a[rel^='prettyPhoto']").prettyPhoto({
                        theme : 'facebook',
                        social_tools : false
                    });
                });
            </script>
    </body>
</html>
