<?php
$count = count($coms);
if ($count > 0) : ?>
    <small style="margin: 0 0 0 5%;">Resultados para a pesquisa "<?= $search??null;?>":</small>
    <div class="indexColunaPrincipal"><?php
        require_once(MAIN_PATH.'communitiesDisplay.php'); ?>
    </div><?php
else : ?>
    <small style="margin: 0 0 0 5%;">Resultados para a pesquisa "<?= $search??null;?>":</small>
    <div class="indexColunaPrincipal">
        <small>Nenhuma comunidade foi encontrada</small>
    </div><?php
endif;