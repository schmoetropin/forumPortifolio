<div class="chatArea">
    <div>
        <input type="hidden" id="getUChat" value="<?= $user['unique_name'];?>"/>
    </div>
    <div class="usuarioChat"><?php
    $usId = getUserId($user['unique_name']); ?>
        <a class="voltarPerfil" href="<?= REQ_URI.'/users/'.$user['unique_name'];?>">
            <img src="<?= IMG;?>arrow-97-24.png" alt="voltar" />
        </a>
        <div class="imagemPerfilChat">
            <a href="<?= REQ_URI.'/users/'.$user['unique_name'];?>">
                <img src="<?= getUserProfilePic($usId);?>" alt="imagemPerfil"/>
            </a>
        </div>
        <h3><?= getUserName($usId);?></h3>
    </div>
    <div class="chatMensagens" id="chatCaixaMens"></div>
    <div class="chatFormDiv">
        <form id="chatForm" method="POST">
            <input type="hidden" name="usuarioMensagem" value="<?= $user['unique_name'];?>" />
            <textarea name="mensagemTextarea" id="mensagemTextarea" placeholder="Digite sua mensagem aqui..."></textarea>
            <button id="chatBotao" class="btn btnAzul">Enviar</button>
        </form>
    </div>
</div>