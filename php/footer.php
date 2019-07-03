<div class="footerPrincipal">

	<div class="logo_footer">
		<h3>The Fantastic L</h3>
		<ul>
            <li class="espacio oculto_movil_footer">The Fantastic L.</li>
		</ul>
	</div>

	<div class="informacion">

		<h3>Información</h3>

		<ul>
            
            <?php
            if (strpos($_SERVER['REQUEST_URI'], "galeria") !== false || strpos($_SERVER['REQUEST_URI'], "eventos") !== false || strpos($_SERVER['REQUEST_URI'], "reservas") !== false || strpos($_SERVER['REQUEST_URI'], "menus") !== false || strpos($_SERVER['REQUEST_URI'], "contacto") != false || strpos($_SERVER['REQUEST_URI'], "legal") !== false || strpos($_SERVER['REQUEST_URI'], "cookies") !== false || strpos($_SERVER['REQUEST_URI'], "blog") !== false) {
                
                // Estamos en alguna pagina que no sea la principal (Galeria, eventos, reservas, etc...)
                echo '<li id="sobreNosotros"><a href="../sobre-nosotros/" title="Sobre nosotros">Sobre nosotros</a></li>
                    <li id="consultoria"><a href="../consultoria/" title="Consultoría">Consultoría</a></li>
                    <li id="campaignManagement"><a href="../campaign-management/" title="Campaign Management">Campaign Management</a></li>
                    <li id="contacto"><a href="../contacto/" title="Contacto">Contacto</a></li>
                    <li id="blog"><a href="../blog/" title="Blog The Fantastic L">Blog</a></li>';
            } else {
                
                // Estamos en la pagina principal (index)
                echo '<li id="sobreNosotros"><a href="sobre-nosotros/" title="Sobre nosotros">Sobre nosotros</a></li>
                    <li id="consultoria"><a href="consultoria/" title="Consultoría">Consultoría</a></li>
                    <li id="campaignManagement"><a href="campaign-management/" title="Campaign Management">Campaign Management</a></li>
                    <li id="contacto"><a href="contacto/" title="Contacto">Contacto</a></li>
                    <li id="blog"><a href="blog/" title="Blog">Blog</a></li>';
            }
            ?>
            
            </ul>
	</div>

	<div class="redes">
		<h3>Síguenos</h3>
		<a href="https://m.facebook.com/The Fantastic L" title="Facebook"
			target="_blank"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
		<a href="https://www.twitter.com/The Fantastic L?lang=es" title="Twitter"
			target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a>
		<a href="https://www.instagram.com/The Fantastic L/" title="Instagram"
			target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
	</div>

</div>

<div class="avisoLegal_movil">
    	<?php
            if (strpos($_SERVER['REQUEST_URI'], "galeria") !== false || strpos($_SERVER['REQUEST_URI'], "eventos") !== false || strpos($_SERVER['REQUEST_URI'], "reservas") !== false || strpos($_SERVER['REQUEST_URI'], "menus") !== false || strpos($_SERVER['REQUEST_URI'], "contacto") != false || strpos($_SERVER['REQUEST_URI'], "legal") !== false || strpos($_SERVER['REQUEST_URI'], "cookies") !== false || strpos($_SERVER['REQUEST_URI'], "blog") !== false) {
                
                echo '<a class="enlace_legal" href="../aviso-legal-y-politica-de-privacidad/" title="Aviso Legal y política de privacidad">Aviso Legal y política de privacidad</a>';
            } else {
                echo '<a class="enlace_legal" href="aviso-legal-y-politica-de-privacidad/" title="Aviso Legal y política de privacidad">Aviso Legal y política de privacidad</a>';
            }
        ?>
</div>
