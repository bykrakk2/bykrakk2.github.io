<? 
if ($this->data['page']->loader == '1') {
include "class.php";
$tpl    = new Template;
$tpl->load_template($page->tpl);
} else {
$tpl    = new Template;
$tpl->load_template(config_item('page'));
}
//подставляем значения переменных 
$tpl->set('{page_name}', $page->title); 
$tpl->set('{page_body}', $page->body); 
$tpl->set('<?', '<!--'); 
$tpl->set('?>', '-->'); 
$tpl->set('php?>', '-->'); 
$tpl->set('<?php', '<!--'); 
$tpl->compile('page'); //собираем шаблон
eval (' ?' . '>' . $tpl->result['page'] . '<' . '?php '); //выводим результат работы, с возможностью вставки пхп кода в tpl
$tpl->global_clear();
?> 