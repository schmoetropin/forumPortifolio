<input type='hidden' id="paginaUsuarioId" value="<?= $us['unique_name'];?>">
	<div class="perfilColunaPrincipal">
		<div class="perfilCabecalho">
            <img src="<?= IMG.'imagemFundo_7.jpg'?>" alt=""/>
			<h3>
				<div id="nomeUsuarioPagina" style='color: #fff;'><?= $us['name']?></div>
			</h3>
		</div>
		<div class="informacaoUsuarioEsquerda">
			<div class="fotoPerfil">
				<div id="fotoUsuarioPagina">
					<img src="<?= $us['profile_pic'];?>" alt="fotoDePerfil" />
				</div>
			</div>
			<div id='tipoUsuarioHiddenInput'>
				<input type='hidden' id='tipoUsuarioH' value="<?= $us['user_type'];?>" />
			</div>
			<div id='tipoUsuarioArea'><?php
				if ($us['user_type'] === 1) : ?>
                    <p class='tipoUsuario btn btnAzul'>Usuario</p><?php
                elseif ($us['user_type'] === 2) : ?>
                    <button class='tipoUsuario btn btnVerde' id='modComunBot'>Moderador</button>
                    <div id='modComunCaixa'>
                        <h3>Moderador</h3>
                        <img src='assets/imagens/icones/close.png' id='fecharModComunCaixa'>
                        <div id='modComunCaixaComunidades'><?php
                            /*
                            $id = $this->nomeU->selecionarId($usuario, 'usuario');
                            $this->mFObj->exibirComunidadesModerador($id);*/
                            ?>
                        </div>
                    </div><?php
                else : ?>
                    <p class='tipoUsuario btn btnVermelho'>Admin</p><?php
                endif; ?>
			</div>
			<ul>
                <li>Email: 
                    <div id="emailUsuarioPagina" style='display: inline;'><?=
                        $us['email'];?>
                    </div>
                </li>
                <li>Topicos: <?= $us['number_topics'];?></li>
                <li>Posts: <?= $us['number_posts'];?></li>
                <li>Amigos: <?= $us['number_friends'];?></li>
                <li>Inscricoes: <?= $us['number_subscriptions'];?></li><?php
                if (session(LOG_U)) :
                    if (session(LOG_U) === $us['id']) : ?>
                        <li class="logoutPerfil"><button class="btn btnVermelho" id="botaoLogoutPerfil">Logout</button></li><?php 
                    endif;
                endif; ?>
            </ul>
		</div>
        <div class="barraTopoPerfil">
            <div id="AltRes">
                <h4 id="btSobre" class="btTopoPerfil">Sobre</h4>
                <h4 id="btTopicos" class="btTopoPerfil">Topicos</h4>
                <h4 id="btPosts" class="btTopoPerfil">Posts</h4>
                <h4 id="btAmigos" class="btTopoPerfil">Amigos</h4>
                <h4 id="btMensagens" class="btTopoPerfil">Mensagens</h4>
                <h4 id="btRequerimento" class="btTopoPerfil">Requerimento</h4>
            </div>
            <div id="baixRes">
                <button  class="btnInvisivel" id="baixResBotao"><img src="<?= IMG;?>activity-feed-32.png"></button>
                <div id="baixResMenu">
                    <h4 id="brSobre">Sobre</h4>
                    <h4 id="brTopicos">Topicos</h4>
                    <h4 id="brPosts">Posts</h4>
                    <h4 id="brAmigos">Amigos</h4>
                    <h4 id="brMensagens">Mensagens</h4>
                    <h4 id="brRequerimento">Requerimento</h4>
                </div>
            </div>
        </div>
        <div class="conteudoPerfil">
	<!-----------------------------------
	--- SOBRE
	------------------------------------>	
			<div class="cSobre">
                <div style="margin-top: 20px; padding: 0 8px 0 8px;" class="divConteMarg"><?php
                    if (session(LOG_U)) :
                        if (session(LOG_U) === $us['id']) : ?>
                            <!-- LOGGED NA PROPRIA PAGINA -->
                            Inscricoes: 
                            <div class="usuarioInscricoes">
                                <?php// echo $usObj->exibirComunidadesInscritas($logU);?>
                            </div>
                            <button id="botaoEditarPerfilCaixa" class="btn btnAzul">editar perfil</button>
                            <div class='editarPerfilCaixa'>
                                <div class="tFotoPerfil">
                                    <p>Tocar foto:</p>
                                    <form method="post" id="trocarFotoPerfilForm" enctype="multipart/form-data">
                                        <input type="hidden" name="usuario" value="<?= $us['unique_name'];?>" />
                                        <input type="file" id="trocarFotoPerfil" name="trocarFotoPerfil" required>
                                        <input type="submit" id="trocarFotoPerfilBotao" class="btn btnAzul" name="trocarFotoPerfilBotao" value="trocar foto">
                                    </form>
                                </div>
                                <div class="tNome">
                                    <p>Trocar nome:</p>
                                    <form method="post" id="trocarNomeForm">
                                        <input type="hidden" name="usuario" value="<?= $us['unique_name'];?>" />
                                        <input type="text" id="trocarNome" name="trocarNome" placeholder="Nome" required>
                                        <input type="submit" id="trocarNomeBotao" class="btn btnAzul" value="trocar nome">
                                    </form>
                                </div>
                                <div class="tEmail">
                                    <p>Trocar email:</p>
                                    <form method="post" id="trocarEmailForm">
                                        <input type="hidden" name="usuario" value="<?= $us['unique_name'];?>" />
                                        <input type="email" id="trocarEmail" name="trocarEmail" placeholder="Email" required>
                                        <input type="email" id="trocarEmail2" name="trocarEmail2" placeholder="Confirmar Email" required>
                                        <input type="submit" id="trocarEmailBotao" class="btn btnAzul" value="trocar Email">
                                    </form>
                                </div>
                                <div class="tSenha">
                                    <p>Trocar senha:</p>
                                    <form method="post" id="trocarSenhaForm">
                                        <input type="hidden" name="usuario" value="<?= $us['unique_name'];?>" />
                                        <input type="password" id="trocarSenha" name="trocarSenha" placeholder="Senha" required>
                                        <input type="password" id="trocarSenha2" name="trocarSenha2" placeholder="Confirmar senha" required>
                                        <input type="submit" id="trocarSenhaBotao" class="btn btnAzul" value="trocar senha">
                                    </form>
                                </div>
                            </div><?php	
                        else : ?>
                            <!-- LOGGED NA PAGINA DE OUTRO USUARIO -->
                            Inscricoes: 
                            <div class="usuarioInscricoes">
                                <?php // echo $usObj->exibirComunidadesInscritas($get);?>
                            </div><?php
                            //admin
                            if ($us['user_type'] === 3) : ?>
                                <button id="botaoEditarPerfilCaixa" class="btn btnAzul">editar perfil</button>
                                <div class='editarPerfilCaixa'>
                                    <div class="tFotoPerfil">
                                        <p>Trocar foto:</p>
                                        <form method="post" id="trocarFotoPerfilForm" enctype="multipart/form-data">				
                                            <input type="hidden" name="usuario" value="<?= $us['unique_name'];?>" />
                                            <input type="file" id="trocarFotoPerfil" name="trocarFotoPerfil" required>
                                            <input type="submit" id="trocarFotoPerfilBotao" class="btn btnAzul" name="trocarFotoPerfilBotao" value="trocar foto">
                                        </form>
                                    </div>
                                    <div class="tNome">
                                        <p>Trocar nome:</p>
                                        <form method="post" id="trocarNomeForm">
                                            <input type="hidden" name="usuario" value="<?= $us['unique_name'];?>" />
                                            <input type="hidden" name="usuario" value="<?= $us['unique_name'];?>" />
                                            <input type="text" id="trocarNome" name="trocarNome" placeholder="Nome" required>
                                            <input type="submit" id="trocarNomeBotao" class="btn btnAzul" value="trocar nome">
                                        </form>
                                    </div>
                                </div><?php	
                            endif;
                        endif;
                    else : ?>
                        <!-- LOGGED OFF -->
                        Inscricoes: 
                        <div class="usuarioInscricoes">
                            <?php // echo $usObj->exibirComunidadesInscritas($get);?>
                        </div><?php 
                    endif; ?>
                </div>
            </div>	
	<!-----------------------------------
	--- POSTS
	------------------------------------>	
			<div class="cPosts">
				<div style="margin: 20px;" class="divConteMarg">
				<?php // echo $posObj->exibirPosts(NULL, NULL, $usObj->getId());?></div>
			</div>
	<!-----------------------------------
	--- TOPICOS
	------------------------------------>
			<div class="cTopicos">
				<div class="divConteMarg">
				<?php // echo $topExb->exibirTodosTopicos(NULL, $usObj->getId());?></div>
			</div>
	<!-----------------------------------
	--- AMIGOS
	------------------------------------>
			<div class="cAmigos">
				<div style="margin-top: 20px; padding: 0 8px 0 8px;" class="divConteMarg">
					<div id="listaAmigos"><?php
                        /*
						if(isset($_SESSION['logUsuario'])){
							if(empty($_GET['us']) || $_SESSION['logUsuario'] == $_GET['us'])
								$amigObj->exibirAmigos($logU);
							else
								$amigObj->exibirAmigos($get);
						}else
							$amigObj->exibirAmigos($get);*/
                        ?>
                    </div>
				</div>
			</div>
	<!-----------------------------------
	--- MENSAGEM
	------------------------------------><?php
			if (session(LOG_U)) :
				if (session(LOG_U) === $us['id']) : ?>
					<div class="cMensagens">
						<div style="margin-top: 20px; padding: 0 8px 0 8px;" class="divConteMarg"><?php
							//$mesObj->checarTodasConversas($_SESSION['logUsuario']) ?>
						</div>
					</div><?php
				else : ?>
					<div class="cMensagens">
						<div style="margin-top: 20px; padding: 0 8px 0 8px;" class="divConteMarg">
							<a href="<?= REQ_URI.'/chat/'.$us['unique_name'];?>" class="btn btnAzul abrirChatBotao">
								abrir chat
							</a>
						</div>
					</div><?php
				endif;
			else : ?>
				<div class="cMensagens">
					<div style="margin-top: 20px; padding: 0 8px 0 8px;" class="divConteMarg">
						<small style="margin: 0 0 0 7%;">*Voce nao esta logado, nao pode enviar mensagens</small>
					</div>
				</div><?php
			endif; ?>
    <!-----------------------------------
    --- REQUERIMENTOS
    ------------------------------------>
			<div class="cRequerimento">
				<div style="margin-top: 20px; padding: 0 8px 0 8px;" class="divConteMarg"><?php
                if (session(LOG_U)) :
                    if (session(LOG_U) === $us['id']) : ?>
                        <input type="hidden" id="logUsuario" value="<?php echo $_SESSION['logUsuario'];?>">
                        <input type="hidden" id="paginaUsuario" value="nenhum">
                        <div id="reqModRecebidaArea"><?php
                           // $mFObj->exibirModRequisicaoRecebida($_SESSION['logUsuario']);?>
                        </div>
                        <div id="reqModEnviadaArea"><?php
                            //$modObj->exibirTodosModRequisicaoEnviada($logU);?>
                        </div>
                        <div id="checarReqAmRecEnv"><?php
                            //$amigObj->checarRequerimentosDeAmizadeRecebido($_SESSION['logUsuario']);
                            //$amigObj->checarTodosRequerimentosDeAmizadeEnviado($_SESSION['logUsuario']);?>
                        </div><?php				
                    else :
                        //$checUs = $UsNullObj->tipoUsuario($logU);?>
                        <input type="hidden" id="logUsuario" value="<?php echo $_SESSION['logUsuario'];?>" />
                        <input type="hidden" id="paginaUsuario" value="<?php echo $_GET['us'];?>" /><?php
                        // if moderator
                        if (false) { ?>
                            <div id="modRequerimentoFormArea"><?php
                                $mFObj->requisicaoModerador($_SESSION['logUsuario'], $_GET['us']);?>
                            </div>
                            <div id="reqModUsuarioEnviadaArea"><?php
                                $modObj->exibirModRequisicaoEnviadaUsuario($logU, $get);?>
                            </div><?php
                        } ?>
                        <small style="margin: 0 0 0 12%;">Pedidos de amizade:</small><br><br>
                        <div id="requerimentoAmigoAbaArea"><?php
                            if (session(LOG_U)) :  
                                if (session(LOG_U) !== $us['id']) :
                                    /*
                                    $checar = $amigObj->checarListaDeAmigos($logU, $get);
                                    if($checar)
                                        $amigObj->removerAmigoForm($_GET['us']);    
                                    else{
                                        $checar = $amigObj->checarRequisicaoAmizade($logU, $get);
                                        if($checar > 0)
                                            $amigObj->exibirRequizicaoAmizadeEnviadoUsuario($get);
                                        else
                                            $amigObj->formularioRequerimentoAmizade($_SESSION['logUsuario'], $_GET['us']);
                                    }
                                    */
                                endif;
                            endif; ?>
                        </div><?php
                    endif;
                else : ?>
                    <small style="margin: 0 0 0 7%;">*Voce nao esta logado</small><?php
                endif; ?>
                </div>
			</div>
			<div style="width: 100%; height: 80px;"></div>
		</div>
	</div>
	<div class="mensagemErroDiv" id="mensagemErroPerfilDiv">
		<div id="mensagemPerfilDiv" class="mensagemErro"></div>
		<button id="fecharPerfilMes" class="btn btnVermelho">ok</button>
	</div>
	<div class="fundoOpacoMensagemErro" id="fundoOpacoMensagemPerfilErro"></div>
    <div>
        <script src="<?= JS;?>UserTabs.js"></script>
        <script src="<?= JS;?>UserEdit.js"></script>
    </div>