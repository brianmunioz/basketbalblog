<?php $numero_paginas = numero_paginas($blog_config['post_por_pagina'],$conn); ?>
<section class="paginacion">
    <ul>
        <?php if(pagina_actual() ===1):?>
            <li class="disabled">&laquo;</li>
        <?php else: ?>
            <li > <a href="index.php?p=<?php echo pagina_actual() - 1 ?>">&laquo;</a></li>
        <?php endif;?>
        <?php for($i=1; $i<= $numero_paginas; $i++): ?>
            <?php if(pagina_actual() === $i): ?>
                <li><a href="index.php?p=<?php echo $i?>" class="active"><?php echo $i;?></a></li>
            <?php else: ?>
                <li><a href="index.php?p=<?php echo $i?>"><?php echo $i;?></a></li>
            <?php endif;?>
        <?php endfor;?>
        <?php $actual = pagina_actual();?>  
        <?php if($actual == $numero_paginas ):?>
            <li class="disabled">&raquo;</li>
        <?php else: ?>
            <li > <a href="index.php?p=<?php echo pagina_actual() + 1;?>">&raquo;</a></li>
        <?php endif; ?>
    </ul>
</section>