<?php
require_once 'defines.inc.php';

/**
 * La contrase�a debe tener al entre 4 y 8 caracteres, al menos un d�gito, al menos una min�scula y al menos una may�scula.
 * No puede tener otros s�mbolos.
 *
 * @param
 *            $pass
 * @return true si cumple con los requisitos
 */
function esContrase�a($pass)
{
    /* ("/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{4,8}$/",$pass) */
    if (preg_match("/^\S{4,16}$/", $pass)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Funci�n que valida que el tel�fono no sea raro
 *
 * @param
 *            $value
 * @return boolean
 */
function validarTelefono($value)
{
    $expresion = '/^((\+?34([ \t|\-])?)?[9|6|7]((\d{1}([ \t|\-])?[0-9]{3})|(\d{2}([ \t|\-])?[0-9]{2}))([ \t|\-])?[0-9]{2}([ \t|\-])?[0-9]{2})$/';
    
    if (preg_match($expresion, $value)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Funci�n que compara la dos contrase�as que introduce el usuario por el formulario cuando tiene la opci�n de
 * modificar la contrase�a
 *
 * @param
 *            $passNueva
 * @param
 *            $passRep
 * @return boolean true si ambas coinciden. False si la contrase�a repetida no es igual que la contrase�a nueva
 */
function validarContrasena($passNueva, $passRep)
{
    if ($passNueva == $passRep) {
        return true;
    } else {
        return false;
    }
}

/**
 * Definimos los mensajes de error para darles un texto comprensible por el usuario
 *
 * @global type $mensaje
 * @param
 *            $num
 * @return $mensaje[]
 */
function validacionExisteUsuario($num)
{
    global $mensaje; // importante la variable global para que reconozca $mensaje de 'defines.inc.php'
    if ($num == - 300) {
        return $mensaje[USER_EXISTE];
    } elseif ($num == - 303) {
        return $mensaje[USER_INCORRECTO];
    } elseif ($num == - 301) {
        return $mensaje[USER_CORRECTO];
    } elseif ($num == - 201) {
        return $mensaje[USER_NOEXIS];
    } elseif ($num == - 202) {
        return $mensaje[CLAVE_NOEXIS];
    } elseif ($num == - 305) {
        return $mensaje[PASS_INCORRECTO];
    } elseif ($num == - 204) {
        return $mensaje[EMAIL_REPE];
    } elseif ($num == - 205) {
        return $mensaje[ERROR_FECHA_NACIMIENTO];
    } elseif ($num == - 206) {
        return $mensaje[TFNO_INCORRECTO];
    } elseif ($num == - 207) {
        return $mensaje[NOMBRE_INCORRECTO];
    } elseif ($num == - 208) {
        return $mensaje[APELLIDO_INCORRECTO];
    } elseif ($num == - 209) {
        return $mensaje[EMAIL_INCORRECTO];
    } elseif ($num == - 210) {
        return $mensaje[PASS_DIFERENTES];
    } elseif ($num == - 305) {
        return $mensaje[PASS_INCORRECTO];
    } elseif ($num == - 211) {
        return $mensaje[NICK_INCORRECTO];
    } elseif ($num == - 212) {
        return $mensaje[ADMIN_NO_PERMISOS];
    } elseif ($num == - 213) {
        return $mensaje[TITULO_INCORRECTO];
    } elseif ($num == - 214) {
        return $mensaje[AUTOR_INCORRECTO];
    } elseif ($num == - 215) {
        return $mensaje[GENERO_INCORRECTO];
    } elseif ($num == - 216) {
        return $mensaje[CODIGO_INCORRECTO];
    } elseif ($num == - 217) {
        return $mensaje[CARACTERES_ESPECIALES];
    } elseif ($num == - 306) {
        return $mensaje[CONF_REGISTRO];
    } elseif ($num == - 307) {
        return $mensaje[ENVIO_MENSAJE_OK];
    }
}

/**
 * Definimos los mensajes de error
 *
 * @global type $mensaje
 * @param
 *            $num
 * @return $mensaje[]
 */
function validacionErrores($num)
{
    global $mensaje; // importante la variable global para que reconozca $mensaje de 'defines.inc.php'
    if ($num == - 300) {
        return $mensaje[USER_EXISTE];
    } elseif ($num == - 303) {
        return $mensaje[USER_INCORRECTO];
    } elseif ($num == - 301) {
        return $mensaje[USER_CORRECTO];
    } elseif ($num == - 201) {
        return $mensaje[USER_NOEXIS];
    } elseif ($num == - 202) {
        return $mensaje[CLAVE_NOEXIS];
    } elseif ($num == - 305) {
        return $mensaje[PASS_INCORRECTO];
    } elseif ($num == - 204) {
        return $mensaje[EMAIL_REPE];
    } elseif ($num == - 205) {
        return $mensaje[ERROR_FECHA_NACIMIENTO];
    } elseif ($num == - 206) {
        return $mensaje[TFNO_INCORRECTO];
    } elseif ($num == - 207) {
        return $mensaje[NOMBRE_INCORRECTO];
    } elseif ($num == - 208) {
        return $mensaje[APELLIDO_INCORRECTO];
    } elseif ($num == - 209) {
        return $mensaje[EMAIL_INCORRECTO];
    } elseif ($num == - 210) {
        return $mensaje[PASS_DIFERENTES];
    } elseif ($num == - 305) {
        return $mensaje[PASS_INCORRECTO];
    } elseif ($num == - 211) {
        return $mensaje[NICK_INCORRECTO];
    } elseif ($num == - 212) {
        return $mensaje[ADMIN_NO_PERMISOS];
    } elseif ($num == - 213) {
        return $mensaje[TITULO_INCORRECTO];
    } elseif ($num == - 214) {
        return $mensaje[AUTOR_INCORRECTO];
    } elseif ($num == - 215) {
        return $mensaje[GENERO_INCORRECTO];
    } elseif ($num == - 216) {
        return $mensaje[CODIGO_INCORRECTO];
    } elseif ($num == - 217) {
        return $mensaje[CARACTERES_ESPECIALES];
    } elseif ($num == - 306) {
        return $mensaje[CONF_REGISTRO];
    } elseif ($num == - 666) {
        return $mensaje[ERROR_CONEXION];
    } elseif ($num == - 667) {
        return $mensaje[ERROR_ENVIO_MAIL];
    } elseif ($num == - 668) {
        return $mensaje[ERROR_ENVIO_MENSAJE];
    } elseif ($num == - 669) {
        return $mensaje[ERROR_LIBRO_LISTA];
    } elseif ($num == - 1000) {
        return $mensaje[ERROR_GENERAL];
    }
}

/**
 * Se valida el nick que tiene que tener de 4 a 8 caracteres, letras � n�meros
 *
 * @param
 *            $nick
 */
function esNick($nick)
{
    if (preg_match("/^[A-Z \-������������0-9.]{4,8}$/i", $nick)) {
        return true;
    } else {
        return false;
    }
}

/**
 * Un nombre � apellido es v�lido si tiene un m�mimo de 3 caracteres y un m�ximo de 20
 * Adem�s, que no empiece por n�meros,puede contener espacios en blanco y que no contenga caracteres especiales
 *
 * @param
 *            $nombre
 * @return boolean true si se cumplen las reglas. False en caso contrario
 */
function esNombreValido($nombre)
{
    /**
     * Que no empiece por n�meros,puede contener espacios en blanco y que no contenga caracteres especiales,
     * un m�mimo de 3 caracteres y un m�ximo de 20
     */
    if (preg_match("/^[A-Z \-������������\\s]{3,20}/i", $nombre)) {
        return true;
    } else {
        
        return false;
    }
}

/**
 * tieneCaracteresEspeciales( $palabra )
 * Una palabra no puede contener caracteres especiales
 *
 * @param
 *            $palabra
 * @return boolean true si se cumplen las reglas. False en caso contrario
 */
function tieneCaracteresEspeciales($palabra)
{
    if (preg_match("/[]{}*=+\-\\/#%_$&|]/", $palabra)) {
        return true;
    } else {
        return false;
    }
    return false;
}

/**
 * esCodigoCorrecto($codigo)
 * Comprueba que el codigo introducido es el correcto
 *
 * @param
 *            $palabra
 * @return boolean true si se cumplen las reglas. False en caso contrario
 */
function esCodigoCorrecto($codigo)
{
    $codigoCorrecto = "FERIADELLIBRO";
    if ($codigoCorrecto == $codigo) {
        return true;
    } else {
        return false;
    }
}

/**
 * Funcion a la que se le pasa un nombre simple � compuesto y transforma la primera letra a May�sculas
 *
 * @param
 *            $nombre
 * @return string devuleve el nombre con la primera letra en may�sculas
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
 * Con un filtro validamos la direccion de correo electronico
 *
 * @param
 *            $mail
 * @return boolean true si es valido. False en caso contrario
 */
function esMailValido($mail)
{
    if (filter_var($mail, FILTER_VALIDATE_EMAIL))
        return true;
    return false;
}
?>	