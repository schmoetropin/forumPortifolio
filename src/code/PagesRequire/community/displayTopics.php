<?php
$count = count($tops);
if ($count > 0) :
    for ($i = 0; $i < $count; $i++) : ?>
        <div class='topicoInteiro'>
            <a href='<?= REQ_URI.'/users/'.getUserUniqueName($tops[$i]['created_by']);?>'><div class='linkUsuario'></div></a>
            <a href='<?= REQ_URI.'/topics/'.$tops[$i]['unique_name'];?>'>
                <input type='hidden' class='topicoId' value='<?= $tops[$i]['unique_name'];?>'>
                <div class='topico' id='topico<?= $tops[$i]['unique_name'];?>'>
                    <h4><?= $tops[$i]['name'];?></h4>
                    <div class='topicoUsuario'>
                        Postado por: <?= getUserName($tops[$i]['created_by']);?>
                        <div>
                            <img src='<?= getUserProfilePic($tops[$i]['created_by']);?>'>
                        </div>
                    </div>
                    <div class='topicoConteudo'>
                        <div class='conteudoTopico'><?php 
                            if (!is_null($tops[$i]['file'])) :
                                if ($tops[$i]['file_extension'] === 'mp4') : ?>
                                    <video id='topicoVideo<?= $tops[$i]['unique_name'];?>' muted>
                                        <source src='<?= UPLOAD.$tops[$i]['file'];?>'>
                                    </video><?php
                                else: ?>
                                    <img src='<?= UPLOAD.$tops[$i]['file'];?>' class='preVisMidEditTop'><br><?php
                                endif;
                            elseif (!is_null($tops[$i]['link'])) : ?>
                                <iframe width='700' height='400' src='https://www.youtube.com/embed/<?= $tops[$i]['link'];?>' frameborder='0' allowfullscreen></iframe><br><?php
                            else :
                                echo '';
                            endif;
                            echo nl2br($tops[$i]['content']); ?>
                        </div>
                    </div>
                    <ul>
                        <li>Posts: <?= $tops[$i]['posts'];?></li>
                        <li>Likes: <?= $tops[$i]['likes'];?></li>
                        <li><?= $tops[$i]['created_at'];?></li>
                    </ul>
                </div>
            </a><?php
            if (session(LOG_U)) :
                if(checkIfUserModeratesCommunity(session(LOG_U), $comId) || session(LOG_U) === $tops[$i]['created_by']) : ?>
                    <p id='deletarTopicoComunidade'></p>
                    <div style='position: absolute; z-index: 80; margin: -65px 0 0 3px;'>
                        <input type='submit' class='btn btnVermelho' id='deletarTopico<?= $tops[$i]['unique_name'];?>' value='excluir topico'>
                    </div>
                    <div class='fundoOpacoPadrao'></div>
                    <div id='delTopicoCaixa<?= $tops[$i]['unique_name'];?>' class='delTopicoCaixa'>
                        <img src='<?= IMG;?>close.png' id='fecharDelTopicoCaixa<?= $tops[$i]['unique_name'];?>' class='fecharDelTopicoCaixa botaoFecharPadrao'>
                        <small>Tem certeza que deseja excluir o topico <?= '"'.strtoupper($tops[$i]['name']);?>..."<br>
                        Se sim digite seu email:<br></small>
                        <form id='deletarTopicoForm<?= $tops[$i]['unique_name'];?>' method='post'>
                            <input type='hidden' name='topico' value='<?= $tops[$i]['unique_name'];?>'>
                            <input type='text' name='delTopTextConfirmacao' placeholder='Digite a sentenca aqui' required>
                            <input type='submit' id='botaoDeletarTopico<?= $tops[$i]['unique_name'];?>' class='btn btnAzul' value='confirmar'>
                        </form>
                    </div><?php
                endif; 
            endif; ?>
        </div><?php
    endfor;
endif;