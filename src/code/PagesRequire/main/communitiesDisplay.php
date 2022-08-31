<?php
$count = count($coms);
if ($count > 0) :
    for ($i = 0; $i < $count; $i++) : ?>
        <a href="<?= REQ_URI.'/communities/'.$coms[$i]['unique_name'];?>">
            <div class='bordaComunidade'>
                <div class='fotoComunidade'>
                    <img src="<?= UPLOAD.$coms[$i]['community_picture'];?>">
                </div>
                <div class='conteudoComunidade'>
                    <h3><?= $coms[$i]['name'];?></h3>
                    <p><?= $coms[$i]['description'];?></p>
                </div>
                <div class='statusComunidade'>
                <p>Topicos: <?= $coms[$i]['topics'];?></p>
                <p>Posts: <?= $coms[$i]['posts'];?></p>
                <p>Inscritos: <?= $coms[$i]['subscribers'];?></p>
                </div>
            </div>
        </a><?php
        if (session(LOG_U)) : 
            if (checkIfUserModeratesCommunity(session(LOG_U), $coms[$i]['id'])) : ?>
                <input type='hidden' class='comunidadeId' value="<?= $coms[$i]['unique_name'];?>">
                <button id='botaoExcluirComunidade<?= $coms[$i]['unique_name'];?>' class='btn btnVermelho botaoExcluirComunidade'><span style='color: #fff;'>excluir comunidade</span></button>
                <div class='fundoOpacoPadrao'></div>
                <div id='messConfirmDelComunidade<?= $coms[$i]['unique_name'];?>' class='messConfirmDelComunidade'>
                    <img src='<?= IMG;?>close.png' id="fecharMessConfirmDelComunidade<?= $coms[$i]['unique_name'];?>" class='fecharMessConfirmDelComunidade botaoFecharPadrao'>
                    <small><br> Tem certeza que desaja excluir a comunidade <?= '"'.strtoupper($coms[$i]['name']);?>"<br>
                    Se sim digite 'sim, deletar a comunidade <?= $coms[$i]['name'];?>' em letra maiuscula e o valor gerado acima no campo abaixo:<br>
                    Ex.: se a comunidade se chamar Rosa voce devera digitar:<br>
                    'SIM, DELETAR A COMUNIDADE ROSA'</small><br>
                    <form id='excluirComunidade<?= $coms[$i]['unique_name'];?>' method='post'>
                        <input type='text' name='confirmacaoDeletarComunidade' placeholder='Digitar confirmacao aqui' required><br>
                        <input type='hidden' name='comunidade' value="<?= $coms[$i]['unique_name'];?>">
                        <input type='submit' id='botaoConfirmacaoDeleterComunidade<?= $coms[$i]['unique_name'];?>' class='btn btnAzul' value='confirmar'>
                    </form>
                </div><?php
            endif;
        endif;
    endfor; 
endif;   