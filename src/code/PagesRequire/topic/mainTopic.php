<h2 class='tituloTopico'><?= $top['name'];?></h2>
<div class='topicoPaginaTopico'>
    <div class='topicoCabecalho'>
        <p>Criado: <?= $top['created_at'];?></p>
    </div>
    <div class='detalhesUsuario'>
        <a href='<?= REQ_URI.'/users/'.getUserUniqueName($top['created_by']);?>'>
            <p><?= getUserName($top['created_by']);?></p>
            <div><img src='<?= getUserProfilePic($top['created_by']);?>'></div>
        </a>
    </div>
    <div class='topicoConteudo'>
        <div class='conteudoTopico'><?php 
            if (!is_null($top['file'])) :
                if ($top['file_extension'] === 'mp4') : ?>
                    <video id='topicoVideo<?= $top['unique_name'];?>' muted>
                        <source src='<?= UPLOAD.$top['file'];?>'>
                    </video><?php
                else : ?>
                    <img src='<?= UPLOAD.$top['file'];?>' class='preVisMidEditTop'><br><?php
                endif;
            elseif (!is_null($top['link'])) : ?>
                <iframe width='700' height='400' src='https://www.youtube.com/embed/<?= $top['link'];?>' frameborder='0' allowfullscreen></iframe><br><?php
            else :
            endif; ?>
            <?= nl2br($top['content']); ?>
        </div>
    </div>
    <div class='topicoRodape'>
        <div class='LikeArea' id='topicoLikeArea'><?php
            if (session(LOG_U)): ?>
				<form id='likeTopic' method='post' style='float: left;'>
					<input type='hidden' id='likeTopico' name='likeTopico' value='<?= $top['unique_name'];?>'><?php
				if (checkIfTopicIsLiked(session(LOG_U), $top['id'])) : ?>
                    <input type='hidden' id='opcaoLikeUnlike' name='opcaoLikeUnlike' value='like'>
					<button type='submit' id='like' class='btnInvisivel likeAreaBotao' name='likeAreaBotao'><img src='<?= IMG;?>gray-like.png'></button><?php
				else : ?>
					<input type='hidden' id='opcaoLikeUnlike' name='opcaoLikeUnlike' value='unlike'>
					<button type='submit' id='like' class='btnInvisivel likeAreaBotao' name='unlikeAreaBotao'><img src='<?= IMG;?>blue-like.png'></button><?php
				endif; ?>
				</form><?php
			else : ?>
				<button id='likeAreaBotao' class='btnInvisivel likeAreaBotao'>
                    <img src='<?= IMG;?>gray-like.png'>
                </button><?php
            endif ; ?> likes:<span id="topicoNumeroLikes"> <?= $top['likes'];?></span>
        </div>
    </div>
</div>