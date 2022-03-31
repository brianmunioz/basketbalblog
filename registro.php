<?php session_start();
require 'admin/config.php';
require 'functions.php';
$errores = '';

if(isset($_SESSION['admin'])){
    header('Location: index.php');
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $usuario = limpiarDatos($_POST['usuario']);
    $usuario = strtolower($usuario);
    $pass = hash('sha512',$_POST['password']);
    $pass2 = hash('sha512',$_POST['password2']);
    $nombre = limpiarDatos($_POST['nombre']);
    $apellido = limpiarDatos($_POST['apellido']);
    $email = limpiarDatos($_POST['email']);
    $email2 = limpiarDatos($_POST['email2']);
    if(empty($usuario) || empty($pass) || empty($nombre) || empty($apellido) || empty($email)){
        $errores = 'Error: No puede dejar campos vacios';
    }elseif($pass != $pass2){
        $errores = 'Error: las contraseñas no coinciden';
    }elseif($email != $email2){
        $errores = 'Error: los email no coinciden';
    }

    if($errores === ''){
        $conn = conexion($bd_config);
        $statement = $conn->prepare('SELECT * FROM usuarios WHERE usuario = :usuario LIMIT 1');
        $statement->execute(array(
            ':usuario' => $usuario
        ));
        $resultado = $statement->fetch();
    
        if(!$resultado){            
            $statement = $conn->prepare('INSERT INTO usuarios ( usuario, pass, nombre, apellido, email) 
            VALUES (:usuario, :pass, :nombre, :apellido, :email)');
            $statement->execute(array(
                ':usuario' => $usuario,
                ':pass' => $pass,
                ':nombre' => $nombre,
                ':apellido' => $apellido,
                ':email' => $email                
            ));                      
        }else{
            $errores = 'Error: el nombre de usuario ya existe en nuestra base de datos';
        }
    header('Location: login.php');
    }
}
require 'views/registro.view.php';
?>