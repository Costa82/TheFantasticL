<?php
session_start();
require_once 'core/Conectar.php';

// Incluimos automáticamente el model que sea necesario
function __autoload($class)
{
    require_once ("model/$class.php");
}

// Comprobamos la sesión
if (! isset($_SESSION['usuario'])) {
    
    // Compruebo si existe la cookie y si coincide con algún usuario
    if (isset($_COOKIE['usuario'])) {
        
        require_once 'model/Usuarios.php';
        $usuario = new Usuarios();
        $nombre_usuario = $usuario->comprobar_cookie($_COOKIE['usuario']);
        
        if ($nombre_usuario) {
            
            // Creamos la variable de sesión
            $_SESSION['usuario'] = $nombre_usuario;
            // Si estamos en inicio redirigimos a ver contactos
            if ($_GET['action'] == 'inicio') {
                header('location:inicio');
            }
        } else {
            header('location:inicio');
        }
    }
}

// Enrutamiento. Selecciona el controlador y la acción a ejecutar
$map = array(
    'inicio' => array(
        'controller' => 'ControladorUsuarios',
        'action' => 'inicio',
        'privada' => false
    ),
    'blog' => array(
        'controller' => 'ControladorTextos',
        'action' => 'blog',
        'privada' => false
    ),
    'consultoria' => array(
        'controller' => 'ControladorTextos',
        'action' => 'consultoria',
        'privada' => false
    ),
    'campaign' => array(
        'controller' => 'ControladorTextos',
        'action' => 'campaign',
        'privada' => false
    ),
    'contacto' => array(
        'controller' => 'ControladorTextos',
        'action' => 'contacto',
        'privada' => false
    ),
    'envio_mensaje' => array(
        'controller' => 'ControladorMensajes',
        'action' => 'envio_mensajes',
        'privada' => false
    ),
    'envio_correcto' => array(
        'controller' => 'ControladorMensajes',
        'action' => 'envio_correcto',
        'privada' => false
    ),
    'envio_fallido' => array(
        'controller' => 'ControladorMensajes',
        'action' => 'envio_fallido',
        'privada' => false
    ),
    'ver_mensaje_privado' => array(
        'controller' => 'ControladorMensajes',
        'action' => 'ver_mensaje_privado',
        'privada' => true
    ),
    'ver_todos_mensajes_privados' => array(
        'controller' => 'ControladorMensajes',
        'action' => 'ver_todos_mensajes_privados',
        'privada' => true
    ),
    'borrar_mensaje' => array(
        'controller' => 'ControladorMensajes',
        'action' => 'borrar_mensaje',
        'privada' => true
    )
);

// Parseo de la ruta
// Comprobamos si hay alguna acción que ejecutar, sino ejecutamos inicio
if (isset($_GET['action'])) {
    
    // Comprobamos que la acción existe en el mapa del enrutamiento, sino mostramos error 404
    if (isset($map[$_GET['action']])) {
        $action = $_GET['action'];
    } else {
        header('Status: 404 Not Found');
        echo '<html><body><h1>Error 404: No existe la ruta ' . $_GET['action'] . ' </h1></body></html>';
        exit();
    }
} else {
    $action = 'inicio';
}

// La variable controlador contiene la clase del controlador a ejecutar y el método de dicha clase.
$controlador = $map[$action];

// Guardamos en variables el nombre de la clase controladora y del método que queremos ejecutar dentro de dicha clase
$clase_controlador = $controlador['controller'];
$metodo = $controlador['action'];

// // Si la página es privada comprobamos si el usuario está correctamente logueado, sino redirigimos a inicio
// if ($controlador['privada'] && ! isset($_SESSION['usuario'])) {
// header('location:/gestionfutbol/inicio'); // Si lo ponemos en el servidor poner /Foro/inicio
// die();
// }

// Creamos un objeto de la clase controladora y ejecutamos el método indicado en el action
require_once "controller/$clase_controlador.php";

$obj_controlador = new $clase_controlador();
$obj_controlador->$metodo();

?>
