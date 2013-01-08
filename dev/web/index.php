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
        <?php include_once 'header.php'; ?>

        <!-- End Header and Nav -->
        <?php include_once 'menu_header.php'; ?>
        <!-- First Band (Slider) -->
        <!-- The Orbit slider is initialized at the bottom of the page by calling .orbit() on #slider -->
        <div class="multimedia">
            <div class="row">
                <div class="twelve columns sin-padding">
                    <?php include_once 'slider.php' ?>
                </div>
            </div>
        </div>


        <!-- Three-up Content Blocks -->
        <div class="content">
            <div class="row">
                <div class="twelve columns">
                    <hr class="sin-margin-top" />

                </div>
                <div class="eight columns">
                    <h3>Propósitos del Foro</h3>
                    <p class="text-justify">Las Facultades y Escuelas de Medicina de Gestión Pública de la
                        República Argentina, en oportunidad de encontrarse reunidas sus
                        principales autoridades en la Secretaría de Políticas Universitarias
                        del Ministerio de Educación de la Nación el día 13 de abril de 2011,
                        a instancias del programa de mejoramiento de la enseñanza de la
                        medicina (PROMED), resolvieron fortalecer los lazos académicos e
                        institucionales, constituyendo el FAFEMP.</p>
                    <p class="text-justify">El propósito orientador de la misión institucional del Foro es el de
                        coadyuvar en la generación de políticas de salud en general, y de
                        educación médica en particular, a todos sus niveles y en todo el
                        ámbito de la Nación, constituyéndose en interlocutor de los
                        Ministerios de Salud, de Educación, y demás estructuras
                        gubernamentales.</p>
                    <p class="text-justify">Los objetivos y actividades contempladas en los orígenes del Foro
                        incluyen aportar ideas y proyectos, y efectuar recomendaciones y
                        propuestas en el campo de la educación en ciencias de la salud;
                        promover acciones de intercambio académico y científico entre
                        docentes e investigadores; desarrollar programas de intercambio
                        estudiantil, que permitan compartir situaciones de aprendizaje en
                        distintos ámbitos académicos y geográficos; adoptar medidas que
                        permitan compartir recursos educativos de generación propia, y
                        bases de datos bibliográficos; e integrar una red académicoasistencial,
                        como aporte solidario a la salud de poblaciones
                        subatendidas del país y el continente, generando guías académicas
                        de diagnóstico y tratamiento de enfermedades regionales
                        prevalentes y alternativas de segunda opinión médica a distancia.</p>
                </div>

                <div class="four columns">
                    <h3>Unidades académicas participantes</h3>
                    <a href="https://maps.google.com.ar/maps/ms?msid=206810590642046489742.0004d26020155865bcfe4&msa=0&ll=-33.998027,-61.21582&spn=10.121215,20.214844&t=m&output=embed?iframe=true&width=100%&height=100%" rel="prettyPhoto[iframes]">
                        <img src="images/mapa-argentina-fafemp.png" alt="Google Maps - Argentina" /> 
                    </a>
                </div>

            </div>
        </div>

        <!-- Footer -->
        <?php include_once 'sponsor_footer.php'; ?>

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
        <script src="javascripts/app.js"></script>
        <script src="javascripts/init.js"></script>

        <script type="text/javascript">
            $(window).load(function() {
                $('#slider').orbit({
                    animation: 'fade',      
                    pauseOnHover: true,
                    startClockOnMouseOut: true, 
                    bullets: true, // true or false to activate the bullet navigation
                    bulletThumbs: true
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
