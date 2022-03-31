<?php session_start();
    require 'config.php';
    require '../functions.php';
    comprobarSesion();
//index admin
    $conn = conexion($bd_config);
    if(!$conn){
        header('Location: ../error.php');
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $titulo = limpiarDatos($_POST['titulo']);
        $extracto = limpiarDatos($_POST['extracto']);
        $texto = limpiarDatos($_POST['texto']);
        $thumb = $_FILES['thumb']['tmp_name'];
        $archivoSubido = '..'.$blog_config['carpeta_imagenes'] . $_FILES['thumb']['name'];
        move_uploaded_file($thumb, $archivoSubido);
        $statement = $conn->prepare('
        INSERT INTO articulos (id,titulo,extracto,texto,thumb) VALUES (null , :titulo , :extracto , :texto , :thumb)
        ');
        $statement->execute(array(
            ':titulo'=>$titulo,
            ':extracto'=>$extracto,
            ':texto'=>$texto,
            ':thumb'=>$_FILES['thumb']['name']
        ));
    $statement = null;
        header('Location:'.RUTA.'/admin');
    }
    require '../views/nuevo.view.php';
    $conn = null;