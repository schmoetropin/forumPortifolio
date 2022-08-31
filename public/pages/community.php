<div class="comunidadeTopo">
	<input type="hidden" id="comunidadeNomeUnico" value="<?= $com['unique_name'];?>">
	<img src="<?= IMG;?>imagemFundo_<?= rand(1, 7);?>.jpg" class="imagemFundo">
	<div class="inscreverCriarTopicoResBaixa"><?php 
		$comId = $com['id'];
		if (session(LOG_U)) :  
			$comUniqueN = $com['unique_name']; ?>
			<div id="areaInscricao2" class="areaInscricao"><?php
				require_once(COMMUNITY_PATH.'subscribeLr.php');?>
			</div>
			<button id="botaoCriarTopicoSm" class="btn btnVermelho botaoCriarTopico">Criar Topico</button><?php
			if (checkIfUserModeratesCommunity(session(LOG_U), $com['id'])) : ?>
				<button class="btn btnLaranja trocarDescricaoComunidade" id="trocarDescricaoComunidade2">trocar descricao</button><?php 
			endif;
		endif; ?>
		<div id="criarTopicoMensagem"></div>
	</div>
	<div class="imagemComunidade" id="imagemComunidade">
		<img id="imagemComunidadeIMG" src="<?= UPLOAD.$com['community_picture'];?>" alt="fotoComunidade" />
	</div><?php
	if (session(LOG_U)) :
		if (checkIfUserModeratesCommunity(session(LOG_U), $com['id'])) : ?>
			<button class="btn btnLaranja" id="trocarFotoComunidade">trocar foto</button><?php 
		endif;
	endif; ?>
	<h2 id="nomeComunidade"><?= $com['name'];?></h2><?php
	if (session(LOG_U)) :
		if (checkIfUserModeratesCommunity(session(LOG_U), $com['id'])) : ?>
			<button class="btn btnLaranja" id="trocarNomeComunidade">trocar nome</button><?php 
		endif;
	endif; ?>
</div>
<div class="comunidadeIndice">
	<a href="<?= REQ_URI.'/';?>">Index</a> /
	<a href="<?= REQ_URI.'/communities/'.$com['unique_name'];?>"><?= $com['name'];?></a>
</div>
<div class="comunidadeColunaPrincipal">
    <small style="margin: 0 0 0 3%;">Topicos mais populares:</small>
    <div class="top4Topicos"><?php
        //$exbTop4->exibirto4Topicos($comId);
    ?></div>
    <small style="left: 3%; position: absolute;">Topicos:</small>
    <div class="areaTopicos"><?php
        require_once(COMMUNITY_PATH.'displayTopics.php');?>
    </div>
    <div class="comunidadeBarraDireita">
        <!-- DESCRICAO COMUNIDADE -->
        <div class="descricaoComunidade" id="comunidadeCriarTopInscrev">
            <div class="cabecalho"><h3>Sobre Comunidade</h3></div>
            <p id="descricaoComunidadeP"><?=
               $com['description'];?>
            </p><?php
            if (session(LOG_U)) : ?>
                <div id="areaInscricao" class="areaInscricao"><?php
					require_once(COMMUNITY_PATH.'subscribeHr.php');?>
                </div>
                <button id="botaoCriarTopicoDe" class="btn btnVermelho botaoCriarTopico">Criar Topico</button><?php
                if (checkIfUserModeratesCommunity(session(LOG_U), $com['id'])) : ?>
                    <button class="btn btnLaranja trocarDescricaoComunidade" id="trocarDescricaoComunidade">trocar descricao</button><?php 
                endif;
            endif; ?>
        </div>
        <!-- STATUS COMUNIDADE -->
        <div class="comunidadeStatus">
            <div class="cabecalho"><h3>Comunidade Info</h3></div>
            <p>Topicos: <?= $com['topics'];?></p>
            <p>Posts: <?= $com['posts'];?></p>
            <p>Criado : <?= $com['created_at'];?></p>
        </div>
        <div class="comunidadeModeradores">
            <div class="cabecalho"><h3>Moderadores</h3></div><?php 
            //echo $modObj->exibirModeradores($comId, NULL);?>
        </div>
    </div>
