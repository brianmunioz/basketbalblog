<?php session_start();
    require 'admin/config.php';
    require 'functions.php';
    if(isset($_SESSION['admin'])){
        header('Location: index.php');
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $usuario = limpiarDatos($_POST['usuario']);
        $pass = $_POST['password'];
        $pass = hash('sha512',$pass);   
        $conn = conexion($bd_config);
        $statement = $conn -> prepare('SELECT * FROM usuarios WHERE usuario = :usuario and pass = :pass LIMIT 1');
        $statement->execute(array(
       ':usuario' => $usuario,
       ':pass' => $pass
        ));
   $resultado = $statement->fetch();   
   if($resultado){
        $_SESSION['admin'] = $usuario;
        header('Location: admin/index.php');
   }
   else {
        echo '<li>Datos incorrectos</li>';
    }
    }

    require 'views/login.view.php';
?>
