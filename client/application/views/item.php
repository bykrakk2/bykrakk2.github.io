<? 
$tpl    = new Template; //инициируем класс 
$tpl->load_template(config_item('item'));
$tpl->set('<?', '<!--'); 
$tpl->set('?>', '-->'); 
$tpl->set('php?>', '-->'); 
$tpl->set('<?php', '<!--'); 
$tpl->set('{item_id}', '<? echo $item->id ; ?>'); 
if (config_item('block_1') == '1') {
 $tpl->set('{item_buy}', 'href="/oplata/cash/<?=$item->id;?>"'); 
} else {
 $tpl->set('{item_buy}', 'onclick="buy(<?=$item->id;?>)"'); 
}
$tpl->set('{item_views}', '<? echo $item->viewed ; ?>'); 
$tpl->set('{item_min}', '<? echo  $item->min_order ;?>'); 
$tpl->set('{item_orders}', '<? $b = mysql_query("SELECT COUNT( * ) FROM `orders` WHERE item_id ='.$item->id.' AND paid =1"); echo $b; ?>'); 
$tpl->set('{item_name}','<? echo $item->name; ?>');   
$tpl->set('{item_cat}','<? echo $item->category ?>');   
$tpl->set('{item_skidka}', '<? echo  $item->skidka ?>'); 
$tpl->set('{item_icon}', '<? echo $item->iconurl ?>'); 
$tpl->set('{item_count}', '<? echo  $item->count ?>'); 
$tpl->set('{item_janr}','<? echo $item->janr; ?>');   
$tpl->set('{item_yazuk}','<? echo $item->yazuk ?>');   
$tpl->set('{item_platforma}', '<? echo  $item->platforma ?>'); 
$tpl->set('{item_mylytplayeer}', '<? echo $item->mylytplayeer ?>'); 
$tpl->set('{item_relyz}', '<? echo  $item->relyz ?>'); 
$tpl->set('{item_izdatel}','<? echo $item->izdatel; ?>');   
$tpl->set('{item_atkiv}','<? echo $item->atkiv ?>');   
$tpl->set('[admin', '<? if (empty($this->session->userdata("email"))) {} else { ?>');
$tpl->set('[/admin]', '<? } ?>');
$tpl->set('[category]','<? $catr = "SELECT * FROM categories"; ?><?$cater = mysql_query($catr); ?><? while( $lb = mysql_fetch_array($cater)){ ?><?if($item->category == $lb["slug"]){ ?>');
$tpl->set('{category_title}', '<? echo $lb["title"];?>'); 
$tpl->set('{category_url}', '/category/<? echo $lb["slug"];?>');
$tpl->set('{category_icon}', '<? echo $lb["icon"];?>');
$tpl->set('[/category]', '<? } ?><? } ?>'); 
$tpl->set('{item_rub}', '<? if (round($item->price_final*100)/100 < 1) {echo $item->price_final;} else {echo round($item->price_final*100)/100 ;}?>'); 
$tpl->set('{item_url}','<? echo  base_url("item/".$item->id) ?>'); 
$tpl->set('{item_info}','<?  echo $item->info ?>'); 
$tpl->set('{item_full}','<?  echo $item->descr ?>'); 
$tpl->set_block ( '#\[random_item_(.+?)\]#is', '<? $last_query = "SELECT * FROM `goods` where id != {$item->id}  ORDER BY RAND() LIMIT  \\1"; 
$last_cat = mysql_query( $last_query);  while ( $lb = mysql_fetch_array( $last_cat ) ) { ?>' ); 
$tpl->set('[random_item]', '<? $last_query = "SELECT * FROM `goods` where id != {$item->id}  ORDER BY RAND() LIMIT  4"; 
$last_cat = mysql_query( $last_query);  while ( $lb = mysql_fetch_array( $last_cat ) ) { ?>' ); 
$tpl->set('{random_info}', '<? echo $lb["info"];?>'); 
$tpl->set('{random_name}', '<? echo $lb["name"];?>'); 
$tpl->set('{random_icon}', '<? echo $lb["iconurl"];?>'); 
$tpl->set('{random_rub}', '<? echo  round($lb["price_final"]*100)/100 ;?>'); 
$tpl->set('{random_id}', '<? echo $lb["id"];?>'); 
$tpl->set('[/random_item]', '<? } ?>');
$tpl->set('{url}', $_SERVER['SERVER_NAME']);
$tpl->set('[item]', '<? if(count($items)): foreach($items as $item): ?> <? mysql_query("UPDATE goods SET viewed=viewed+1 WHERE id = ".$item->id) or die(mysql_error()); ?>'); 
$tpl->set('[/item]', '<? endforeach; ?>'); 
$tpl->set('[count]', '<? if($item->count > 0 ) {?>'); 
$tpl->set('[/count]', '<? } ?>'); 
$tpl->set('[no-count]', '<? if($item->count == 0 ) {?>'); 
$tpl->set('[/no-count]', '<? } ?>'); 
$tpl->set('[no-item]', '<? else: ?>'); 
$tpl->set('[/no-item]', '<? endif; ?>'); 
$tpl->compile('item'); 
eval (' ?' . '>' . $tpl->result['item'] . '<' . '?php '); 
$tpl->global_clear();

?> 