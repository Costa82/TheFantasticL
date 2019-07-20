<?php
namespace config;

class Utils
{

    /**
     * normaliza ($cadena)
     * Función que se utilizara dentro de las funciones guardarImgTexto() y modificaImg() para quitar los acentos y las Ñs a las rutas
     *
     * @param
     *            $cadena
     * @return String
     */
    public function normaliza($cadenaOriginal)
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
}

