<?php
require_once './config/validaciones.php';

/**
 * Controlador de gestión de los textos
 */
class ControladorTextos
{

    /**
     * Método para mostrar los blogs
     */
    public function blog()
    {
        if(isset($_SESSION['error']) && $_SESSION['error'] != 0) {
            $params['error'] = $_SESSION['error'];
            $_SESSION['error'] = 0;
        } else {
            $params['error'] = 0;
        }
        require './views/blog.php';
    }

    /**
     * Método para mostrar la consultoría
     */
    public function consultoria()
    {
        if(isset($_SESSION['error']) && $_SESSION['error'] != 0) {
            $params['error'] = $_SESSION['error'];
            $_SESSION['error'] = 0;
        } else {
            $params['error'] = 0;
        }
        require './views/consultoria.php';
    }

    /**
     * Método para mostrar el Campaign Management
     */
    public function campaign()
    {
        if(isset($_SESSION['error']) && $_SESSION['error'] != 0) {
            $params['error'] = $_SESSION['error'];
            $_SESSION['error'] = 0;
        } else {
            $params['error'] = 0;
        }
        require './views/campaign.php';
    }

    /**
     * Método para mostrar el Contacto
     */
    public function contacto()
    {
        if(isset($_SESSION['error']) && $_SESSION['error'] != 0) {
            $params['error'] = $_SESSION['error'];
            $_SESSION['error'] = 0;
        } else {
            $params['error'] = 0;
        }
        require './views/contacto.php';
    }

    /**
     * Método para subir un texto
     */
    public function subir_texto()
    {
        if (isset($_REQUEST['addTexto'])) {
            
            if (! empty($_REQUEST['titulo'])) {
                
                $textos = new Textos();
                $titulo = trim($_REQUEST['titulo']);
                $texto = trim($_REQUEST['texto']);
                $texto_ingles = trim($_REQUEST['texto_ingles']);
                
                if (! $textos->existeTitulo($titulo)) {
                    
                    // Título
                    $titulo = trim($_REQUEST['titulo']);
                    
                    // Título en inglés
                    $titulo_ingles = trim($_REQUEST['titulo_ingles']);
                    
                    // Tipo de texto
                    $tipo = $_REQUEST['tipo'];
                    
                    // Texto
                    $texto = $_REQUEST['texto'];
                    
                    // Texto en inglÉs
                    $texto_ingles = $_REQUEST['texto_ingles'];
                    
                    // Imagen
                    $nombre_imagen = $_FILES['img']['name'];
                    if ($nombre_imagen != "") {
                        $img = $_FILES['img'];
                    } else {
                        $img = NULL;
                    }
                    
                    // Fecha subida
                    $fecha_subida = date("Y-m-d");
                    
                    // A�adimos el texto
                    $num = $textos->addTexto($titulo, $titulo_ingles, $tipo, $texto, $texto_ingles, $img, $fecha_subida);
                } else {
                    
                    $num = 213;
                }
                
                $destino = "pagina_administrador/$num";
            }
        }
        
        if (! headers_sent()) {
            
            header('Location:' . $destino);
            exit();
        }
    }
}

