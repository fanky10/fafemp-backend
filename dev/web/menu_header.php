<div class="menu">
    <div class="row">
        <div class="twelve columns menu-wrapper">
            <ul class="nav link-list">
                <?php if ($seccion == "home") {
                    echo '<li class="active">';
                } else {
                    echo "<li>";
                };
                ?>
                <a href="index.php" title="Home">Home</a></li>
            
                <li>|</li>
                
                <?php if ($seccion == "nosotros") {
                    echo '<li class="active">';
                } else {
                    echo "<li>";
                };
                ?>
                <a href="nosotros.php" title="Nosotros">Nosotros</a></li>
            
                <li>|</li>
                
                <li><a href="campus-virtual.html" title="Campus Virtual">Campus Virtual</a></li>
                <li>|</li>
                <li><a href="foro.html" title="Foro">Foro</a></li>
                <li>|</li>
                <li><a href="comisiones-de-trabajo.html" title="Comisiones de Trabajo">Comisiones de Trabajo</a></li>
                <li>|</li>
                <li><a href="congreso-de-decanos.html" title="Congreso de Decanos">Congreso de Decanos</a></li>
                <li>|</li>
                <li><a href="autoridades.html" title="Autoridades">Autoridades</a></li>
                <li>|</li>
                
                <?php if ($seccion == "contacto") {
                    echo '<li class="active">';
                } else {
                    echo "<li>";
                };
                ?>
                <a href="contacto.php" title="Contacto">Contacto</a></li>
            
                <li>|</li>
                
                <?php if ($seccion == "noticias") {
                    echo '<li class="active">';
                } else {
                    echo "<li>";
                };
                ?>
                <a href="noticias.php" title="Noticias">Noticias</a></li>
            </ul>
        </div>
    </div>
</div>