</div><?php
if (session(LOG_U)) : ?>
	<div class="fundoOpacoPadrao"></div>
	<div id="criarTopicoCaixa">
		<img src="<?= IMG;?>imagemLado_3.jpeg" class="LadoTopicoImagem">
		<img src="<?= IMG;?>topic-512.png" class="topicoIconeTopo">
		<h2>novo topico</h2>
		<img src="<?= IMG;?>close.png" id="fecharCriarTopicoCaixa" class="botaoFecharPadrao">
		<form id="postarTopicoForm" method="POST" enctype="multipart/form-data">
			<small style="margin-left: 3%;">Titulo do topico precisa estar entre 4 e 90 caracteres</small><br>
			<input type="text" name="tituloTopico" id="tituloTopico" placeholder="Titulo do topico" required><br>
			<div class="contadorTituloTopico"></div><br>
			<small style="margin-left: 3%;">Conteudo do topico precisa ser maior que 2 caracteres</small><br>
			<textarea name="conteudoTopico" id="conteudoTopico" placeholder="Conteudo do topico" rows="6" required></textarea>
			<div class="contadorConteudoTopico"></div>
			<div id="adicionarMidia">
				<div id="tipRadio">
					<input type="radio" name="topicoArquivoRadio" id="uploadArquivoForm" class="topicoArquivoRadio" value="upload">Upload imagem/video&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
				<div id="tipRadio">
					<input type="radio" name="topicoArquivoRadio" id="linkVideoForm" class="topicoArquivoRadio" value="linkVideo">Link youtube&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				</div>
				<div id="tipRadio">
					<input type="radio" name="topicoArquivoRadio" id="semMidiaForm" class="topicoArquivoRadio" checked="checked" value="nenhum" required>Sem midia<br>
				</div>
				<input type="hidden" id="tipoMidiaPrevisualizacao" value="nenhum">
				<input type="file" name="topicoUpload" id="topicoUpload" style="display: none;">
				<input type="text" name="topicoLink" id="topicoLink" placeholder="Link completo video do youtube" style="display: none;"><br>
			</div>
			<small style="margin-left: 3%;">Pre-visualisacao midia:</small>
			<div id="detalhesUpload">
				<div id="uploadProgressoTexto">20%: 200 bytes de 1000</div>
				<div id="barraUpload">
					<div id="uploadBarraDeProgresso"></div>
				</div>
			</div>
			<div class='previsualizacaoMidia'></div>
			<input type="hidden" name="topicoComunidade" value="<?= $com['unique_name'];?>">
			<input type="submit" class="btn btnAzul" name="postarTopico" id="postarTopico" value="Criar Topico">
		</form>
	</div>
	<div class="mensagemErroDiv" id="mensagemErroDivCriarTopico">
		<div id="mensagemPostarTopicoDiv" class="mensagemErro"></div>
		<button id="fecharCriarTopMes" class="btn btnVermelho">ok</button>
	</div>
	<div class="fundoOpacoMensagemErro" id="fundoOpacoMensagemErroCriarTopico"></div>
	<div class="fundoOpacoPadrao"></div><?php
	if (checkIfUserModeratesCommunity(session(LOG_U), $com['id'])) : ?>
		<div id="editarComunidadeCaixa">
			<img src="<?= IMG;?>edit.png" id="editarIcone">
			<h4>Moderador Editar Comunidade</h4>
			<img src="<?= IMG;?>close.png" id="fecharEditarComunidadeCaixa" class="botaoFecharPadrao">
			<div id="editarFotoCaixa">
				<form method="post" id="trocarFotoComForm" enctype="multipart/form-data">
					<input type="hidden" id="comunidade" name="comunidade" value="<?= $com['unique_name'];?>">
					<div class="fotoRec">
						<small>Foto recente:</small>
						<div class="editFotoComunRecente">
							<img src="<?= UPLOAD.$com['community_picture'];?>" alt="imagemEditComun" />
						</div>
					</div>
					<div class="fotoNov">
						<small>Foto nova:</small>
						<div class="editFotoComunNova"><img src="" id="editFotoComunNovaPrev"></div>
					</div>
					<input type="file" name="arquivoEditarFoto" id="arquivoEditarFoto" required><br>
					<input type="submit" id="trocarFotoComunidadeBotao" value="trocar foto" class="btn btnAzul">
				</form>
			</div>
			<div id="editarNomeCaixa">
				<form method="post" id="trocarNomeComForm">
					<input type="hidden" id="comunidade" name="comunidade" value="<?= $com['unique_name'];?>">
					<small>Nome da comunidade minimo 3 caracteres e maximo 25</small><br>
					<input type="text" name="inputEditarNome" id="inputEditarNome" value="<?= $com['name'];?>" required><br>
					<div class="editNomeComunidadeContador" style="margin-left: 40%;"></div>
					<input type="submit" id="trocarNomeComunidadeBotao" value="trocar nome" class="btn btnAzul">
				</form>
			</div>
			<div id="editarDescricaoCaixa">
				<form method="post" id="trocarDescricaoComForm">
					<input type="hidden" id="comunidade" name="comunidade" value="<?= $com['unique_name'];?>">
					<small>Descricao da comunidade minimo 3 caracteres e maximo 150</small><br>
					<textarea name="txtaEditarDescricao" id="txtaEditarDescricao" required><?=
						$com['description'];?>
					</textarea><br>
					<div class="editDescricaoComunidadeContador" style="margin-left: 40%;"></div>
					<input type="submit" id="trocarDescricaoComunidadeBotao" value="trocar descricao" class="btn btnAzul">
				</form>
			</div>
		</div>
		<div class="mensagemErroDiv" id="mensagemErroEditarComunidadeDiv">
			<div id="mensagemEditarComunidadeDiv" class="mensagemErro"></div>
			<button id="fecharEditarComunidadeMes" class="btn btnVermelho">ok</button>
		</div>
		<div class="fundoOpacoMensagemErro" id="fundoOpacoMensagemEditarComunidadeErro"></div><?php
	endif;
endif; ?>
<div>
	<script src="<?= JS;?>CommunityEdit.js"></script>
	<script src="<?= JS;?>Subscription.js"></script>
	<script src="<?= JS;?>TopicCreateDelete.js"></script>
</div>