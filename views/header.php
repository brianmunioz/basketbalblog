<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo RUTA; ?>/css/estilos.css">    
    <title>Basketball Blog</title>
</head>
<body>
    <header>
        <div class="contenedor">
            <div class="header">
                <a href="<?php echo RUTA; ?>"><img src="<?php echo RUTA; ?>/imagenes/header.png" alt="Basketball blog"></a>
                <form name="busqueda" class="buscar" action="<?php echo RUTA; ?>/buscar.php" method="get">
                    <input type="text" name="busqueda" placeholder="Buscar">
                    <button type="submit" class="icono fa fa-search"></button>
                    </form>
                <div class="menu">
                    <?php if(isset($_SESSION['admin'])): ?>
                        <a href="<?php echo RUTA; ?>/admin">admin</a>
                        <a href="<?php echo RUTA; ?>/admin/cerrar.php" >Cerrar sesión</a>
                    <?php else: ?>
                        <a href="login.php">Login</a>
                        <a href="registro.php">registrarse</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>

