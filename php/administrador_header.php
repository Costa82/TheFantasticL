<?php
spl_autoload_register(function ($nombre_clase) {
    include_once ('../clases/' . $nombre_clase . '.php');
});

if (isset($_REQUEST['addTexto'])) {
    
    if (! empty($_REQUEST['titulo'])) {
        
        $textos = new Textos();
        $titulo = trim($_REQUEST['titulo']);
        $texto = trim($_REQUEST['texto']);
        $texto_ingles = trim($_REQUEST['texto_ingles']);
        
        if (!$textos->existeTitulo($titulo)) {
            
            // Título
            $titulo = trim($_REQUEST['titulo']);
            
            // Título en inglés
            $titulo_ingles = trim($_REQUEST['titulo_ingles']);
            
            // Tipo de texto
            $tipo = $_REQUEST['tipo'];
            
            // Texto
            $texto = $_REQUEST['texto'];
            
            // Texto en inglés
            $texto_ingles = $_REQUEST['texto_ingles'];
            
            // Imagen
            $img = $_FILES['img'];
            
            // Fecha subida
            $fecha_subida = date("Y-m-d");
            
            // Añadimos el texto
            $num = $textos->addTexto($titulo, $titulo_ingles, $tipo, $texto, $texto_ingles, $img, $fecha_subida);
        
        } else {
            
            $num = - 213;
        }
        
        $destino = "../php/administrador_index.php?num=$num";
    }
}

if (! headers_sent()) {
    
    header('Location:' . $destino);
    exit();
}
?>