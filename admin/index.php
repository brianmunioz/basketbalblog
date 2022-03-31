<?php session_start();

    require 'config.php';
    require '../functions.php';
    comprobarSesion();
//index admin
    $conn = conexion($bd_config);
    if(!$conn){
     header('Location: ../error.php');
    }
    $posts = obtener_post($blog_config['post_por_pagina'],$conn);
    require '../views/admin_index.view.php';
    $conn=null;
