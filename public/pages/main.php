<?php 
if (session(LOG_U)) : ?>
	<div class="areaCriacaoComunidade">
		<button id="botaoCriarComunidade" class="btn btnVermelho">Criar Comunidade</button>
		<div class="fundoOpacoPadrao"></div>
		<div id="caixaCriarCominidade">
			<div id="imagemLateralCriarComunidade">
				<img src="<?= IMG;?>imagemLado_2.jpg">
			</div>
			<img src="<?= IMG;?>section-512.png" class="comunidadeIconeTopo">
			<h3>Criar Comunidade</h3>
			<img src="<?= IMG;?>close.png" id="fecharCaixaCriarCominidade"  class="botaoFecharPadrao">
			<form method="post" id="criarComunidadeForm" enctype="multipart/form-data">
				<small style="margin-left: -13%;">Imagem da comunidade:</small><br>
				<div class="previsualisacaoImgCom">
					<img id="pevImagCom" src="">
				</div>
				<input type="file" name="fotoComunidade" id="fotoCriacaoComunidade" required><br>
				<small>Nome da comunidade minimo 3 caracteres e maximo 25</small>
				<input type="text" name="nomeComunidade" id="nomeComunidade" placeholder="Nome da comunidade" required><br><br>
				<div class="contadorNomeComunidade"></div><br>
				<small>Descricao da comunidade minimo 3 caracteres e maximo 150</small>
				<textarea name="descricaoComunidade" id="descricaoComunidade" rows="8" cols="58" placeholder="Descricao da comunidade"></textarea><br>
				<div class="contadorDescricaoComunidade"></div>
				<input type="submit" name="inputCriarComunidade" id="inputCriarComunidade" class="btn btnAzul" value="Criar"><br>
			</form>
		</div>
	</div>
	<div class="mensagemErroDiv" id="mensagemErroComunidadeDiv">
		<div id="mensagemCriarComunidadeDiv" class="mensagemErro"></div>
		<button id="fecharCriarComunidadeMes" class="btn btnVermelho">ok</button>
	</div>
	<div class="fundoOpacoMensagemErro" id="fundoOpacoMensagemComunidadeErro"></div><?php
endif; ?>
<!-- TOP 4 TOPICOS MAIS POPULARES DO FORUM -->
<small style="margin: 0 0 0 3%;">Topicos mais populares:</small>
<div class="top4TopicosIndex"><?php
	//$exbTop->exibirto4Topicos(); ?>
</div>
<!-- COMUNIDADES -->
<small style="margin: 0 0 0 3%;">Comunidades:</small>
<div class="indexColunaPrincipal" id="indexColunaPrincipal"><?php
	require_once(MAIN_PATH.'communitiesDisplay.php');?>
</div>
<div>
	<script src="<?= JS;?>CommunityCreateDelete.js"></script>
</div>