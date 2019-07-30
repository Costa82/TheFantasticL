<?php
ob_start();

echo "<h1>LOGUIN ADMINISTRADOR</h1>";

echo '
    <div class="container">
		<div class="form-box">
			<div class="form-top">
				<div class="form-top-left">
					<h2>Inicia sesión</h2>
					<p>
						<span>*</span> Campos obligatorios.
					</p>
					<div id="errores">';

if ($params['error'] != 0) {
    $num = $params['error'];
    $mensaje = validacion($num);
    echo $mensaje;
}

echo '                    
                    </div>
				</div>
			</div>
			<div class="form-bottom">
				<form role="form" action="./logueo" method="post"
					class="login-form">
					<div class="form-group">
						<label><span>* </span>Nick</label> <input type="text" name="nick"
							placeholder=Nick... required="required" />
					</div>
					<div class="form-group">
						<label><span>* </span>Contraseña</label> <input type="password"
							name="contrasena" placeholder=Contraseña... required="required" />
					</div>
					<h3>
						<a href="../FormularioEnvioContrase�a/">He olvidado la contraseña
							y/o el Nick...</a>
					</h3>
					<div class="botones">
						<button type="submit" name="loguear" class="btn">¡Inicia sesión!</button>
					</div>
				</form>
			</div>
		</div>
	</div>';

$contenido = ob_get_clean();
include './views/default/templates/template_adminLoguin.php';
?>