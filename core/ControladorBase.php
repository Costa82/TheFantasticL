<?php
class ControladorBase{
    
    public function __construct() {
        require_once 'EntidadBase.php';
        
        //Incluir todos los modelos
        foreach(glob("model/*.php") as $file){
            require_once $file;
        }
    }
    
    //Métodos para los controladores
}
?>
