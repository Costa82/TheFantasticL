<?php
require_once './config/validaciones.php';

/**
 * Controlador de gestión de usuarios
 */
class ControladorUsuarios
{

    /**
     * Método por defecto de entrada en la web
     */
    public function inicio()
    {
        if (isset($_GET['opcion'])) {
            $params['error'] = $_GET['opcion'];
        } else {
            $params['error'] = 0;
        }
        require './views/inicio.php';
    }
    
    // /**
    // * Formulario de registro y registrar al usuario en la bd
    // */
    // public function registrar(){
    // //Redirigimos a ver los mensajes
    
    // if(isset($_GET['opcion'])){
    // $params['error']=$_GET['opcion'];
    // }else{
    // $params['error']=0;
    // }
    // if($_SERVER['REQUEST_METHOD']=='POST'){
    // if (!empty($_POST['clave']) && !empty($_POST['email'])
    // && !empty($_POST['nombre']) && !empty($_POST['apellidos'])){
    // /*if($_POST['noValido']=='noValido'){
    // header('location:registrar/2');
    // die();
    // }*/
    // if(validar_correo($_POST['email'])==false){
    // header('location:registrar/3');
    // die();
    // }
    
    // $usuarios = new Usuarios();
    // $nombre = $_POST['nombre'];
    // $nombre = test_input($nombre);
    // $apellidos = $_POST['apellidos'];
    // $apellidos = test_input($apellidos);
    // $email = $_POST['email'];
    // $clave = $_POST['clave'];
    // $clave = test_input($clave);
    // $avatar = $_POST['avatar'];
    // $str = time();
    // $codigoActivacion = md5($str);
    // $datos_usuario = array('nombre'=>$nombre, 'apellidos'=>$apellidos, 'email'=>$email, 'clave'=>$clave, 'avatar'=>$avatar, 'codigoActivacion'=>$codigoActivacion);
    // $usuarios->set($datos_usuario);
    // header ('location:inicio');
    // }else{
    // header('location:registrar/1');
    // }
    // }else{
    // require 'app/views/registrar.php';
    // }
    // }
    
    // /**
    // * Comprobación de usuario y clave, y creación de las variables de sesión y cookies
    // */
    // public function login(){
    // if($_SERVER['REQUEST_METHOD']=='POST'){
    // echo $_POST['email'];
    // echo $_POST['clave'];
    // if(!empty($_POST['email']) && !empty($_POST['clave'])){
    // $email = test_input($_POST['email']);
    // $clave = test_input($_POST['clave']);
    // $usuario = new Usuarios();
    // if($usuario->comprobar_login($email,$clave)){
    // $_SESSION['usuario']=$_POST['email'];
    // //Siempre vamos a guardar la cookie durante 1 semana
    // setcookie('usuario',md5($_SESSION['usuario']),time()+24*60*60*7);
    // header('location:inicio');
    // }else{
    // header('location:inicio/2');
    // }
    // }else{
    // header('location:inicio/1');
    // }
    // }else{
    // header('Location:inicio');
    // }
    // }
    // /**
    // * Modificacion usuario
    // */
    // public function modificar_usuario(){
    // if(isset($_GET['opcion'])){
    // $params['error']=$_GET['opcion'];
    // }else{
    // $params['error']=0;
    // }
    // if($_SERVER['REQUEST_METHOD']=='POST'){
    // if (!empty($_POST['clave']) && !empty($_POST['email'])
    // && !empty($_POST['nombre']) && !empty($_POST['apellidos'])){
    // /*if($_POST['noValido']=='noValido'){
    // header('location:registrar/2');
    // die();
    // }*/
    // if(validar_correo($_POST['email'])==false){
    // header('location:registrar/3');
    // die();
    // }
    
    // $usuarios = new Usuarios();
    // $nombre = $_POST['nombre'];
    // $nombre = test_input($nombre);
    // $apellidos = $_POST['apellidos'];
    // $apellidos = test_input($apellidos);
    // $email = $_POST['email'];
    // $avatar = $_POST['avatar'];
    // $datos_usuario = array('nombre'=>$nombre, 'apellidos'=>$apellidos, 'email'=>$email, 'avatar'=>$avatar);
    // $usuarios->edit($datos_usuario);
    // header ('location:inicio');
    // }else{
    // header('location:registrar/1');
    // }
    // }else{
    // $usuarios = new Usuarios();
    
    // $usuarios->get($_SESSION['usuario']);
    
    // foreach ( $usuarios as $propiedad => $valor ) {
    // $params [$propiedad] = $valor;
    // }
    
    // require 'app/views/modificar_usuario.php';
    // }
    // }
    
    // /**
    // * Funcion que realiza un logout de la página
    // */
    // public function logout(){
    // session_destroy();
    // setcookie('usuario',md5($_SESSION['usuario']),time()-30);
    // header('location:inicio');
    // }
    
    // /**
    // * Funcion que permite hacer login con facebook
    // */
    // public function loginfacebook(){
    // require("loginfacebook.php");
    // }
}
?>