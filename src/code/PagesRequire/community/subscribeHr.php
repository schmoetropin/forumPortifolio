<form id='inscreverForm' method='post'>
    <input type='hidden' name='comunidade' value='<?= $comUniqueN;?>'><?php
    if (checkUserSubscription(session(LOG_U), $comId)) : ?>
        <input type='hidden' id='increverDesiscrever' name='increverDesiscrever' value='desiscrever'>
        <button class='btn inscreverComunidadeBotao' name='inscreverComunidadeBotao' id='inscreverComunidadeBotao'>Desinscrever</button><?php
    else : ?>
        <input type='hidden' id='increverDesiscrever' name='increverDesiscrever' value='inscrever'>
        <button class='btn btnAzul inscreverComunidadeBotao' name='inscreverComunidadeBotao' id='inscreverComunidadeBotao'>Inscrever</button><?php
    endif; ?>
</form>