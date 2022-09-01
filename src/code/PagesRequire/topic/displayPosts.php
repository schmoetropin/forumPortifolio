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
                        <form id='likeTopic' method='post' style='float: left;'>
                            <input type='hidden' id='likeTopico' name='likeTopico' value=''><?php
                        if (true) : ?>
                            <input type='hidden' id='opcaoLikeUnlike' name='opcaoLikeUnlike' value='unlike'>
                            <button type='submit' id='like' class='btnInvisivel likeAreaBotao' name='unlikeAreaBotao'><img src='<?= IMG;?>blue-like.png'></button><?php
                        else : ?>
                            <input type='hidden' id='opcaoLikeUnlike' name='opcaoLikeUnlike' value='like'>
                            <button type='submit' id='like' class='btnInvisivel likeAreaBotao' name='likeAreaBotao'><img src='<?= IMG;?>gray-like.png'></button><?php
                        endif; ?>
                        </form> likes: <?php echo $pos[$i]['likes'];
                    else : ?>
                        <button id='likeAreaBotao' class='btnInvisivel likeAreaBotao'>
                            <img src='<?= IMG;?>gray-like.png'>
                        </button> likes: <?php echo $pos[$i]['likes'];
                    endif ; ?> 
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
                            <small>Valor: <?php// echo $uniq;?><br>
                            Tem certeza que deseja deletar o post, se sim digite o valor gerado acima abaixo</small>
                            <form id='deletarPostForm<?= $pos[$i]['id'];?>' method='post'>
                                <input type='hidden' name='delPostId' value='<?= $pos[$i]['id'];?>'>
                                <input type='hidden' name='delPostValor' value='<?php// echo $uniq;?>'>
                                <input type='text' name='delPostInput' placeholder='Digite o valor aqui' required>
                                <input type='submit' name='delPostBotao' id='delPostFormBotao<?= $pos[$i]['id'];?>' value='deletar post' class='btn btnVermelho'>
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