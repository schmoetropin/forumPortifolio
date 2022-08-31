<form id='inscreverForm2' method='post'>
    <input type='hidden' name='comunidade' value='<?= $comUniqueN;?>'><?php
    if (checkUserSubscription(session(LOG_U), $comId)) : ?>
        <input type='hidden' id='increverDesiscrever' name='increverDesiscrever' value='desiscrever'>
        <button class='btn inscreverComunidadeBotao' name='inscreverComunidadeBotao' id='inscreverComunidadeBotao2'>Desinscrever</button><?php
    else : ?>
        <input type='hidden' id='increverDesiscrever' name='increverDesiscrever' value='inscrever'>
        <button class='btn btnAzul inscreverComunidadeBotao' name='inscreverComunidadeBotao' id='inscreverComunidadeBotao2'>Inscrever</button><?php
    endif; ?>
</form>