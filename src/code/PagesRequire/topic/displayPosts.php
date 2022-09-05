<?php
$count = count($pos);
if ($count > 0) :
    for ($i = 0; $i < $count; $i++) : ?>
        <div class='post'>
            <input type='hidden' class='postId' value='<?= $pos[$i]['id'];?>'>
            <a href='<?= REQ_URI.'/users/'.getUserUniqueName($pos[$i]['created_by']);?>'>
                <div class='postUsuario'>
                    <p><?= getUserName($pos[$i]['created_by']);?></p>
                    <div><img src='<?= getUserProfilePic($pos[$i]['created_by']);?>'></div>
                </div>
            </a>
            <p class='dataPost'><?= $pos[$i]['created_at'];?></p>
            <div class='conteudoPost'><?= $pos[$i]['content'];?></div>
            <div class='postRodape'>
                <div class='LikeArea' id='postLikeArea<?= $pos[$i]['id'];?>'><?php
                    if (session(LOG_U)): ?>
                        <form id='likePostForm<?= $pos[$i]['id'];?>' method='post' style='float: left;'>
                            <input type='hidden' id='likePost' name='likePost' value='<?= $pos[$i]['id'];?>'><?php
                        if (checkIfPostIsLiked(session(LOG_U), $pos[$i]['id'])) : ?>
                            <button type='submit' id='likePostButton<?= $pos[$i]['id'];?>' class='btnInvisivel likeAreaBotao' name='likeAreaBotao'><img src='<?= IMG;?>gray-like.png'></button><?php
                        else : ?>
                            <button type='submit' id='likePostButton<?= $pos[$i]['id'];?>' class='btnInvisivel likeAreaBotao' name='unlikeAreaBotao'><img src='<?= IMG;?>blue-like.png'></button><?php
                        endif; ?>
                        </form> likes: <?php
                    else : ?>
                        <button id='likeAreaBotao' class='btnInvisivel likeAreaBotao'>
                            <img src='<?= IMG;?>gray-like.png'>
                        </button> likes: <?php
                    endif ; ?> <span id="numLikesPost<?= $pos[$i]['id'];?>"><?= $pos[$i]['likes'];?></span>
                </div><?php
                if (session(LOG_U)) : 
                    if (
                        checkIfUserModeratesCommunity(session(LOG_U), $pos[$i]['in_community']) || 
                        $pos[$i]['created_by'] === session(LOG_U)
                    ) : ?>
                        <div class='delEditPost'>
                            <input type='submit' id='editPostBotao<?= $pos[$i]['id'];?>' value='editar post' class='btn btnLaranja editPostBotao'>
                            <input type='submit' id='delPostBotao<?= $pos[$i]['id'];?>' value='deletar post' class='btn btnVermelho'>
                        </div>
                        <div class='delPost' id='delPost<?= $pos[$i]['id'];?>'>
                            <img src='<?= IMG;?>close.png' class='botaoFecharPadrao' id='fecharDelPost<?= $pos[$i]['id'];?>' class="botaoFecharPadrao">
                            <small>Tem certeza que deseja deletar o post?</small>
                            <form id='deletarPostForm<?= $pos[$i]['id'];?>' method='post'>
                                <input type='hidden' name='delPostId' value='<?= $pos[$i]['id'];?>'>
                                <input type='submit' name='delPostBotao' id='delPostFormBotao<?= $pos[$i]['id'];?>' value='sim' class='btn btnVermelho'>
                            </form>
                        </div>
                        <div class='editPost' id='editPost<?= $pos[$i]['id'];?>'>
                            <img src='<?= IMG;?>close.png' class='botaoFecharPadrao' id='fecharEditPost<?= $pos[$i]['id'];?>' class="botaoFecharPadrao">
                            <small>Editar post</small>
                            <form id='editarPostForm<?= $pos[$i]['id'];?>' method='post'>
                                <input type='hidden' name='editPostId' value='<?= $pos[$i]['id'];?>'>
                                <small>Post deve conter pelo menos 2 caracteres</small>
                                <textarea id='editarPostTextarea<?= $pos[$i]['id'];?>' name='editarPostTextarea'><?= $pos[$i]['content'];?></textarea>
                                <div class='editarPostContador<?= $pos[$i]['id'];?>'></div>
                                <input type='submit' name='editPostBotao' id='editPostFormBotao<?= $pos[$i]['id'];?>' value='editar post' class='btn btnVermelho'>
                            </form>
                        </div><?php
                    endif;
                endif; ?>
            </div>
        </div><?php
    endfor;
endif;