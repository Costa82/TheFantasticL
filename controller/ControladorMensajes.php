<?php
require_once './config/validaciones.php';
require_once './config/defines.php';
require_once './model/Correo.php';

/**
 * Controlador de gestión del envio de Mensajes
 *
 */

class ControladorMensajes
{
    
    /**
     * Método para mostrar la página de envio correcto
     */
    public function envio_correcto()
    {
        if (isset($_GET['opcion'])) {
            $params['error'] = $_GET['opcion'];
        } else {
            $params['error'] = 0;
        }
        require './views/envio_correcto.php';
    }
    
    /**
     * Método para mostrar la página de envio fallido
     */
    public function envio_fallido()
    {
        if (isset($_GET['opcion'])) {
            $params['error'] = $_GET['opcion'];
        } else {
            $params['error'] = 0;
        }
        require './views/envio_fallido.php';
    }
    
    /**
     * Método para enviar mensajes
     */
    public function envio_mensajes()
    {
        
        $correo = new Correo();
        
        if(isset($_REQUEST['enviar'])){
            
            if( isset($_REQUEST['nombre']) AND isset($_REQUEST['mail']) ){
                
                // Campos obligatorios
                $nombre = $_REQUEST['nombre'];
                $mail = $_REQUEST['mail'];
                $telefonoValido = true;
                
                // Campos opcionales
                if ( isset($_REQUEST['telefono']) ) {
                    
                    $telefono = $_REQUEST['telefono'];
                    
                    if ($telefono != "" && $telefono != null) {
                        
                        if (!validarTelefono($telefono)) {
                            $telefonoValido = false;
                        }
                    } else {
                        $telefono = null;
                    }
                    
                } else {
                    $telefono = null;
                }
                
                if ( isset($_REQUEST['consulta']) ) {
                    $consulta = $_REQUEST['consulta'];
                } else {
                    $consulta = null;
                }
                
                if (isset($_POST['whatsapp']) && $_POST['whatsapp'] == '1') {
                    $whatsapp = "OK";
                } else {
                    $whatsapp = "KO";
                }
                
                // Enviamos el correo de reserva
                // Comprobamos que no sea ninguno de estos correos (info@basededatos-info.com, yourmail@gmail.com)
                if ( $mail === "info@basededatos-info.com" || $mail === "yourmail@gmail.com" || $mail === "artyea@msn.com" || !$telefonoValido ) {
                    $envio = "KO";
                } else {
                    $envio = $correo->enviarMailsConsulta($mail, $nombre, $telefono, $consulta, $whatsapp);
                }
                
                // Comprobamos cómo ha ido el envío
                if ( $envio == "OK" ) {
                    header ( 'location:envio_correcto' );
                } else {
                    header ( 'location:envio_fallido' );
                }
                
                // El nombre y el mail tienen que ser obligatorios
            } else {
                header ( 'location:envio_fallido' );
            }
        }
    }
}

