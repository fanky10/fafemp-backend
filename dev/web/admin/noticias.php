<?php include 'admin_check.php' ?>
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

        <script src="../javascripts/modernizr.foundation.js"></script>
    </head>
    <body>

        <?php
        include_once 'admin_header.php';
        include_once 'admin_menu.php';
        $navigateTitle = "Noticias";
        include_once 'admin_navigate.php';
        ?>

        <!-- Three-up Content Blocks -->
        <div class="content">
            <div class="row">
                <!-- Contact Details -->
                <div class="twelve columns">
                    <h3>Listado de Noticias</h3>
                    <p>Desde la siguiente lista de noticias podras editar y eliminar noticias ya cargadas.</p>
                    
                    <div class="row">
                        <div class="two columns">
                            <h5>Titulo</h5>
                        </div>
                        <div class="four columns">
                            <h5>Descripcion</h5>
                        </div>
                        <div class="two columns">
                            <h5>Fecha</h5>
                        </div>
                        <div class="two columns">
                        </div>
                        <div class="two columns">
                        </div>

                    </div>

                    <?php
                    $i = 0;
                    while ($i < 5) {
                        $i++;
                        ?>
                        <div class="row">
                            <div class="two columns">
                                Reunion de medicos de Rosario
                            </div>
                            <div class="four columns">
                                Se reunieron un monton de medicos para decidir el futuro de la facultad de medicina.
                            </div>
                            <div class="two columns">
                                21/12/2012
                            </div>
                            <div class="two columns" align="center">
                                <?php
                                    $linkEdicion = "noticias_edicion.php?id=".$i;
                                    echo '<a href="'.$linkEdicion.'"><img src="../images/edit-32.png" alt="Editar" /></a>';
                                ?>
                                
                            </div>
                            <div class="two columns" align="center">
                                <?php
                                    $linkEliminar = "noticias_eliminar.php?id=".$i;
                                    echo '<a href="'.$linkEliminar.'"><img src="../images/delete-32.png" alt="Eliminar" /></a>';
                                ?>
                                
                            </div>
                            <div class="twelve columns footer-line"></div>
                        </div>
                        
                        <?php
                        
                    }
                    ?>
                    <a href="noticias_carga.php"><button type="submit" name="submit" class="radius button">Agregar Noticia</button></a>
                    <!-- 
                  <div class="row">
                    <div class="two columns">
                      Reunion de medicos de Rosario
                    </div>
                    <div class="four columns">
                      Se reunieron un monton de medicos para decidir el futuro de la facultad de medicina.
                    </div>
                    <div class="two columns">
                      21/12/2012
                    </div>
                    <div class="two columns" align="center">
                      <a href="edit.html"><img src="../images/edit-32.png" alt="Editar" /></a>
                    </div>
                    <div class="two columns" align="center">
                      <a href="delete.html"><img src="../images/delete-32.png" alt="Eliminar" /></a>
                    </div>
                    <div class="twelve columns footer-line"></div>
                  </div>
                  
                  
                  <div class="row">
                    <div class="two columns">
                      Reunion de medicos de Rosario
                    </div>
                    <div class="four columns">
                      Se reunieron un monton de medicos para decidir el futuro de la facultad de medicina.
                    </div>
                    <div class="two columns">
                      21/12/2012
                    </div>
                    <div class="two columns" align="center">
                      <a href="edit.html"><img src="../images/edit-32.png" alt="Editar" /></a>
                    </div>
                    <div class="two columns" align="center">
                      <a href="delete.html"><img src="../images/delete-32.png" alt="Eliminar" /></a>
                    </div>
                    <div class="twelve columns footer-line"></div>
                  </div>
                  
                  
                  <div class="row">
                    <div class="two columns">
                      Reunion de medicos de Rosario
                    </div>
                    <div class="four columns">
                      Se reunieron un monton de medicos para decidir el futuro de la facultad de medicina.
                    </div>
                    <div class="two columns">
                      21/12/2012
                    </div>
                    <div class="two columns" align="center">
                      <a href="edit.html"><img src="../images/edit-32.png" alt="Editar" /></a>
                    </div>
                    <div class="two columns" align="center">
                      <a href="delete.html"><img src="../images/delete-32.png" alt="Eliminar" /></a>
                    </div>
                  </div>
                    -->


                </div>
            </div>
        </div>

        <?php include_once 'admin_footer.php'; ?>


    </body>
</html>
