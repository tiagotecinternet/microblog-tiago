<?php
use Microblog\Noticia;
require_once "vendor/autoload.php";
$noticia = new Noticia;
$noticia->setTermo($_POST['busca']);
$resultados = $noticia->busca();
$quantidade = count($resultados);

    if($quantidade > 0){
?>
	<h2 class="fs-5">Resultados: <span class="badge bg-primary"><?=$quantidade?></span></h2>
    <div class="list-group">    
        <?php foreach($resultados as $arrNoticia) { ?>
            <a href="noticia.php?id=<?=$arrNoticia['id']?>" class="list-group-item list-group-item-action">
                <?=$arrNoticia['titulo']?>
            </a>
        <?php } ?>
    </div>
<?php } else {
?>
    <h2 class="fs-5 text-danger">Sem notícias</h2>
<?php }	?>