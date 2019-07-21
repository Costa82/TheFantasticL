<?php
ob_start();

require_once './config/constantes.php';

$textos = new Textos();

echo "<h1>BLOG</h1>";

// Buscamos los textos del blog pasando el valor 'BLOG'
$cod_tipo_texto = TIPO_TEXTO_BLOG;

$textos->mostrarTexto($cod_tipo_texto);

$contenido = ob_get_clean();
include './views/default/templates/template_blog.php';
?>