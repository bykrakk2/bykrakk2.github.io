<? 
$tpl    = new Template; //инициируем класс 
$tpl->load_template(config_item('items'));
//подставляем значения переменных 
$tpl->set('<?', '<!--'); 
$tpl->set('?>', '-->'); 
$tpl->set('php?>', '-->'); 
$tpl->set('<?php', '<!--');  
if (config_item('block_1') == '1') {
 $tpl->set('{items_buy}', 'href="/oplata/cash/<?=$item->id;?>"'); 
} else {
 $tpl->set('{items_buy}', 'onclick="buy(<?=$item->id;?>)"'); 
}
$tpl->set('{items_id}', '<? echo $item->id ; ?>'); 
$tpl->set('{items_views}', '<? echo $item->viewed ; ?>'); 
$tpl->set('{items_min}', '<? echo  $item->min_order ;?>'); 
$tpl->set('{items_cat}','<? $b = mysql_query("SELECT * FROM categories where id =".$item->category.""); $c = mysql_fetch_array($b); echo $c["title"]; ?>');   
$tpl->set('{items_count}','<? echo $item->count; ?>'); 
$tpl->set('{items_name}','<? echo $item->name; ?>'); 
$tpl->set('{items_skidka}', '<? echo  $item->skidka ?>'); 
$tpl->set('{items_icon}', '<? echo $item->iconurl ?>'); 
$tpl->set('{items_rub}', '<? if (round($item->price_final*100)/100 < 1) {echo $item->price_final;}else {echo round($item->price_final*100)/100 ;}?>'); 
$tpl->set('{items_url}','<? echo  base_url("item/".$item->id) ?>'); 
$tpl->set('{items_info}','<?  echo $item->info; ?>'); 
$tpl->set('{items_full}','<?  echo $item->descr ?>'); 
$tpl->set('[no-items]', '<? else: ?>'); 
$tpl->set('[/no-items]', '<? endif; ?>'); 
$tpl->set('[items]', '<? if($items): foreach($items as $item): ?>'); 
$tpl->set('[/items]', '<? endforeach; ?>'); 
$tpl->set('{pagination}', '<?=$pagination;?> '); 
$tpl->compile('items'); //собираем шаблон
eval (' ?' . '>' . $tpl->result['items'] . '<' . '?php '); //выводим результат работы, с возможностью вставки пхп кода в tpl
$tpl->global_clear();
?> 