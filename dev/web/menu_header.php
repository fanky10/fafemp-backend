<div class="menu">
    <div class="row">
        <div class="twelve columns menu-wrapper">
            <ul class="nav link-list">
                <?php
                if ($seccion == "home") {
                    echo '<li class="active">';
                } else {
                    echo "<li>";
                };
                ?>
                <a href="index.php" title="Home">Home</a></li>

                <li>|</li>

                <?php
                if ($seccion == "nosotros") {
                    echo '<li class="active">';
                } else {
                    echo "<li>";
                };
                ?>
                <a href="nosotros.php" title="Nosotros">Nosotros</a></li>

                <li>|</li>
                
                <?php
                if ($seccion == "autoridades") {
                    echo '<li class="active">';
                } else {
                    echo "<li>";
                };
                ?>
                <a href="autoridades.php" title="Autoridades">Autoridades</a></li>

                <li>|</li>

                <?php
                if ($seccion == "noticias") {
                    echo '<li class="active">';
                } else {
                    echo "<li>";
                };
                ?>
                <a href="noticias.php" title="Noticias">Noticias</a></li>

                <li>|</li>

                <?php
                if ($seccion == "reuniones") {
                    echo '<li class="active">';
                } else {
                    echo "<li>";
                };
                ?>
                <a href="reuniones.php" title="Agenda">Agenda</a></li>


                <li>|</li>

                <li><a href="campus-virtual.html" title="Campus Virtual">Campus Virtual</a></li>
                <li>|</li>
                  <?php
                if ($seccion == "comisiones") {
                    echo '<li class="active">';
                } else {
                    echo "<li>";
                };
                ?>
                <a href="comisiones.php" title="Comisiones">Comisiones</a></li>

                <li>|</li>
                
                <?php
                if ($seccion == "documentos") {
                    echo '<li class="active">';
                } else {
                    echo "<li>";
                };
                ?>
                <a href="documentos.php" title="Documentos">Documentos</a></li>

                <li>|</li>

                <?php
                if ($seccion == "contacto") {
                    echo '<li class="active">';
                } else {
                    echo "<li>";
                };
                ?>
                <a href="contacto.php" title="Contacto">Contacto</a></li>


            </ul>
        </div>
    </div>
</div>