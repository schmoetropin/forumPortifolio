<?php
$count = count($top4);
if ($count > 0) :
    for ($i = 0; $i < $count; $i++) : ?>
        <input type='hidden' class='top4TopId' value='<?= $top4[$i]['unique_name'];?>'>
        <div class='top4TopCompleto' id='top4TopCompleto<?= $top4[$i]['unique_name'];?>'>
            <a href='<?= REQ_URI.'/topics/'.$top4[$i]['unique_name'];?>'>
                <div class='top4top'>
                    <div class='titulo'>
                        <h5><?= $top4[$i]['name'];?></h5>
                    </div>
                    <div class='conteudo'><?php 
                        if (!is_null($top4[$i]['file'])) :
                            if ($top4[$i]['file_extension'] === 'mp4') : ?>
                                <video id='topicoVideo<?= $top4[$i]['unique_name'];?>' muted>
                                    <source src='<?= UPLOAD.$top4[$i]['file'];?>'>
                                </video><?php
                            else : ?>
                                <img src='<?= UPLOAD.$top4[$i]['file'];?>' class='preVisMidEditTop'><br><?php
                            endif;
                        elseif (!is_null($top4[$i]['link'])) : ?>
                            <iframe width='700' height='400' src='https://www.youtube.com/embed/<?= $top4[$i]['link'];?>' frameborder='0' allowfullscreen></iframe><br><?php
                        else : ?>
                            <p><?= nl2br($top4[$i]['content']);?></p><?php
                        endif; ?>
                    </div>
                </div>
            </a>
            <div class='top4topicoRodape'>
                <a href='<?= REQ_URI.'/users/'.getUserUniqueName($top4[$i]['created_by']);?>'>
                    <?= getUserName($top4[$i]['created_by']);?>
                </a>
                <div class='likes'>
                    <small><?= $top4[$i]['likes'];?></small>
                    <img src='<?= IMG;?>arrow-178-32.png'>
                </div>
            </div>
        </div><?php
    endfor;
endif;