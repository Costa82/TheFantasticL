<?php

require_once './model/Textos.php';

$textos = new Textos();

class TextosController
{
    
    function mostrarTexto($cod_tipo_texto) {
        $textos->mostrarTexto($cod_tipo_texto);
    }
}

