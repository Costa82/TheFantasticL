<?php

$textos = new Textos();

echo "

<div class='imagen'>
    <img src='img/logos/TheFantasticL_texto.png' alt='The Fantastic L'/>
</div> ";

// Buscamos los textos de presentaci�n pasando el valor 'PRES'
$cod_tipo_texto = 'PRES';

$textos->mostrarTexto($cod_tipo_texto);

