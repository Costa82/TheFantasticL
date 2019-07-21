<?php
ob_start();

require_once './config/constantes.php';

$textos = new Textos();

echo "<h1>CONTACTO</h1>";

// Buscamos los textos de la consultoría pasando el valor 'CONS'
// $cod_tipo_texto = TIPO_TEXTO_CONTACTO;

// $textos->mostrarTexto($cod_tipo_texto);

echo '
    <div class="contenedor_contacto">

    	<h3>CONTACTO</h3>
    
        <p>
            Estamos aquí solo para que disfrutes, para eso queremos ponértelo
            fácil y qué mejor manera que contactando con nosotros. Te
            contestaremos lo antes posible, atenderemos tus dudas y por supuesto,
            ¡haremos que vuelvas! </br>
            </br>Calle Paraíso 2 (Pasaje Alarcón) </br>
            </br>47003 Valladolid </br>
            </br>Teléfono 983.85.73.69 </br>
            </br>Móvil 680.21.97.94 </br>
            </br>Email: <a href="mailto:info@merendalia.es" title="Contactar"><i>info@merendalia.es</i></a>
        </p>

    </div>';

echo '
    <div class="contenedor_formulario">

        <div class="formulario">
        
            <h2>Realiza tu consulta</h2>
            
            <form action="envio_mensaje" method="post"
            class="formularioRegistro" onSubmit="return validar();">
                <div class="form">
                    <label>Nombre</label> <input type="text" name="nombre" class="nombre"
                    placeholder="Nombre..." required="required" />
                </div>
                <div class="form">
                    <label>Email</label> <input type="email" name="mail" class="mail"
                    placeholder="Email..." required="required" />
                </div>
                <div class="form">
                    <label>Telefono</label> <input type="tel" name="telefono"
                    class="telefono" placeholder="Telefono..." />
                </div>
                <div>
                    <label>Consulta</label>
                    <textarea rows="4" cols="50" name="consulta" class="consulta" required="required"></textarea>
                </div>
                <div class="form condiciones">
                    <input type="checkbox" name="condiciones" id="condiciones"><label>Acepta
                    el <a href="../aviso-legal-y-politica-de-privacidad/" title="Aviso Legal"><i>Aviso Legal y la
                    Política de Privacidad</i></a>
                    </label>
                </div>
                <div class="form whatsapp">
                    <input type="checkbox" name="whatsapp" id="whatsapp" value="1"><label>Quiero
                    darme de alta en la lista de difusión por whatsapp </label>
                </div>
                <div class="boton">
                    <button type="submit" name="enviar" class="btn">¡Enviar!</button>
                </div>
            </form>
        </div>

    </div>';

$contenido = ob_get_clean();
include './views/default/templates/template_contacto.php';
?>