<?php

use Microblog\Utilitarios;

require_once "inc/cabecalho.php";
$noticia->setTermo($_GET['busca']);
$resultados = $noticia->busca();
// Utilitarios::dump($resultados);
?>


<div class="row bg-white rounded shadow my-1 py-4">
    <h2 class="col-12 fw-light">
        Você procurou por 
        <span class="badge bg-dark"> 
            <?=$noticia->getTermo() // ou $_GET['busca']?> 
        </span>
         e obteve <span class="badge bg-primary">
            <?=count($resultados)?>
         </span> resultados
    </h2>
    
    <div class="col-12 my-1">
    <?php foreach($resultados as $resultado){ ?>
        <article class="card">
            <div class="card-body">
                <h3 class="fs-4 card-title fw-light">
                    <?=$resultado['titulo']?></h3>
                <p class="card-text">
                    <time datetime="<?=$resultado['data']?>">
                <?=Utilitarios::formataData($resultado['data'])?>
                    </time> - 
                    <?=$resultado['resumo']?>
                </p>                
                <a href="noticia.php?id=<?=$resultado['id']?>" 
                class="btn btn-primary btn-sm">Continuar lendo</a>
            </div>
        </article>
    <?php } ?>
    </div>


</div>     

<?php include_once "inc/todas.php"; ?>           
      
    



<?php 
require_once "inc/rodape.php";
?>

