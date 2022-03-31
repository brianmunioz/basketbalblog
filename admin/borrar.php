<?php session_start();
    require 'config.php';
    require '../functions.php';
    comprobarSesion();
//index admin--------------------------------------------------------------------
    $conn = conexion($bd_config);

    if(!$conn){
        header('Location: ../error.php');
    }
    $id = limpiarDatos($_GET['id']);
    if(!$id){
        header('Location: '.RUTA.'/admin');
    }
    $statement = $conn->prepare('DELETE FROM articulos WHERE id = :id');
    $statement->execute(array(
        ':id' => $id
    ));
    $statement = null;
    header('Location: '.RUTA.'/admin');
?>