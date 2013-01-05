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
    <?php include_once 'menu_header.php'?>
    <!-- First Band (Slider) -->
    <!-- The Orbit slider is initialized at the bottom of the page by calling .orbit() on #slider -->
    <div class="breadcrums">
      <div class="row">
        <div class="twelve columns">
          <ul class="inline-list">
            <li><a href="index.html">Home</a></li>
            <li>></li>
            <li>Contacto</li>
          </ul>        
        </div>
      </div>
    </div>
    <!-- Three-up Content Blocks -->
    <div class="content">
      <div class="row">
        <!-- Contact Details -->
        <div class="nine columns">
          <h3>Contacto</h3>
          <p>Por favor pongase en contacto con nosotros por cualquier duda o comentario a través de nuestro formulario de Contacto.<br>A la brevedad nos estaremos comunicando con usted. Muchas gracias!.</p>
          <form id="formInscripcion" class="validateform" method="post" action="send-mail.php">
            <h5>Formulario de Contacto</h5>
            <label for="nombre">Nombre y Apellido</label>
            <input type="text" class="twelve required" name="nombre" id="nombre" />
            <div class="row">
              <div class="six columns">
                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" class="required number" name="telefono" />
              </div>
              <div class="three columns">
                <label for="ciudad">Ciudad</label>
                <input type="text" id="ciudad" class="required" name="ciudad" />
              </div>
              <div class="three columns">
                <label for="zip">Zip</label>
                <input type="text" id="zip" class="required number" name="zip" />
              </div>
              <div class="twelve columns">
                <label for="email">Email</label>
                <input type="text" id="email" class="required email" name="email" />
              </div>
              <div class="twelve columns">
                <label for="mensaje">Mensaje</label>
                <textarea rows="4" id="mensaje" class="required" name="mensaje"></textarea>
                <button type="submit" class="radius button">Enviar</button>
                <input id="submitted" type="hidden" value="true" name="submitted">
              </div>
            </div>
          </form>
        </div>
        <!-- Sidebar -->
        <div class="three columns">
          <h3>Google Maps</h3>    
          <!-- Clicking this placeholder fires the mapModal Reveal modal -->
          <p> <a class="th" href="https://maps.google.com.ar/maps?q=Santa+Fe+3100,+Rosario,+Argentina&hl=en&ll=-32.938062,-60.665216&spn=0.009581,0.021007&sll=-38.341656,-63.28125&sspn=34.259869,86.044922&oq=Santa+Fe+3100,+Rosario+-+Argentina&hnear=Santa+Fe+3100,+Alberto+Olmedo,+Rosario,+Santa+Fe&t=m&z=16&iwloc=lyrftr:m,1173664463940107749,-32.940043,-60.665302&output=embed?iframe=true&width=100%&height=100%" rel="prettyPhoto[iframes]"><img src="images/google-maps-rosario-argentina.jpg" /></a><br />
            <a href="https://maps.google.com.ar/maps?q=Santa+Fe+3100,+Rosario,+Argentina&hl=en&ll=-32.938062,-60.665216&spn=0.009581,0.021007&sll=-38.341656,-63.28125&sspn=34.259869,86.044922&oq=Santa+Fe+3100,+Rosario+-+Argentina&hnear=Santa+Fe+3100,+Alberto+Olmedo,+Rosario,+Santa+Fe&t=m&z=16&iwloc=lyrftr:m,1173664463940107749,-32.940043,-60.665302&output=embed?iframe=true&width=100%&height=100%" rel="prettyPhoto[iframes]">Ver Mapa</a> </p>
            <p><img src="images/ico-home-black.png" alt="Dirección" /> Santa Fe 3100, Rosario - Argentina</p>
          </div>  
          <!-- End Sidebar -->
        </div>
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
