<?php

require_once './controller/TextosController.php';

$controller = new TextosController();

echo "

<div class='imagen'>
    <img src='img/logos/TheFantasticL_texto.png' alt='The Fantastic L'/>
</div> ";

// Buscamos los textos de presentaci�n pasando el valor 'PRES'
$cod_tipo_texto = 'PRES';

$controller->mostrarTexto($cod_tipo_texto);

