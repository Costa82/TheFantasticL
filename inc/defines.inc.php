<?php
// Validaciones
define("NIF_INCORR", -102);   // NIF no es válido
define("CLAVE_INCORR", -103);  // Clave no válida
define("CLAVE_NOREPE", -104);   // Las claves no coinciden
define("FOTO_SUPLIM", -105);   // El tamaño de la foto supera el límite
define("USER_NOEXIS", -201);   // El usuario no está registrado
define("CLAVE_NOEXIS", -202);  // La contraseña es incorrecta
define("USER_EXIS", -203);  // El DNI del usuario ya está registrado
define("EMAIL_REPE", -204);  // El email esta repetido
define("ERROR_FECHA_NACIMIENTO", -205);  // Error al insertar la fecha dnacimientoe nacimiento
define("TFNO_INCORRECTO", -206);//El número de teléfono no es correcto
define("NOMBRE_INCORRECTO", -207);//El nombre no es correcto (No puede empezar por números,sí puede contener espacios en blanco y no puede contener caracteres especiales)
define("APELLIDO_INCORRECTO", -208);//El apellido no es correcto (No puede empezar por números,sí puede contener espacios en blanco y no puede contener caracteres especiales)
define("EMAIL_INCORRECTO", -209);//El email es incorrecto
define("PASS_DIFERENTES", -210);//Debe introducir las dos contraseñas iguales
define("NICK_INCORRECTO", -211);//El Nick no es válido, debe tener entre 4 y 8 caracteres.
define("ADMIN_NO_PERMISOS", -212);//El administrador no tiene permisos para modificar a otro administrador
define("AUTOR_INCORRECTO", -214);//El autor no es correcto (No puede empezar por números,sí puede contener espacios en blanco y no puede contener caracteres especiales)
define("CODIGO_INCORRECTO", -216);//El codigo no es correcto
define("CARACTERES_ESPECIALES", -217);//Los títulos de los libros no pueden contener caracteres especiales
define("USER_CORRECTO", -301); //usuario registrado correcto
define("MODIF_USER_CORRECTO", -304);//usuario modificado correcto
define("USER_INCORRECTO", -303); //usuario registrado incorrecto.Faltan datos
define("SESION_INICIADA", -302); //usuario registrado correcto
define("PASS_INCORRECTO", -305);  // Contraseña incorrecta, debe tener entre 4 y 16 caracteres
define("CONF_REGISTRO", -306);  // Confirmar Registro
define("USER_EXISTE", -300); //usuario que ya estaba registrado
define("ENVIO_MENSAJE_OK", -307); //Mensaje enviado
define("ERROR_CONEXION", -666); //Error de conexion
define("ERROR_ENVIO_MAIL", -667); //Error al enviar el email
define("ERROR_ENVIO_MENSAJE", -668); //Error al enviar el mensaje
define("ERROR_LIBRO_LISTA", -669); //Ya existe el libro en la lista
define("ERROR_GENERAL", -1000); //Error General

$mensaje[CLAVE_INCORR] = "La CLAVE introducida no es válida.";
$mensaje[CLAVE_NOREPE] = "Las claves no coinciden";
$mensaje[FOTO_SUPLIM] = "El tamaño de la foto supera el límite permitido";
$mensaje[NOMBRE_INCORRECTO]="El nombre no es correcto, no puede empezar por números y no puede contener caracteres especiales.";
$mensaje[APELLIDO_INCORRECTO]="El apellido no es correcto (Mín 3 y Máx 20 caracteres, no puede empezar por números y no puede contener caracteres especiales)";
$mensaje[EMAIL_REPE] = "Hay otro usuario con el mismo email.";
$mensaje[EMAIL_INCORRECTO] = "El email es incorrecto.";
$mensaje[PASS_DIFERENTES] = "Debe introducir las dos contraseñas iguales.";
$mensaje[NICK_INCORRECTO] = "El Nick no es válido, debe tener entre 4 y 8 caracteres.";
$mensaje[AUTOR_INCORRECTO] = "El autor no es correcto, no puede empezar por números y no puede contener caracteres especiales.";

$mensaje[USER_NOEXIS] = "El usuario no está registrado.";
$mensaje[CLAVE_NOEXIS] = "La contraseña es incorrecta";
$mensaje[USER_EXIS] = "El DNI del usuario ya está registrado.";

$mensaje[CODIGO_INCORRECTO]="El codigo no es correcto, si no tiene uno váido no rellene el campo";
$mensaje[CARACTERES_ESPECIALES]="Los títulos de los libros no pueden contener caracteres especiales";

$mensaje[CONF_REGISTRO] = "En breve recibirás un correo de confirmación de registro con tu nueva contraseña, si no está en la carpeta principal puede que se encuentre en correo no deseado.";
$mensaje[USER_CORRECTO] = "El usuario se ha registrado correctamente.";
$mensaje[MODIF_USER_CORRECTO] = "El usuario se ha modificado correctamente.";
$mensaje[USER_INCORRECTO] = "El usuario no se ha podido registrar.Faltan datos";
$mensaje[USER_EXISTE]= "El usuario ya estaba registrado previamente.";
$mensaje[SESION_INICIADA] = "Tienes otra sesión iniciada.";
$mensaje[PASS_INCORRECTO] = "Contraseña incorrecta, debe tener entre 4 y 16 caracteres.";
$mensaje[ENVIO_MENSAJE_OK] = "Mensaje enviado.";

$mensaje[ERROR_CONEXION] = "Error de conexion.";
$mensaje[ERROR_ENVIO_MAIL] = "Error al enviar el email.";
$mensaje[ERROR_ENVIO_MENSAJE] = "Error al enviar el mensaje.";
$mensaje[ERROR_LIBRO_LISTA] = "Ya existe el libro en la lista.";
$mensaje[ERROR_GENERAL] = "Error General.";
?>