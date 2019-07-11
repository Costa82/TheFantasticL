<?php

$textos = new Textos();

echo "<h1>CAMP</h1>";

// Buscamos los textos de la campaign pasando el valor 'CAMP'
$cod_tipo_texto = 'CAMP';

$textos->mostrarTexto($cod_tipo_texto);
