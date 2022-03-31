<?php require 'views/header.php' ?>
    <div class="contenedor">        
        <?php foreach($posts as $post): ?>
            <div class="post">
                <article>
                    <?php if(isset($_SESSION['admin'])):?>
                        <a href="<?php echo RUTA?>/admin/editar.php?id=<?php echo $post['id']?>">Editar</a>
                        <a href="<?php echo RUTA?>/admin/borrar.php?id=<?php echo $post['id']?>">Borrar</a>
                    <?php endif;?>
                    <h2 class="titulo"><a href="single.php?id=<?php echo $post['id'];?>"><?php echo $post['titulo']; ?></a></h2>
                    <p class="fecha"><?php echo fecha($post['fecha']); ?></p>
                    <div class="thumb">
                        <a href="single.php?id=<?php echo $post['id'];?>">
                        <img src="<?php echo RUTA.$blog_config['carpeta_imagenes'].$post['thumb'] ?>" alt="<?php echo $post['titulo']; ?> ">
                    </a>
                    </div>
                    <div class="extracto"><?php echo $post['extracto']; ?></div>
                    <a href="single.php?id=<?php echo $post['id'];?>" class="continuar">Continuar leyendo</a>
                </article>
            </div>    
        <?php endforeach; ?>       
        <?php require 'paginacion.php' ?>
    </div>    
<?php require 'views/footer.php' ?>
