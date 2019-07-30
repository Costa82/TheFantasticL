<?php
use function config\quitarCaracteres;

require_once './core/EntidadBase.php';
require_once './config/utils.php';

class Textos extends EntidadBase
{

    // Columnas de BBDD
    public $id;

    public $fecha_publicacion;

    public $texto;

    public $imagen;

    public $cod_tipo_texto;

    public $cod_estado;

    public function __construct()
    {
        $tabla = "textos";
        parent::__construct($tabla);
    }

    /**
     * muestra el texto correspondiente según el tipo pasado [BLOG, INFO, PRES, OTRO]
     *
     * @param
     *            $cod_tipo_texto
     */
    public function mostrarTexto($cod_tipo_texto)
    {
        $query = $this->db()->query("SELECT t.*, ti.* FROM
             " . $this->getTable() . " t, textos_ingles ti WHERE t.titulo = ti.titulo AND t.cod_tipo_texto = '" . $cod_tipo_texto . "' AND t.cod_estado = 'ACTV'");
        
        while ($mostrar = $query->fetch_assoc()) {
            
            echo "<div class='presentacion espanol'>
									<h1> " . $mostrar["titulo"] . "</h1>
									<p> " . $mostrar["texto"] . "</p>";
            
            if ($mostrar["imagen"] != null) {
                echo "<img src='./views/default/img/textos/" . $mostrar["imagen"] . "' title='" . $mostrar["imagen"] . "' alt='" . $mostrar["imagen"] . "' />";
            }
            
            echo "</div>";
            
            echo "<div class='presentacion ingles'>
									<h1> " . $mostrar["titulo_ingles"] . "</h1>
									<p> " . $mostrar["texto_ingles"] . "</p>";
            
            if ($mostrar["imagen"] != null) {
                echo "<img src='./views/default/img/textos/" . $mostrar["imagen"] . "' title='" . $mostrar["imagen"] . "' alt='" . $mostrar["imagen"] . "' />";
            }
            
            echo "</div>";
        }
    }

    /**
     * Función que comprueba si ya existe el titulo del texto.
     *
     * @param
     *            $titulo
     * @return boolean
     */
    public function existeTitulo($titulo)
    {
        // Igualamos a mayúsculas la búsqueda para evitar los problemas con mayúsculas y minúsculas
        $tituloMinuscula = strtoupper($titulo);
        
        $query = "SELECT * FROM " . $this->getTable() . " WHERE UPPER(titulo) ='" . $titulo . "'";
        
        if ($result = $this->db()->query($query)) {
            if ($result->num_rows == 1) {
                return true;
            } else {
                return false;
            }
        } else {
            $error=$this->conn->errorInfo();
            throw new Exception("Error al ejecutar la SQL: ". $error[2]);
        }
    }

    /**
     * Función que añade el texto a BBDD
     *
     * @param
     *            $titulo
     * @param
     *            $titulo_ingles
     * @param
     *            $tipo
     * @param
     *            $texto
     * @param
     *            $texto_ingles
     * @param
     *            $img
     * @param
     *            $fecha
     * @return number
     */
    public function addTexto($titulo, $titulo_ingles, $tipo, $texto, $texto_ingles, $img, $fecha)
    {
        $foto = NULL;
        if (! is_null($img)) {
            $foto = $this->guardarImgTexto($titulo, $img);
        }
        
        $tituloSinCaracteres = quitarCaracteres($titulo);
        $estado = "ACTV";
        
        $query = "INSERT INTO " . $this->getTable() . " (titulo, fecha_publicacion, texto, imagen, cod_tipo_texto, cod_estado) VALUES('$titulo','$fecha','$texto','$img','$tipo','$estado')";
        
        if ($this->db()->query($query)) {
            
            if ($this->addTextoIngles($titulo, $titulo_ingles, $texto_ingles)) {
                return 401; // Texto subido correctamente
            } else {
                $this->borrarTexto($titulo);
                return 402; // Texto no subido
            }
        } else {
            return 402; // Texto no subido
        }
    }

    /**
     * guardarImgTexto($titulo,$archivo_img):
     * Función utilizada dentro de la función addTexto,para guardar la imagen del texto si la tuviera.
     *
     * @param
     *            $titulo
     * @param
     *            $archivo_img
     */
    public function guardarImgTexto($titulo, $archivo_img)
    {
        $titulo = quitarCaracteres($titulo);
        $img_name = $archivo_img['name'];
        $img_type = $archivo_img['type'];
        $img_tmp_name = $archivo_img['tmp_name'];
        $img_size = $archivo_img['size'];
        
        if ($img_type == "image/jpeg" || $img_type == "image/pjpeg" || $img_type == "image/jpg") {
            $extension = "jpg";
        } elseif ($img_type == "image/png") {
            $extension = "png";
        } else {
            $extension = NULL;
        }
        
        $ruta = NULL;
        $rutaBD = NULL;
        $lugar = '../img/textos/';
        
        // Validamos la imagen
        if ($img_name != NULL and $extension != NULL and $img_size != 0) {
            
            if ($img_size <= $_REQUEST['lim_tamano']) {
                
                $nombre_img = $this->normaliza($titulo . "." . $extension);
                $ruta = $lugar . $nombre_img;
                // Guardamos la foto en la carpeta del proyecto "img/textos"
                move_uploaded_file($img_tmp_name, $ruta);
                // Declaramos la ruta de la imagen en la base de datos
                $rutaBD = $nombre_img;
            }
        }
        
        return $rutaBD;
    }

    /**
     * Añade el texto en inglés devolverá true si se ha registrado y false si ha dado error
     *
     * @param
     *            $id_texto
     * @param
     *            $titulo_ingles
     * @param
     *            $texto_ingles
     * @return boolean
     */
    public function addTextoIngles($titulo, $titulo_ingles, $texto_ingles)
    {
        $query = "INSERT INTO textos_ingles (titulo_ingles, titulo, texto_ingles) 
            VALUES('$titulo_ingles','$titulo','$texto_ingles')";
        
        if ($this->db()->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Borramos el texto con el id pasado como parámetro
     *
     * @param
     *            $id_texto
     * @return
     */
    public function borrarTexto($titulo)
    {
        $query = "DELETE * FROM " . $this->getTable() . " WHERE titulo = '$titulo'";
        if ($this->db()->query($query)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * modificarLibro($id_libro,$titulo,$isbn,$autor,$sinopsis,$genero,$genero2,$resumen,$serie,$pelicula,$banner)
     * Función que se utilizara en modificarLibro.php para modificar un libro.
     *
     * @param
     *            $id_libro
     * @param
     *            $titulo
     * @param
     *            $autor
     * @param
     *            $sinopsis
     * @param
     *            $genero
     * @param
     *            $genero2
     * @param
     *            $resumen
     * @param
     *            $serie
     * @param
     *            $pelicula
     * @param
     *            $banner
     * @return boolean
     */
    public function modificarLibro($id_libro, $titulo, $isbn, $autor, $sinopsis, $genero, $genero2, $resumen, $serie, $pelicula, $banner)
    {
        $sql_query = "UPDATE libros SET titulo= ? , isbn= ?, autor= ?, sinopsis= ?, genero= ?, genero2= ?, resumen= ?, serie= ?, pelicula= ?, banner= ? WHERE id_libro= ?";
        $stmt = $this->c->stmt_init();
        $stmt->prepare($sql_query);
        if ($stmt === false) {
            return false;
        }
        $sino = nl2br($sinopsis);
        $res = nl2br($resumen);
        $stmt->bind_param('sissssssssi', $titulo, $isbn, $autor, $sino, $genero, $genero2, $res, $serie, $pelicula, $banner, $id_libro);
        $stmt->execute();
    }

    /**
     * modificarImgTexto($titulo,$img_portada,$id_libro)
     * Función que se utilizara en modificarLibro.php para modificar la imagen de un libro.
     *
     * @param
     *            $titulo
     * @param
     *            $img_portada
     * @param
     *            $id_libro
     * @return boolean
     */
    public function modificarImgTexto($titulo, $img_portada, $id_libro)
    {
        $titulo = $this->quitarCaracteres($titulo);
        $img = $this->modificarImg($titulo, $img_portada);
        $this->console_log($img);
        $sql_query = "UPDATE $this->tabla SET  " . "  img_portada = ?" . " WHERE id_libro= ?";
        
        $stmt = $this->c->stmt_init();
        $stmt->prepare($sql_query);
        if ($stmt === false) {
            return false;
        }
        $stmt->bind_param('si', $img, $id_libro);
        $stmt->execute();
    }

    /**
     * modificarImg($titulo,$archivo_img)
     * Función utilizada dentro de la función modificarImgLibro,para modificar la imagen de portada
     *
     * @param
     *            $titulo
     * @param
     *            $archivo_img
     */
    public function modificarImg($titulo, $archivo_img)
    {
        $img_name = $archivo_img['name'];
        $img_type = $archivo_img['type'];
        $img_tmp_name = $archivo_img['tmp_name'];
        $img_size = $archivo_img['size'];
        if ($img_type == "image/jpeg" || $img_type == "image/pjpeg" || $img_type == "image/jpg") {
            $extension = "jpg";
        } elseif ($img_type == "image/png") {
            $extension = "png";
        } else {
            $extension = NULL;
        }
        $ruta = "NULL";
        $rutaBD = "NULL";
        $lugar = '../img_libros/';
        // Validamos la imagen
        if ($img_name != NULL and $extension != NULL and $img_size != 0) {
            if ($img_size <= $_REQUEST['lim_tamano']) {
                $nombre_img = $this->normaliza($titulo . "." . $extension);
                $ruta = $lugar . $nombre_img;
                
                if (file_exists($ruta)) {
                    
                    if ($extension == "jpg") {
                        $extension = "png";
                        $this->console_log("Archivo a borrar" . $lugar . $this->normaliza($titulo . ".jpg"));
                        unlink($lugar . $this->normaliza($titulo . ".jpg"));
                    } else {
                        $extension = "jpg";
                        $this->console_log("Archivo a borrar" . $lugar . $this->normaliza($titulo . ".png"));
                        unlink($lugar . $this->normaliza($titulo . ".png"));
                    }
                    $nombre_img = $this->normaliza($titulo . "." . $extension);
                    $ruta = $lugar . $nombre_img;
                }
                
                // Guardamos la foto en la carpeta del proyecto "img_libros"
                move_uploaded_file($img_tmp_name, $ruta);
                // Declaramos la ruta de la imagen en la base de datos
                $rutaBD = $nombre_img;
            } else {
                $rutaOrigen = "../img_libros/libro_generico.jpg";
                $rutaFinal = $this->normaliza($lugar . $titulo . ".png");
                copy($rutaOrigen, $rutaFinal);
                $rutaBD = $this->normaliza($titulo . ".png");
            }
        } else { // en caso de que el usuario no inserte imagen
            $rutaOrigen = "../img_libros/libro_generico.jpg";
            $rutaFinal = $this->normaliza($lugar . $titulo . ".png");
            copy($rutaOrigen, $rutaFinal);
            $rutaBD = $this->normaliza($titulo . ".png");
        }
        return $rutaBD;
    }

    /**
     * mostrarLibrosRelacionados($genero, $genero2, $autor, $id_libro)
     * Muestra los libros relacionados con el que se muestra
     *
     * @param
     *            $genero
     * @param
     *            $genero2
     * @param
     *            $autor
     * @param
     *            $id_libro
     */
    public function mostrarLibrosRelacionados($genero, $genero2, $autor, $id_libro)
    {
        $this->console_log($genero);
        $this->console_log($genero2);
        $this->console_log($autor);
        $this->console_log($id_libro);
        $resultados = $this->buscarLibrosRelacionados($genero, $genero2, $autor, $id_libro);
        if ($resultados['numero'] == 5) {
            echo "<h2>Te pueden interesar...</h2>";
            echo "<div class='ultimosSubidos'><ul class='temas_flex libros_pequenos'>";
            for ($i = 0; $i < count($resultados['filas_consulta']); $i ++) {
                foreach ($resultados['filas_consulta'][$i] as $key => $value) {
                    if ($key == "id_libro") {
                        $id_libro_actual = $value;
                    } elseif ($key == "img_portada") {
                        $img_portada = $value;
                    } elseif ($key == "titulo") {
                        $titulo = $value;
                        $myvar = str_replace(" ", "-", $titulo);
                    }
                }
                echo "<li><a href='../Libro/" . $myvar . "'><img src='../img_libros/" . $img_portada . "' alt='" . $titulo . "' title='" . $titulo . "'/></a></li>";
            }
            echo "</ul></div>";
        }
    }
    
    // /**
    // * buscarLibrosRelacionados($genero, $genero2, $autor, $id_libro)
    // * busca 5 libros relacionados por autor o género con el que se muestra (Gracias Mate!)
    // *
    // * @param
    // * $genero
    // * @param
    // * $genero2
    // * @param
    // * $autor
    // * @param
    // * $id_libro
    // * @return $datos
    // */
    // public function buscarLibrosRelacionados($genero, $genero2, $autor, $id_libro)
    // {
    // $c = Connection::dameInstancia();
    // $conexion = $c->dameConexion();
    // $consulta = "SELECT (CASE WHEN t.autor='" . $autor . "' THEN 1 WHEN t.genero='" . $genero . "' THEN 2 ELSE 3 END) as orden, t.* FROM libros t WHERE ( t.autor='" . $autor . "' or t.genero in ('" . $genero . "', '" . $genero2 . "') or t.genero2 in ('" . $genero . "', '" . $genero2 . "') ) and t.id_libro!='" . $id_libro . "' ORDER BY 1,2 limit 5";
    // $resultado = $conexion->query($consulta);
    // if ($resultado->num_rows != 0) {
    // while ($row = $resultado->fetch_assoc()) {
    // $rows[] = $row;
    // }
    // $datos = array(
    // 'numero' => $resultado->num_rows,
    // 'filas_consulta' => $rows
    // );
    // return $datos;
    // } else {
    // return $datos = array(
    // 'numero' => 0
    // );
    // }
    // }
    
    // /**
    // * libro_del_dia()
    // * Función utilizada en index.php,para mostrar un libro aleatorio cada vez que entremos en la página
    // */
    // public function libro_del_dia()
    // {
    // // Mostrará cada vez un registro distinto
    // $sql = "SELECT id_libro,titulo,autor,genero,sinopsis,genero2,img_portada FROM " . $this->tabla . " ORDER BY RAND() LIMIT 1";
    // if ($this->c->real_query($sql)) {
    // if ($resul = $this->c->store_result()) {
    // if ($resul->num_rows > 0) {
    // echo "<div class='libroRand'>";
    // while ($mostrar = $resul->fetch_assoc()) {
    // $myvar = str_replace(" ", "-", $mostrar["titulo"]);
    // echo "<div class='imagenRand'>" . "<a href='Libro/" . $myvar . "'><img src='./img_libros/" . $mostrar['img_portada'] . "' alt='" . $mostrar["titulo"] . "' title='" . $mostrar["titulo"] . "'/></a>" . "</div>";
    // echo "<div class='descripcionRand'>" . "<h4>Título</h4> " . $mostrar["titulo"] . "" . "<h4>Sinopsis</h4> " . $mostrar["sinopsis"] . "" . "<h4>Autor</h4> " . $mostrar["autor"] . "" . "<h4>Genero/s</h4> " . $mostrar["genero"];
    // if ($mostrar["genero2"] != 'NULL') {
    // echo ", " . $mostrar["genero2"];
    // } else {
    // echo "";
    // }
    // echo "</div>";
    // }
    // echo "</div>";
    // $resul->free_result();
    // } else {
    // $resul->free_result();
    // }
    // }
    // } else {
    // echo $this->c->errno . " -> " . $this->c->error;
    // }
    // }
    
    // /**
    // * mostrarVotacion($id_libro)
    // * Función utilizada dentro de la función mostrarLibro(),para mostrar la votación media de cada libro
    // *
    // * @param
    // * $id_libro
    // * @return $row['votacion'] La media de la votación
    // */
    // public function mostrarVotacion($id_libro)
    // {
    // $c = Connection::dameInstancia();
    // $conexion = $c->dameConexion();
    // $consulta = "SELECT avg(votacion) as votacion from usuarios_votan_libros where id_libro=" . $id_libro;
    // $resultado = $conexion->query($consulta);
    // $row = $resultado->fetch_assoc();
    // return round($row['votacion'], 1);
    // }
    
    // /**
    // * mostrarComentarios($id_libro)
    // * Función utilizada en visorLibro.php,para mostrar todos los comentario de un libro
    // *
    // * @param
    // * $id_libro
    // */
    // public function mostrarComentarios($id_libro)
    // {
    // $sql = "SELECT A.comentario,A.votacion,A.fecha_comentario,B.nombre,B.nick FROM usuarios_comentan_libros A, usuarios B WHERE id_libro='" . $id_libro . "' AND A.id_usuario=B.id_usuario ORDER BY fecha_comentario";
    // if ($this->c->real_query($sql)) {
    // if ($resul = $this->c->store_result()) {
    // if ($resul->num_rows > 0) {
    // while ($mostrar = $resul->fetch_assoc()) {
    // echo "<div class='comentarios'>
    // <h4>" . $mostrar["nick"] . "</h4>
    // " . $mostrar["comentario"] . "
    // <h4> " . $mostrar["fecha_comentario"] . "</h4>";
    // echo "</div>";
    // }
    // $resul->free_result();
    // } else {
    // $resul->free_result();
    // echo "<div class='comentarios'>No hay comentarios para este libro, ¡sé el primero!</div>";
    // }
    // }
    // } else {
    // echo $this->c->errno . " -> " . $this->c->error;
    // }
    // }
    
    // /**
    // * nombreLibro($id)
    // * Función que devuelve el nombre de un libro a partir de su id.
    // *
    // * @param
    // * $id
    // * @return $mostrar["titulo"] el título del libro
    // */
    // public function nombreLibro($id)
    // {
    // $sql = "SELECT titulo FROM " . $this->tabla . " WHERE id_libro='" . $id . "'";
    // if ($this->c->real_query($sql)) {
    // if ($resul = $this->c->store_result()) {
    // $mostrar = $resul->fetch_assoc();
    // return $mostrar["titulo"];
    // }
    // } else {
    // echo $this->c->errno . " -> " . $this->c->error;
    // }
    // }
    
    // /**
    // * get_isbn($id)
    // * Función que devuelve el número isbn de un libro a partir de su id.
    // *
    // * @param
    // * $id
    // * @return $mostrar["isbn"] el número isbn del libro
    // */
    // public function get_isbn($id)
    // {
    // $sql = "SELECT isbn FROM " . $this->tabla . " WHERE id_libro='" . $id . "'";
    // if ($this->c->real_query($sql)) {
    // if ($resul = $this->c->store_result()) {
    // $mostrar = $resul->fetch_assoc();
    // return $mostrar["isbn"];
    // }
    // } else {
    // echo $this->c->errno . " -> " . $this->c->error;
    // }
    // }
    
    // /**
    // * get_autor($id)
    // * Función que devuelve el autor de un libro a partir de su id.
    // *
    // * @param
    // * $id
    // * @return $mostrar["autor"] el autor del libro
    // */
    // public function get_autor($id)
    // {
    // $sql = "SELECT autor FROM " . $this->tabla . " WHERE id_libro='" . $id . "'";
    // if ($this->c->real_query($sql)) {
    // if ($resul = $this->c->store_result()) {
    // $mostrar = $resul->fetch_assoc();
    // return $mostrar["autor"];
    // }
    // } else {
    // echo $this->c->errno . " -> " . $this->c->error;
    // }
    // }
    
    // /**
    // * get_genero($id)
    // * Función que devuelve el género de un libro a partir de su id.
    // *
    // * @param
    // * $id
    // * @return $mostrar["genero"] el género del libro
    // */
    // public function get_genero($id)
    // {
    // $sql = "SELECT genero FROM " . $this->tabla . " WHERE id_libro='" . $id . "'";
    // if ($this->c->real_query($sql)) {
    // if ($resul = $this->c->store_result()) {
    // $mostrar = $resul->fetch_assoc();
    // return $mostrar["genero"];
    // }
    // } else {
    // echo $this->c->errno . " -> " . $this->c->error;
    // }
    // }
    
    // /**
    // * get_genero2($id)
    // * Función que devuelve el género2 de un libro a partir de su id.
    // *
    // * @param
    // * $id
    // * @return $mostrar["genero2"] el género2 del libro
    // */
    // public function get_genero2($id)
    // {
    // $sql = "SELECT genero2 FROM " . $this->tabla . " WHERE id_libro='" . $id . "'";
    // if ($this->c->real_query($sql)) {
    // if ($resul = $this->c->store_result()) {
    // $mostrar = $resul->fetch_assoc();
    // return $mostrar["genero2"];
    // }
    // } else {
    // echo $this->c->errno . " -> " . $this->c->error;
    // }
    // }
    
    // /**
    // * get_sinopsis($id)
    // * Función que devuelve la sinopsis de un libro a partir de su id.
    // *
    // * @param
    // * $id
    // * @return $mostrar["sinopsis"] la sinopsis del libro
    // */
    // public function get_sinopsis($id)
    // {
    // $sql = "SELECT sinopsis FROM " . $this->tabla . " WHERE id_libro='" . $id . "'";
    // if ($this->c->real_query($sql)) {
    // if ($resul = $this->c->store_result()) {
    // $mostrar = $resul->fetch_assoc();
    // return $mostrar["sinopsis"];
    // }
    // } else {
    // echo $this->c->errno . " -> " . $this->c->error;
    // }
    // }
    
    // /**
    // * get_resumen($id)
    // * Función que devuelve el resumen de un libro a partir de su id.
    // *
    // * @param
    // * $id
    // * @return $mostrar["resumen"] el resumen del libro
    // */
    // public function get_resumen($id)
    // {
    // $sql = "SELECT resumen FROM " . $this->tabla . " WHERE id_libro='" . $id . "'";
    // if ($this->c->real_query($sql)) {
    // if ($resul = $this->c->store_result()) {
    // $mostrar = $resul->fetch_assoc();
    // return $mostrar["resumen"];
    // }
    // } else {
    // echo $this->c->errno . " -> " . $this->c->error;
    // }
    // }
    
    // /**
    // * get_banner($id)
    // * Función que devuelve el banner de un libro a partir de su id.
    // *
    // * @param
    // * $id
    // * @return $mostrar["banner"] el resumen del libro
    // */
    // public function get_banner($id)
    // {
    // $sql = "SELECT banner FROM " . $this->tabla . " WHERE id_libro='" . $id . "'";
    // if ($this->c->real_query($sql)) {
    // if ($resul = $this->c->store_result()) {
    // $mostrar = $resul->fetch_assoc();
    // return $mostrar["banner"];
    // }
    // } else {
    // echo $this->c->errno . " -> " . $this->c->error;
    // }
    // }
    
    // /**
    // * get_serie($id)
    // * Función que devuelve la serie de un libro a partir de su id.
    // *
    // * @param
    // * $id
    // * @return $mostrar["serie"] la serie del libro
    // */
    // public function get_serie($id)
    // {
    // $sql = "SELECT serie FROM " . $this->tabla . " WHERE id_libro='" . $id . "'";
    // if ($this->c->real_query($sql)) {
    // if ($resul = $this->c->store_result()) {
    // $mostrar = $resul->fetch_assoc();
    // return $mostrar["serie"];
    // }
    // } else {
    // echo $this->c->errno . " -> " . $this->c->error;
    // }
    // }
    
    // /**
    // * get_pelicula($id)
    // * Función que devuelve la película de un libro a partir de su id.
    // *
    // * @param
    // * $id
    // * @return $mostrar["pelicula"] la película del libro
    // */
    // public function get_pelicula($id)
    // {
    // $sql = "SELECT pelicula FROM " . $this->tabla . " WHERE id_libro='" . $id . "'";
    // if ($this->c->real_query($sql)) {
    // if ($resul = $this->c->store_result()) {
    // $mostrar = $resul->fetch_assoc();
    // return $mostrar["pelicula"];
    // }
    // } else {
    // echo $this->c->errno . " -> " . $this->c->error;
    // }
    // }
    
    // /**
    // * get_imagen($id)
    // * Función que devuelve la imagen de un libro a partir de su id.
    // *
    // * @param
    // * $id
    // * @return $mostrar["img_portada"] la imagen del libro
    // */
    // public function get_imagen($id)
    // {
    // $sql = "SELECT img_portada FROM " . $this->tabla . " WHERE id_libro='" . $id . "'";
    // if ($this->c->real_query($sql)) {
    // if ($resul = $this->c->store_result()) {
    // $mostrar = $resul->fetch_assoc();
    // return $mostrar["img_portada"];
    // }
    // } else {
    // echo $this->c->errno . " -> " . $this->c->error;
    // }
    // }
    
    // /**
    // * get_id_usuario_libro($titulo)
    // * Función que devuelve el id de un libro a partir de su titulo.
    // *
    // * @param
    // * $titulo
    // * @return $mostrar["id"] el del libro
    // */
    // public function get_id_usuario_libro($titulo)
    // {
    // $sql = "SELECT id_usuario FROM " . $this->tabla . " WHERE titulo='" . $titulo . "'";
    // if ($this->c->real_query($sql)) {
    // if ($resul = $this->c->store_result()) {
    // $mostrar = $resul->fetch_assoc();
    // return $mostrar["id_usuario"];
    // }
    // } else {
    // echo $this->c->errno . " -> " . $this->c->error;
    // }
    // }
    
    // /**
    // * get_comentario($id_libro,$id_usuario)
    // * Función utilizada en modificarComentario.php que devuelve el comentario de un usuario de un libro.
    // *
    // * @param
    // * $id_libro,$id_usuario
    // * @return $mostrar["comentario"] el comentario del libro
    // */
    // public function get_comentario($id_libro, $id_usuario)
    // {
    // $c = Connection::dameInstancia();
    // $conexion = $c->dameConexion();
    // $consulta = "SELECT comentario FROM usuarios_comentan_libros WHERE id_libro='" . $id_libro . "' AND id_usuario='" . $id_usuario . "'";
    // $resultado = $conexion->query($consulta);
    // if ($resultado->num_rows != 0) {
    // $mostrar = $resultado->fetch_assoc();
    // return $mostrar["comentario"];
    // }
    // }
    
    // /**
    // * get_votacion($id_libro,$id_usuario)
    // * Función utilizada en modificarComentario.php que devuelve la votación de un usuario de un libro.
    // *
    // * @param
    // * $id_libro,$id_usuario
    // * @return $mostrar["votacion"] la votación del libro
    // */
    // public function get_votacion($id_libro, $id_usuario)
    // {
    // $c = Connection::dameInstancia();
    // $conexion = $c->dameConexion();
    // $consulta = "SELECT votacion FROM usuarios_comentan_libros WHERE id_libro='" . $id_libro . "' AND id_usuario='" . $id_usuario . "'";
    // $resultado = $conexion->query($consulta);
    // if ($resultado->num_rows != 0) {
    // $mostrar = $resultado->fetch_assoc();
    // return $mostrar["votacion"];
    // }
    // }
    
    // /**
    // * buscarTitulo($cadena):
    // * Función utilizada en buscador.php y que devuelve un array con el numero de resultados de la consulta como primer parametro
    // * y los resultados de la misma como segundo como $clave => $valor.
    // *
    // * @param
    // * $cadena
    // * @return $datos
    // */
    // public static function buscarTitulo($cadena)
    // {
    // $c = Connection::dameInstancia();
    // $conexion = $c->dameConexion();
    // $consulta = "Select * from libros where titulo like '%" . $cadena . "%' OR autor like '%" . $cadena . "%' OR genero like '%" . $cadena . "%' ORDER BY titulo ASC";
    // $resultado = $conexion->query($consulta);
    // if ($resultado->num_rows != 0) {
    // while ($row = $resultado->fetch_assoc()) {
    // $rows[] = $row;
    // }
    // $datos = array(
    // 'numero' => $resultado->num_rows,
    // 'filas_consulta' => $rows
    // );
    // return $datos;
    // } else {
    // return $datos = array(
    // 'numero' => 0
    // );
    // }
    // }
    
    // /**
    // * buscarTituloLimit( $cadena, $inicio,$TAMANO_PAGINA ):
    // * Función utilizada en buscador.php y que devuelve un array con el numero de resultados de la consulta como primer parametro
    // * y los resultados de la misma como segundo como $clave => $valor.
    // * Con LIMIT
    // *
    // * @param
    // * $cadena
    // * @param
    // * $inicio
    // * @param
    // * $TAMANO_PAGINA
    // * @return $datos
    // */
    // public static function buscarTituloLimit($cadena, $inicio, $TAMANO_PAGINA)
    // {
    // $c = Connection::dameInstancia();
    // $conexion = $c->dameConexion();
    // $consulta = "Select * from libros where titulo like '%" . $cadena . "%' OR autor like '%" . $cadena . "%' OR genero like '%" . $cadena . "%' ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
    // $resultado = $conexion->query($consulta);
    // if ($resultado->num_rows != 0) {
    // while ($row = $resultado->fetch_assoc()) {
    // $rows[] = $row;
    // }
    // $datos = array(
    // 'numero' => $resultado->num_rows,
    // 'filas_consulta' => $rows
    // );
    // return $datos;
    // } else {
    // return $datos = array(
    // 'numero' => 0
    // );
    // }
    // }
    
    // /**
    // * buscarLibro($titulo,$autor,$isbn,$genero):
    // * Función utilizada en buscadorAvanzado.php y que devuelve un array con el numero de resultados de las consultas como primer parametro
    // * y los resultados de la misma como segundo como $clave => $valor.
    // * Podremos buscar por un parámetro, dos, tres o los cuatro.
    // *
    // * @param
    // * $titulo
    // * @param
    // * $autor
    // * @param
    // * $isbn
    // * @param
    // * $genero
    // * @return $datos
    // */
    // public static function buscarLibro($titulo, $autor, $isbn, $genero)
    // {
    // $c = Connection::dameInstancia();
    // $conexion = $c->dameConexion();
    // if (! empty($titulo)) {
    // if (! empty($autor)) {
    // if (! empty($isbn)) {
    // if ($genero != "cualquiera") {
    // $consulta = "Select * from libros where titulo like '%" . $titulo . "%' AND autor like '%" . $autor . "%' AND isbn='" . $isbn . "' AND (genero='" . $genero . "' OR genero2='" . $genero . "') ORDER BY titulo ASC";
    // } else {
    // $consulta = "Select * from libros where titulo like '%" . $titulo . "%' AND autor like '%" . $autor . "%' AND isbn='" . $isbn . "' ORDER BY titulo ASC";
    // }
    // } else {
    // if ($genero != "cualquiera") {
    // $consulta = "Select * from libros where titulo like '%" . $titulo . "%' AND autor like '%" . $autor . "%' AND (genero='" . $genero . "' OR genero2='" . $genero . "') ORDER BY titulo ASC";
    // } else {
    // $consulta = "Select * from libros where titulo like '%" . $titulo . "%' AND autor like '%" . $autor . "%' ORDER BY titulo ASC";
    // }
    // }
    // } else {
    // if (! empty($isbn)) {
    // if ($genero != "cualquiera") {
    // $consulta = "Select * from libros where titulo like '%" . $titulo . "%' AND isbn='" . $isbn . "' AND (genero='" . $genero . "' OR genero2='" . $genero . "') ORDER BY titulo ASC";
    // } else {
    // $consulta = "Select * from libros where titulo like '%" . $titulo . "%' AND isbn='" . $isbn . "' ORDER BY titulo ASC";
    // }
    // } else {
    // if ($genero != "cualquiera") {
    // $consulta = "Select * from libros where titulo like '%" . $titulo . "%' AND (genero='" . $genero . "' OR genero2='" . $genero . "') ORDER BY titulo ASC";
    // } else {
    // $consulta = "Select * from libros where titulo like '%" . $titulo . "%' ORDER BY titulo ASC";
    // }
    // }
    // }
    // } else {
    // if (! empty($autor)) {
    // if (! empty($isbn)) {
    // if ($genero != "cualquiera") {
    // $consulta = "Select * from libros where autor like '%" . $autor . "%' AND isbn='" . $isbn . "' AND (genero='" . $genero . "' OR genero2='" . $genero . "') ORDER BY titulo ASC";
    // } else {
    // $consulta = "Select * from libros where autor like '%" . $autor . "%' AND isbn='" . $isbn . "' ORDER BY titulo ASC";
    // }
    // } else {
    // if ($genero != "cualquiera") {
    // $consulta = "Select * from libros where autor like '%" . $autor . "%' AND (genero='" . $genero . "' OR genero2='" . $genero . "') ORDER BY titulo ASC";
    // } else {
    // $consulta = "Select * from libros where autor like '%" . $autor . "%' ORDER BY titulo ASC";
    // }
    // }
    // } else {
    // if (! empty($isbn)) {
    // if ($genero != "cualquiera") {
    // $consulta = "Select * from libros where isbn='" . $isbn . "' AND (genero='" . $genero . "' OR genero2='" . $genero . "') ORDER BY titulo ASC";
    // } else {
    // $consulta = "Select * from libros where isbn='" . $isbn . "' ORDER BY titulo ASC";
    // }
    // } else {
    // if ($genero != "cualquiera") {
    // $consulta = "Select * from libros where genero='" . $genero . "' OR genero2='" . $genero . "' ORDER BY titulo ASC";
    // } else {
    // $consulta = "Select * from libros ORDER BY titulo ASC";
    // }
    // }
    // }
    // }
    // $resultado = $conexion->query($consulta);
    // if ($resultado->num_rows != 0) {
    // while ($row = $resultado->fetch_assoc()) {
    // $rows[] = $row;
    // }
    // $datos = array(
    // 'numero' => $resultado->num_rows,
    // 'filas_consulta' => $rows
    // );
    // return $datos;
    // } else {
    // return $datos = array(
    // 'numero' => 0
    // );
    // }
    // }
    
    // /**
    // * buscarLibroLimit($titulo,$autor,$isbn,$genero,$inicio,$TAMANO_PAGINA):
    // * Función utilizada en buscadorAvanzado.php y que devuelve un array con el numero de resultados de las consultas como primer parametro
    // * y los resultados de la misma como segundo como $clave => $valor.
    // * Podremos buscar por un parámetro, dos, tres o los cuatro. Con LIMIT
    // *
    // * @param
    // * $titulo
    // * @param
    // * $autor
    // * @param
    // * $isbn
    // * @param
    // * $genero
    // * @param
    // * $inicio
    // * @param
    // * $TAMANO_PAGINA
    // * @return $datos
    // */
    // public static function buscarLibroLimit($titulo, $autor, $isbn, $genero, $inicio, $TAMANO_PAGINA)
    // {
    // $c = Connection::dameInstancia();
    // $conexion = $c->dameConexion();
    // if (! empty($titulo)) {
    // if (! empty($autor)) {
    // if (! empty($isbn)) {
    // if ($genero != "cualquiera") {
    // $consulta = "Select * from libros where titulo like '%" . $titulo . "%' AND autor like '%" . $autor . "%' AND isbn='" . $isbn . "' AND (genero='" . $genero . "' OR genero2='" . $genero . "') ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
    // } else {
    // $consulta = "Select * from libros where titulo like '%" . $titulo . "%' AND autor like '%" . $autor . "%' AND isbn='" . $isbn . "' ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
    // }
    // } else {
    // if ($genero != "cualquiera") {
    // $consulta = "Select * from libros where titulo like '%" . $titulo . "%' AND autor like '%" . $autor . "%' AND (genero='" . $genero . "' OR genero2='" . $genero . "') ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
    // } else {
    // $consulta = "Select * from libros where titulo like '%" . $titulo . "%' AND autor like '%" . $autor . "%' ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
    // }
    // }
    // } else {
    // if (! empty($isbn)) {
    // if ($genero != "cualquiera") {
    // $consulta = "Select * from libros where titulo like '%" . $titulo . "%' AND isbn='" . $isbn . "' AND (genero='" . $genero . "' OR genero2='" . $genero . "') ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
    // } else {
    // $consulta = "Select * from libros where titulo like '%" . $titulo . "%' AND isbn='" . $isbn . "' ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
    // }
    // } else {
    // if ($genero != "cualquiera") {
    // $consulta = "Select * from libros where titulo like '%" . $titulo . "%' AND (genero='" . $genero . "' OR genero2='" . $genero . "') ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
    // } else {
    // $consulta = "Select * from libros where titulo like '%" . $titulo . "%' ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
    // }
    // }
    // }
    // } else {
    // if (! empty($autor)) {
    // if (! empty($isbn)) {
    // if ($genero != "cualquiera") {
    // $consulta = "Select * from libros where autor like '%" . $autor . "%' AND isbn='" . $isbn . "' AND (genero='" . $genero . "' OR genero2='" . $genero . "') ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
    // } else {
    // $consulta = "Select * from libros where autor like '%" . $autor . "%' AND isbn='" . $isbn . "' ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
    // }
    // } else {
    // if ($genero != "cualquiera") {
    // $consulta = "Select * from libros where autor like '%" . $autor . "%' AND (genero='" . $genero . "' OR genero2='" . $genero . "') ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
    // } else {
    // $consulta = "Select * from libros where autor like '%" . $autor . "%' ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
    // }
    // }
    // } else {
    // if (! empty($isbn)) {
    // if ($genero != "cualquiera") {
    // $consulta = "Select * from libros where isbn='" . $isbn . "' AND (genero='" . $genero . "' OR genero2='" . $genero . "') ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
    // } else {
    // $consulta = "Select * from libros where isbn='" . $isbn . "' ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
    // }
    // } else {
    // if ($genero != "cualquiera") {
    // $consulta = "Select * from libros where genero='" . $genero . "' OR genero2='" . $genero . "' ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
    // } else {
    // $consulta = "Select * from libros ORDER BY titulo ASC LIMIT " . $inicio . "," . $TAMANO_PAGINA;
    // }
    // }
    // }
    // }
    // $resultado = $conexion->query($consulta);
    // if ($resultado->num_rows != 0) {
    // while ($row = $resultado->fetch_assoc()) {
    // $rows[] = $row;
    // }
    // $datos = array(
    // 'numero' => $resultado->num_rows,
    // 'filas_consulta' => $rows
    // );
    // return $datos;
    // } else {
    // return $datos = array(
    // 'numero' => 0
    // );
    // }
    // }
    
    // /**
    // * libros_mejor_valorados():
    // * Función utilizada en index.php y que devuelve los 5 libros mejor valorados.
    // *
    // * @return $rows
    // */
    // public static function libros_mejor_valorados()
    // {
    // $c = Connection::dameInstancia();
    // $conexion = $c->dameConexion();
    // $consulta = "select libros.id_libro,libros.titulo,libros.fecha_subida,libros.img_portada,avg(usuarios_votan_libros.votacion) from libros, usuarios_votan_libros where usuarios_votan_libros.id_libro=libros.id_libro group by libros.id_libro having count(usuarios_votan_libros.votacion) > 1 order by avg(usuarios_votan_libros.votacion) DESC LIMIT 5";
    // $resultado = $conexion->query($consulta);
    // if ($resultado->num_rows == 0) {
    // return 0;
    // } else {
    // while ($row = $resultado->fetch_assoc()) {
    // $rows[] = $row;
    // }
    // return $rows;
    // }
    // }
    
    // /**
    // * console_log
    // * Sacamos por consola lo que le pasemos
    // *
    // * @param
    // * $data
    // */
    // function console_log($data)
    // {
    // echo '<script>';
    // echo 'console.log(' . json_encode($data) . ')';
    // echo '</script>';
    // }
}
?>
