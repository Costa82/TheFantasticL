<?php
namespace config;

/**
 * normaliza ($cadena)
 * Función que se utilizara dentro de las funciones guardarImgTexto() y modificaImg() para quitar los acentos y las Ñs a las rutas
 *
 * @param
 *            $cadena
 * @return String
 */
function normaliza($cadenaOriginal)
{
    $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
		ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ?¿-!¡';
    $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuy
		bsaaaaaaaceeeeiiiidnoooooouuuyybyRr     ';
    $cadena = utf8_decode($cadenaOriginal);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    $cadena = strtolower($cadena);
    
    return utf8_encode($cadena);
}

/**
 * quitarCaracteres ($cadena)
 * Función que se utilizara dentro de las funciones guardarImgTexto() y modificaImg() para quitar los acentos y las Ñs a las rutas
 *
 * @param
 *            $cadena
 * @return String
 */
function quitarCaracteres($cadenaOriginal)
{
    $originales = '?¿-!¡/\\';
    $modificadas = '       ';
    $cadena = utf8_decode($cadenaOriginal);
    $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
    // $cadena = strtolower($cadena);
    
    return utf8_encode($cadena);
}

/**
 * Funcion a la que se le pasa un nombre simple ó compuesto y transforma la primera letra a Mayúsculas
 *
 * @param
 *            $nombre
 * @return string devuleve el nombre con la primera letra en mayúsculas
 */
function ponerLetraEnMayuscula($nombre)
{
    $nombreCompuesto = explode(" ", $nombre);
    $nombreConPrimeraletramayus = "";
    for ($i = 0; $i < count($nombreCompuesto); $i ++) {
        $letra = strtoupper(substr($nombreCompuesto[$i], 0, 1));
        $nombreCompuesto[$i] = $letra . substr($nombreCompuesto[$i], 1);
    }
    for ($i = 0; $i < count($nombreCompuesto); $i ++) {
        
        $nombreConPrimeraletramayus .= $nombreCompuesto[$i] . " ";
    }
    return $nombreConPrimeraletramayus;
}

/**
 * console_log
 * Sacamos por consola lo que le pasemos
 *
 * @param
 *            $data
 */
function console_log($data)
{
    echo '<script>';
    echo 'console.log(' . json_encode($data) . ')';
    echo '</script>';
}


