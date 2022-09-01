<div class="topicoIndice">
	<a href="<?= REQ_URI.'/';?>">Index</a> / 
	<a href="<?= REQ_URI.'/communities/'.getCommunityUniqueName($top['in_community']);?>">
        <?= getCommunityName($top['in_community']);?>
    </a> / 
	<a href="<?= REQ_URI.'/topics/'.$top['unique_name'];?>"><?= $top['name'];?></a> 
</div>
<div class="paginaTopico">
	<!-- TOPICO PRINCIPAL -->
		<div class="paginaTopicoPrincipal"><?php
            if (session(LOG_U)) : ?>
                <button class='btn btnLaranja' id='editarTopico'>editarTopico</button><?php
            endif;?>
            <div id="exibirTopicoPricipal"><?php
			    require_once(TOPIC_PATH.'mainTopic.php'); ?>
            </div>
		</div><?php 
		if(session(LOG_U)) : ?>
	<!-- FORMULARIO POST -->	
			<form id="postForm" method="post">
				<small>Post deve conter pelo menos 2 caracteres</small>
				<textarea name="postConteudo" id="postConteudo" placeholder="Poste um comentario aqui..." required></textarea>
				<input type="hidden" name="nomeTopico" id="nomeTopico" value="<?= $top['unique_name'];?>">
				<input type="submit" name="postarComentario" id="postarComentario" class="btn btnVerde" value="Post">
			</form>
			<div class="contadorConteudoPost" style="margin-left: 40%;"></div><?php 
		endif; ?>
		<input type="hidden" id="noTopico" value="<?= $top['unique_name'];?>">
	<!-- POSTS -->
		<div class="postArea"><?php
			require_once(TOPIC_PATH.'displayPosts.php');?>
		</div>
	</div>
	<div class="mensagemErroDiv" id="mensagemErroPostDiv">
		<div id="mensagemPostDiv" class="mensagemErro"></div>
		<button id="fecharPostMes" class="btn btnVermelho">ok</button>
	</div>
	<div class="fundoOpacoMensagemErro" id="fundoOpacoMensagemPost"></div>
	<!-- TOPICO BARRA DIREITA -->
    <div class="topicoBarraDireita">
        <div class="topicoComunidadeDetalhes">
            <a href="<?= REQ_URI.'/communities/'.getCommunityUniqueName($top['in_community']);?>">
                <h3><?= getCommunityName($top['in_community']);?></h3>
            </a>
            <a href="<?= REQ_URI.'/communities/'.getCommunityUniqueName($top['in_community']);?>">
            <div id="topicoComunidadeFoto">
                <img src="<?= UPLOAD.getCommunityPicture($top['in_community']);?>">
            </div>
            </a>
            <p><?= getCommunityDescription($top['in_community']);?></p>
        </div>
        <div class="topicoComunidadeModeradores">
            <div class="cabecalho"><h3>Moderadores</h3></div><?php 
            // echo $modObj->exibirModeradores(NULL, $_GET['t']);?>
        </div>
    </div><?php
    if(session(LOG_U)) : ?>
        <div class="fundoOpacoPadrao"></div>
        <div class="editarTopico">
            <img src="<?= IMG;?>close.png" id="fecharEditarTopico" class="botaoFecharPadrao">
            <img src="<?= IMG;?>edit.png" id="editarTopicoLogo"><h4>Editar topico</h4>
            <div class="editarTopicoEncapForm">
                <form method="post" id="editarTituloTopico">
                    <input type="hidden" id="topPagId" name="topPagId" value="<?= $top['unique_name'];?>">
                    <small>Titulo do topico precisa estar entre 4 e 90 caracteres</small>
                    <input type="text" name="editarTitulo" id="editarTitulo" placeholder="Editar titulo" value="<?= $top['name'];?>">
                    <div class="contadorEditarTopicoTitulo"></div>
                    <input type="submit" id="editarTituloTopicoBotao" class="btn btnVermelho btnEditarTopico" value="editar titulo">
                </form><hr class="barraDivEditTop">
                <form method="post" id="editarMidiaTopico" enctype="multipart/form-data">
                    <input type="hidden" id="topPagId" name="topPagId" value="<?= $top['unique_name'];?>">
                    <small>Imagem/video</small><br>
                    <div class="midiaOriginal">
                        <small>Midia original</small>
                        <div class="visualizacaoMidiaOrig"><?php
                            //echo $topTUC->tipoConteudo($topTipoArquivo, $topArquivo, 'edit', $topId, 'conteudo');?>
                        </div>
                    </div>
                    <div class="midiaNova">
                        <small>Midia nova</small>
                        <div class='previsualizacaoMidia'></div>
                    </div>
                    <div id="adicionarMidia">
                        <div id="tipRadio">
                            <input type="radio" name="topArqRadio" id="topicoArquivoRadio" class="uploadArquivoForm" value="upload">Upload imagem/video&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                        <div id="tipRadio">
                            <input type="radio" name="topArqRadio" id="topicoArquivoRadio" class="linkVideoForm" value="linkVideo">Link youtube&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </div>
                        <div id="tipRadio">
                            <input type="radio" name="topArqRadio" id="topicoArquivoRadio" class="semMidiaForm"  value="nenhum" required>Sem midia
                        </div>
                        <div id="tipRadio">
                            <input type="radio" name="topArqRadio" id="topicoArquivoRadio" class="manterMidiaForm" checked="checked" value="manter" required>Manter midia<br>
                        </div>
                        <input type="hidden" id="tipoMidiaPrevisualizacao" value="nenhum">
                        <input type="file" name="editarArquivo" id="topicoUpload" style="display: none;">
                        <input type="text" name="topicoLink" id="topicoLink" placeholder="" style="display: none;"><br>
                    </div>
                    <input type="submit" id="editarMidiaTopicoBotao" class="btn btnVermelho btnEditarTopico" value="editar midia">
                </form><hr class="barraDivEditTop">
                <form method="post" id="editarConteudoTopico">
                    <input type="hidden" id="topPagId" name="topPagId" value="<?= $top['unique_name'];?>">
                    <small>Conteudo do topico precisa ser maior que 2 caracteres</small>
                    <textarea name="editarConteudo" id="editarConteudo" placeholder="Editar conteudo"><?=
                        $top['content'];?>
                    </textarea>
                    <div class="contadorEditarTopicoConteudo"></div>
                    <input type="submit" id="editarConteudoTopicoBotao" class="btn btnVermelho btnEditarTopico" value="editar conteudo">
                </form>
            </div>
        </div>
        <div class="mensagemErroDiv" id="mensagemErroDivEditarTopico">
            <div id="editarTopicoMensagem" class="mensagemErro"></div>
            <button id="fecharEditarTopicoMes" class="btn btnVermelho">ok</button>
        </div>
        <div class="fundoOpacoMensagemErro" id="fundoOpacoMensagemErroEditarTopico"></div><?php
    endif; ?>
</div>
<div>
    <script src="<?= JS;?>TopicEdit.js"></script>
    <script src="<?= JS;?>Post.js"></script>
    <script src="<?= JS;?>Like.js"></script>
</div>