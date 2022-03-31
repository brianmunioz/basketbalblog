<?php session_start();
    require 'config.php';
    require '../functions.php';
    comprobarSesion();
//index admin
    $conn = conexion($bd_config);

    if(!$conn){
        header('Location: ../error.php');
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST' ){
        $titulo = limpiarDatos($_POST['titulo']);
        $extracto = limpiarDatos($_POST['extracto']);
        $texto = limpiarDatos($_POST['texto']);
        $id = $_POST['id'];    
        $thumb_guardada = $_POST['thumb-guardada'];
        $thumb = $_FILES['thumb'];
    if(empty($thumb['name'])){
        $thumb=$thumb_guardada;
    }else{
        $destino = '..'.$blog_config['carpeta_imagenes'].$_FILES['thumb']['name'];
        move_uploaded_file($_FILES['thumb']['tmp_name'],$destino);
        $thumb = $_FILES['thumb']['name'];
    }
    $statement = $conn->prepare(
        'UPDATE articulos SET titulo = :titulo, extracto = :extracto, texto = :texto, 
        thumb = :thumb WHERE id = :id'
    );
    $statement->execute(array(
        ':titulo'=> $titulo,
        ':extracto'=> $extracto,
        ':texto'=> $texto,
        ':thumb'=> $thumb,
        ':id'=> $id
    ));
    $statement = null;
    header('Location: '.RUTA.'/admin');
    }else{
        $id_articulo = id_articulo($_GET['id']);
    
    if(empty($id_articulo)){
        header('Location: '.RUTA.'/admin');
    }

    $post = obtener_post_por_id($conn,$id_articulo);
    if(!$post){
        header('Location: '.RUTA.'/admin');
    }
    $post= $post[0];
    }
    require '../views/editar.view.php';
    $conn=null;
