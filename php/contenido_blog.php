<?php

$textos = new Textos();

echo "<h1>BLOG</h1>";

// Buscamos los textos del blog pasando el valor 'BLOG'
$cod_tipo_texto = 'BLOG';

$textos->mostrarTexto($cod_tipo_texto);
