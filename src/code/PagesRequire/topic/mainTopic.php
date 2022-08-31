<h2 class='tituloTopico'><?= $top['name'];?></h2>
<div class='topicoPaginaTopico'>
    <div class='topicoCabecalho'>
        <p>Criado: <?= $top['created_at'];?></p>
    </div>
    <div class='detalhesUsuario'>
        <a href='<?= REQ_URI.'/users/'.getUserUniqueName($top['created_by']);?>'><?=
            getUserName($top['created_by']);?>
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
                else: ?>
                    <img src='<?= UPLOAD.$top['file'];?>' class='preVisMidEditTop'><br><?php
                endif;
            elseif (!is_null($top['link'])) : ?>
                <iframe width='700' height='400' src='https://www.youtube.com/embed/<?= $top['link'];?>' frameborder='0' allowfullscreen></iframe><br><?php
            else :
                echo '';
            endif;
            echo nl2br($top['content']); ?>
        </div>
    </div>
    <div class='topicoRodape'>
        <div class='LikeArea' id='topicoLikeArea'><?php
            if (session(LOG_U)): ?>
				<form id='likeTopic' method='post' style='float: left;'>
					<input type='hidden' id='likeTopico' name='likeTopico' value='<?= $top['unique_name'];?>'><?php
				if (true) : ?>
					<input type='hidden' id='opcaoLikeUnlike' name='opcaoLikeUnlike' value='unlike'>
					<button type='submit' id='like' class='btnInvisivel likeAreaBotao' name='unlikeAreaBotao'><img src='<?= IMG;?>blue-like.png'></button><?php
				else : ?>
					<input type='hidden' id='opcaoLikeUnlike' name='opcaoLikeUnlike' value='like'>
					<button type='submit' id='like' class='btnInvisivel likeAreaBotao' name='likeAreaBotao'><img src='<?= IMG;?>gray-like.png'></button><?php
				endif; ?>
				</form> likes: <?php echo $top['likes'];
			else : ?>
				<button id='likeAreaBotao' class='btnInvisivel likeAreaBotao'>
                    <img src='<?= IMG;?>gray-like.png'>
                </button> likes: <?php echo $top['likes'];
            endif ; ?> 
        </div>
    </div>
</div>