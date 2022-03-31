<?php require '<views/header.php' ?>
    <div class="contenedor">       
        <div class="post">
            <article>
            <h2>Registro</h2>
            <?php if($errores):?>
                <h2 class="error" value="<?php echo $errores?>"><?php echo $errores?></h2>
                <?php endif; ?>
            </article>
            <form class="formulario" method="post"action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                <input type="text" name="usuario" placeholder="Usuario" value="<?php  echo ($errores)?$usuario : ''; ?>">
                <input type="password" name="password" placeholder="Contraseña" >
                <input type="password" name="password2" placeholder="Confirme contraseña" >
                <input type="text" name="nombre" placeholder="Nombre" value="<?php  echo ($errores)?$nombre : ''; ?>">
                <input type="text" name="apellido" placeholder="Apellido" value="<?php  echo ($errores)?$apellido : ''; ?>">
                <input type="email" name="email" placeholder="Email" value="<?php  echo ($errores)?$email : ''; ?>">
                <input type="email" name="email2" placeholder="Confirme email" >
                <input type="submit" value="Iniciar Sesion">
            </form>
      
        </div>       
    </div>   
<?php require 'views/footer.php' ?>