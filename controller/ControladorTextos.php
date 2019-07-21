<?php
require_once './config/validaciones.php';

/**
 * Controlador de gestión de los textos
 *
 */

class ControladorTextos
{
    
    /**
     * Método para mostrar los blogs
     */
    public function blog()
    {
        if (isset($_GET['opcion'])) {
            $params['error'] = $_GET['opcion'];
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
        if (isset($_GET['opcion'])) {
            $params['error'] = $_GET['opcion'];
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
        if (isset($_GET['opcion'])) {
            $params['error'] = $_GET['opcion'];
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
        if (isset($_GET['opcion'])) {
            $params['error'] = $_GET['opcion'];
        } else {
            $params['error'] = 0;
        }
        require './views/contacto.php';
    }
    
}

