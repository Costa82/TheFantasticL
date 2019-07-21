<?php

require_once './config/constantes.php';

$textos = new Textos();

echo "

<div class='imagen'>
    <img src='img/logos/TheFantasticL_texto.png' alt='The Fantastic L'/>
</div> ";

// Buscamos los textos de presentación pasando el valor 'PRES'
$cod_tipo_texto = TIPO_TEXTO_PRESENTACION;

$textos->mostrarTexto($cod_tipo_texto);