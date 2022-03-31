<?php  session_start();

    require 'admin/config.php';
    require 'functions.php';
    $conn = conexion($bd_config);
    if(!$conn){
        header('Location: error.php');
    }

    if($_SERVER['REQUEST_METHOD'] == 'GET' && !empty($_GET['busqueda'])){
        $busqueda = limpiarDatos($_GET['busqueda']);
        $statement = $conn->prepare(
        'SELECT * FROM articulos WHERE titulo LIKE :busqueda or texto LIKE :busqueda  or extracto LIKE :busqueda'
        );
        $statement->execute(array(
        ':busqueda'=> "%$busqueda%"
        ));
    $resultados = $statement->fetchAll();
    if(empty($resultados)){
        $titulo = 'No se encontraron articulos en la busqueda: '.$busqueda;
    }else{
        $titulo = "Resultados de la busqueda: " . $busqueda;
    }
    $statement = null;
    }else{
        header('Location: '. RUTA . '/index.php');
    }
    require 'views/buscar.view.php';
    $conn = null;
