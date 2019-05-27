<? 
$tpl    = new Template; //инициируем класс 
$tpl->load_template(config_item('reviews'));
$tpl->set('<?', '<!--'); 
$tpl->set('?>', '-->'); 
$tpl->set('php?>', '-->'); 
$tpl->set('<?php', '<!--'); 
$tpl->set('{reviews_good}', ''); 
$tpl->set('{reviews_nogood}', '');
$tpl->set('{reviews_data}', '<? echo $data["slug"];?>'); 
$tpl->set('{reviews_title}', '<? echo $data["body"];?>'); 
$tpl->compile('reviews'); 
eval (' ?' . '>' . $tpl->result['reviews'] . '<' . '?php '); 
$tpl->global_clear();
?> 

