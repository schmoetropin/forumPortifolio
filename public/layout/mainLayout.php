<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="<?= CSS;?>caixasPosicaoFixaStyle.css">
        <link rel="stylesheet" type="text/css" href="<?= CSS;?>padraoReutilizavelStyle.css">
        <link rel="stylesheet" type="text/css" href="<?= CSS;?>headerStyle.css">
        <link rel="stylesheet" type="text/css" href="<?= CSS;?>indexComunidadesStyle.css">
        <link rel="stylesheet" type="text/css" href="<?= CSS;?>comunidadeTopicosStyle.css">
        <link rel="stylesheet" type="text/css" href="<?= CSS;?>topicoPostsStyle.css">
        <link rel="stylesheet" type="text/css" href="<?= CSS;?>perfilStyle.css">
        <link rel="stylesheet" type="text/css" href="<?= CSS;?>style.css">
        <link rel="stylesheet" type="text/css" href="<?= CSS;?>top4TopicosStyle.css">
        <link rel="stylesheet" type="text/css" href="<?= CSS_RES;?>max-width1333.css">
        <link rel="stylesheet" type="text/css" href="<?= CSS_RES;?>max-width1330.css">
        <link rel="stylesheet" type="text/css" href="<?= CSS_RES;?>max-width1300.css">
        <link rel="stylesheet" type="text/css" href="<?= CSS_RES;?>max-width1265.css">
        <link rel="stylesheet" type="text/css" href="<?= CSS_RES;?>max-width1160.css">
        <link rel="stylesheet" type="text/css" href="<?= CSS_RES;?>max-width1000.css">
        <link rel="stylesheet" type="text/css" href="<?= CSS_RES;?>max-width950.css">
        <link rel="stylesheet" type="text/css" href="<?= CSS_RES;?>max-width900.css">
        <link rel="stylesheet" type="text/css" href="<?= CSS_RES;?>max-width890.css">
        <link rel="stylesheet" type="text/css" href="<?= CSS_RES;?>max-width770.css">
        <link rel="stylesheet" type="text/css" href="<?= CSS_RES;?>max-width750.css">
        <link rel="stylesheet" type="text/css" href="<?= CSS_RES;?>max-width700.css">
        <link rel="stylesheet" type="text/css" href="<?= CSS_RES;?>max-width650.css">
        <link rel="stylesheet" type="text/css" href="<?= CSS_RES;?>max-width615.css">
        <link rel="stylesheet" type="text/css" href="<?= CSS_RES;?>max-width562.css">
        <link rel="stylesheet" type="text/css" href="<?= CSS_RES;?>max-width490.css">
        <link rel="stylesheet" type="text/css" href="<?= CSS_RES;?>max-width470.css">
        <link rel="stylesheet" type="text/css" href="<?= CSS_RES;?>max-width396.css">
        <!-- JS -->
        <script src="<?= JS;?>script.js"></script>
    </head>	
    <body>
        <header id="barraTopo">
            <input type="hidden" id="REQ_URI" value="<?= REQ_URI;?>"/>
            <!-- LOGO -->
            <a href="<?= REQ_URI;?>/"><img src="<?= IMG;?>logo.png" id="logo"></a>
            <!-- BARRA DE PESQUISA -->
            <div id="barraPesquisaTopo">
                <img src="<?= IMG;?>x-mark.png" id="limparBarraPesquisa">
                <form id="pesquisarComunidade" method="post" action="<?= REQ_URI.'/search';?>">
                    <input type="text" placeholder="Pesquisar comunidade..." id="barraDePerquisa" name="resultado" required>
                    <button type="submit"><img src="<?= IMG;?>search.png"></button>
                </form>
            </div>		
            <!-- ICONES HOME, LOGIN, PERFIL, REGISTRO E LOGOUT -->
            <!-- ICONES ALTA RESOLUCAO -->
            <ul id="altaResolucaoUlBarraTopo">
                <li><a href="<?= REQ_URI;?>/"><img src="<?= IMG;?>home.png"></a></li><?php		
                if(session(LOG_U)) : ?>
                    <li><a href="<?= REQ_URI.'/users/'.getUserUniqueName(session(LOG_U));?>"><img src="<?= IMG;?>user.png"></a></li>
                    <li><button id="botaoLogout1" class="btnInvisivel botaoLogout"><img src="<?= IMG;?>logout.png" id="botaoLogout"></button></li><?php 	
                else : ?>
                    <li><button id="botaoLogin" class="btnInvisivel botaoLogin"><img src="<?= IMG;?>login.png"></button></li>
                    <li><button id="botaoRegistro" class="btn btnVermelho botaoRegistro">registrar</button></li><?php 
                endif; ?>
            </ul>
            <button class="btnInvisivel" id="botaoMenuUlBarraTopo"><img src="<?= IMG;?>activity-feed-32.png"></button>
            <!-- ICONES BAIXA RESOLUCAO -->
            <ul id="baixaResolucaoUlBarraTopo">
                <img src="<?= IMG;?>close.png" id="fecharCaixaBaixRes" class="botaoFecharPadrao">
                <li><a href="<?= REQ_URI;?>/"><img src="<?= IMG;?>home.png"> Index</a></li><?php	
                if(session(LOG_U)) : ?>
                    <li><a href="<?= REQ_URI.'/users/'.getUserUniqueName(session(LOG_U));?>"><img src="<?= IMG;?>user.png"> Perfil</a></li>
                    <li><button id="botaoLogout2" class="btnInvisivel botaoLogout"><img src="<?= IMG;?>logout.png" id="botaoLogout"> Logout</button></li>
                    </ul>
                    <div id='logoutS'></div><?php 
                else : ?>
                    <li><button id="botaoLogin" class="btnInvisivel botaoLogin"><img src="<?= IMG;?>login.png"> Login</button></li>
                    <li><button id="botaoRegistro" class="btn btnVermelho botaoRegistro">registrar</button></li>
                    </ul><?php 
                endif; ?>
        </header><?php
        if(!session(LOG_U)) : ?>
            <!-- FORMULARIO REGISTRO E LOGIN -->
            <!-- LOGIN -->
            <div id="caixaLogin">
                <form method="post" id="loginForm">
                    <input type="email" id="logEmail" name="logEmail" placeholder="Email" required><br>
                    <input type="password" id="logSenha" name="logSenha" placeholder="Senha" required><br>
                    <input type="submit" value="Login" class="btn btnAzul" id="inputLoginForm">
                </form>
                <div id="mensagemLogin"></div>
            </div>
            <!-- REGISTRO -->
            <div class="fundoOpacoPadrao"></div>
            <div id="caixaRegistro">
                <img src="<?= IMG;?>imagemLado_1.jpg" id="imagemLadoRegistro">
                <div class="imagenIconeRegistro">
                    <img src="<?= IMG;?>register-head-icon.png">
                </div>
                <img src="<?= IMG;?>close.png" id="fecharCaixaRegistro" class="botaoFecharPadrao">
                <form method="post" id="registroForm">
                    <input type="text" id="regNome" name="regNome" placeholder="Nome" required><br>
                    <input type="email" id="regEmail" name="regEmail" placeholder="Email" required><br>
                    <input type="email" id="regEmail2" name="regEmail2" placeholder="Confirmar Email" required><br>
                    <input type="password" id="regSenha" name="regSenha" placeholder="Senha" required><br>
                    <input type="password" id="regSenha2" name="regSenha2" placeholder="Confirmar Senha" required><br>
                    <input type="submit" value="Registrar" class="btn btnVermelho" id="inputRegistroForm" name="inputRegistroForm">
                </form>
            </div>
            <div class="mensagemErroDiv" id="mensagemErroRegDiv">
                <div id="mensagemRegistro" class="mensagemErro"></div>
                <button id="fecharRegistroMes" class="btn btnVermelho">ok</button>
            </div>
            <div class="fundoOpacoMensagemErro" id="fundoOpacoMensagemRegErro"></div><?php
        endif; ?>
        <div class="siteTopoInferirorLimite">

            {{*CONTENT*}}

        </div>
		<div class="copiarEmailMens" id="copiarEmailMens">Copiar email</div>
		<div id="enviarEmailDiv" class="enviarEmailDiv">
			Email: <input type="text" id="emailDeContato" value="schmoemaster@gmail.com" disabled />
			<button id="copiarEmailDeContato" class="btn btnAzul">Copiar</button>
		</div>
		<footer>
			<p style="float: left;">criado por: marcos paulo peters braga</p>
			<div class="footerLinksContato" style="float: right; margin: 2px 1% 0 0;">
				<p style="float: left; margin: -2px 4px 0 0; font-weight: bold;">Contato: </p>
				<a href="https://www.linkedin.com/in/marcos-paulo-peters-braga-4a9351229/" target="_blank" rel="noopener noreferrer">
					<img src="<?= IMG;?>linkedin-3-24.png" alt="linkedin" />
				</a>
				<a href="https://github.com/schmoetropin" target="_blank" rel="noopener noreferrer">
					<img src="<?= IMG;?>github-10-24.png" alt="github" />
				</a>
				<a href="https://www.instagram.com/marcospaulopeters/" target="_blank" rel="noopener noreferrer">
					<img src="<?= IMG;?>instagram-5-24.png" alt="instagram" />
				</a>
				<a href="https://wa.me/5531984644214" target="_blank" rel="noopener noreferrer">
					<img src="<?= IMG;?>whatsapp-24.png" alt="whatsapp" />
				</a>
				<a href="http://t.me/marcospaulopeters/" target="_blank" rel="noopener noreferrer">
					<img src="<?= IMG;?>telegram-24.png" alt="telegram" />
				</a>
				<div id="enviarEmailIcone" style="cursor: pointer; float: right; margin-left: 3px;">
					<img src="<?= IMG;?>email-24.png" alt="email" />
				</div>
                <input type="hidden" id="UPLOAD" value="<?= UPLOAD;?>" />
                <input type="hidden" id="STRING_TO_ARRAY_SEPARATOR" value="<?= STRING_TO_ARRAY_SEPARATOR;?>" />
			</div>
            <div>
                <script src="<?= JS?>LoginRegister.js"></script>
            </div>
		</footer>
	</body>
</html>