<h1>Search</h1>
<?php
$count = count($coms);
if ($count > 0) : 
    for ($i = 0; $i < $count; $i++) : ?>
        <small>achou</small><?php
    endfor;
else : ?>
    <small>Nenhuma comunidade foi encontrada</small><?php
endif;