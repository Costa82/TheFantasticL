<?php

require_once '../config/constantes.php';

$textos = new Textos();

echo "<h1>CONS</h1>";

// Buscamos los textos de la consultoría pasando el valor 'CONS'
$cod_tipo_texto = TIPO_TEXTO_CONSULTORIA;

$textos->mostrarTexto($cod_tipo_texto);
