<?php
spl_autoload_register(function ($nombre_clase) {
    include_once ('../clases/' . $nombre_clase . '.php');
});
    
    if (isset($_REQUEST['loguear'])) {
        
        if (! empty($_REQUEST['nick']) and ! empty($_REQUEST['contrasena'])) {
            $nick = trim($_REQUEST['nick']);
            $pass = trim($_REQUEST['contrasena']);
            $usuario = new Usuario();
            
            if ($usuario->esRegistradoNick($nick)) {
                
                if ($usuario->esRegistrado($nick, $pass)) { // para loguearse, se comprueba que sea ususario registrado
                    
                    require_once '../inc/funciones.php';
                    
                    $destino = "../pagina_administrador/";
                    
                } else {
                    
                    $num = - 202;
                    $destino = "../administrador/?num=$num";
                }
            } else {
                
                $num = -201;
                $destino = "../administrador/?num=$num";
            }
        }
    }
    
    if (! headers_sent()) {
        header('Location:' . $destino);
        exit();
    }
?>