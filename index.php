<?php session_start();
    require 'admin/config.php';
    require 'functions.php';

    $conn = conexion($bd_config);
    if(!$conn){
        header('Location: error.php');
    }
    $posts = obtener_post($blog_config['post_por_pagina'],$conn);
    if(!$posts){
        header('Location: error.php');
    }

    require 'views/index.view.php';
    $conn = null;
?>