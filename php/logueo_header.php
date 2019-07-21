<?php
include_once ('../model/Usuarios.php');
    
    if (isset($_REQUEST['loguear'])) {
        
        if (! empty($_REQUEST['nick']) and ! empty($_REQUEST['contrasena'])) {
            $nick = trim($_REQUEST['nick']);
            $pass = trim($_REQUEST['contrasena']);
            $usuario = new Usuarios();
            
            if ($usuario->esRegistradoNick($nick)) {
                
                if ($usuario->esRegistrado($nick, $pass)) { // para loguearse, se comprueba que sea ususario registrado
                    
                    require_once '../config/funciones.php';
                    
                    $destino = "../pagina-administrador/";
                    
                } else {
                    
                    $num = - 202;
                    $destino = "../logueo-administrador/?num=$num";
                }
            } else {
                
                $num = -201;
                $destino = "../logueo-administrador/?num=$num";
            }
        }
    }
    
    if (! headers_sent()) {
        header('Location:' . $destino);
        exit();
    }
?>