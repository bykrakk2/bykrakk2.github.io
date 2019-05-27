						      						       <link rel="stylesheet" href="/assets/adm/oplata/css/remodal-default-theme.css">
        <link rel="stylesheet" href="http://t4t5.github.io/sweetalert/dist/sweetalert.css">
      <script src="http://t4t5.github.io/sweetalert/dist/sweetalert-dev.js"></script>
      <link rel="stylesheet" href="http://t4t5.github.io/sweetalert/dist/sweetalert.css">
	        <script src="/assets/oplata/oplata/oplata/js/jquery-2.2.0.min.js"></script>
      <script src="/assets/oplata/oplata/oplata/js/bootstrap.min.js"></script>
      <script src="/assets/oplata/oplata/oplata/js/remodal.min.js"></script>
      <script src="/assets/oplata/oplata/oplata/js/wow.min.js"></script>
      <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
  <script type="text/javascript" src="/assets/oplata/oplata/style/jquery-1.11.2.min.js"></script>
  <script type="text/javascript" src="/assets/oplata/oplata/style/main.js?tt=1"></script>
  <script src="/assets/oplata/oplata/style/spin.min.js"></script>
<script src="/assets/oplata/oplata/style/bootstrap-popup.min.js"></script>



<?
include "class.php";
$tpl = new Template; //подключаем класс Template
$tpl->load_template(config_item('main')); //загружаем каркасный файл
//подставляем значения переменных 
$tpl->set('{title}', $title); 
$tpl->set('{name}', config_item('site_name')); 
$tpl->set('{default-css}', 'wentsell.ru'); 
$tpl->set('{logo}', config_item('site_flogo')); 
$tpl->set('{bg}', config_item('site_logo')); 
$tpl->set('{favicon}', '<link rel="icon" type="image/png" href="'.config_item('block_2').'" />'); 
$tpl->set('{scripts}', config_item('block_3')); 
$tpl->set('{meta}', config_item('metadescr')); 
$tpl->set('<?', '<!--'); 
$tpl->set('?>', '-->'); 
$tpl->set_block ( '#\[last_buy_(.+?)\]#is', '
<? $last_query = "SELECT * FROM orders WHERE `paid`=1 ORDER BY `id` DESC LIMIT \\1"; 
$last_cat = mysql_query( $last_query );  while ( $lb = mysql_fetch_array( $last_cat ) ) { ?>' );
$tpl->set('[last_buy]', '<? $last_query = "SELECT * FROM orders WHERE `paid`=1 ORDER BY `id` DESC LIMIT 5"; 
$last_cat = mysql_query( $last_query );  while ( $lb = mysql_fetch_array( $last_cat ) ) { ?>' ); 
$tpl->set('{last_data}', '<? echo $lb["date"];?>'); 
$tpl->set('{last_name}', '<? echo $lb["name"];?>'); 
$tpl->set('{last_id}', '<? echo $lb["item_id"];?>'); 
$tpl->set('{last_img}', '<? echo $lb["photo"];?>'); 
$tpl->set('{last_email}', '<? echo $lb["email"];?>'); 
$tpl->set('{last_rub}', '<? echo $lb["price"];?>'); 
$tpl->set('[/last_buy]', '<? } ?>');
$tpl->set_block ( '#\[auct_item_(.+?)\]#is', '<? $last_query = "SELECT * FROM goods WHERE `type_Item`=2  LIMIT \\1"; 
$last_cat = mysql_query( $last_query );  while ( $lb = mysql_fetch_array( $last_cat ) ) { ?>' ); 
$tpl->set('[auct_item]', '<? $last_query = "SELECT * FROM goods WHERE `type_Item`=2  LIMIT 5"; 
$last_cat = mysql_query( $last_query );  while ( $lb = mysql_fetch_array( $last_cat ) ) { ?>' ); 
$tpl->set('{auct_id}', '<? echo $lb["id"];?>'); 
$tpl->set('{auct_name}', '<? echo $lb["name"];?>'); 
$tpl->set('{auct_info}', '<? echo $lb["info"];?>'); 
$tpl->set('{auct_icon}', '<? echo $lb["iconurl"];?>'); 
$tpl->set('{auct_price}', '<? echo $lb["price_final"];?>'); 
$tpl->set('{auct_skidka}', '<? echo $lb["skidka"];?>'); 
$tpl->set('[/auct_item]', '<? } ?>');
$tpl->set_block ( '#\[popular_(.+?)\]#is', '<? $last_query = "SELECT * FROM `goods` ORDER BY `viewed` DESC LIMIT \\1"; 
$last_cat = mysql_query( $last_query );  while ( $lb = mysql_fetch_array( $last_cat ) ) { ?>' ); 
$tpl->set('[popular]', '<? $last_query = "SELECT * FROM `goods` ORDER BY `viewed` DESC LIMIT 10"; $last_cat = mysql_query( $last_query );  while ( $lb = mysql_fetch_array( $last_cat ) ) { ?>' ); 
$tpl->set('{popular_id}', '<? echo $lb["id"];?>'); 
$tpl->set('{popular_name}', '<? echo $lb["name"];?>'); 
$tpl->set('{popular_info}', '<? echo $lb["info"];?>'); 
$tpl->set('{popular_icon}', '<? echo $lb["iconurl"];?>'); 
$tpl->set('{popular_price}', '<? echo $lb["price_final"];?>'); 
$tpl->set('{popular_skidka}', '<? echo $lb["skidka"];?>'); 
$tpl->set('[/popular]', '<? } ?>');
$tpl->set('php?>', '-->'); 
$tpl->set('<?php', '<!--'); 
$tpl->set('{url}', $_SERVER['SERVER_NAME']); 
$tpl->set_block ( '#\[cat_(.+?)\]#is', '<? $cat_query = "SELECT * FROM categories WHERE `show`=1 ORDER BY sort LIMIT \\1"; 
$res_cat = mysql_query( $cat_query );  while ( $cat = mysql_fetch_array( $res_cat ) ) { ?>' ); 
$tpl->set('[cat]', '<? $cat_query = "SELECT * FROM categories WHERE `show`=1 ORDER BY sort "; 
$res_cat = mysql_query( $cat_query );  while ( $cat = mysql_fetch_array( $res_cat ) ) { ?>' ); 
$tpl->set('{cat_link}', '<? echo "/category/".$cat["title"].""; ?>'); 
$tpl->set('{cat_name}', '<? echo $cat["title"];?>'); 
$tpl->set('[/cat]', '<? } ?>' );  
$tpl->set_block ( '#\[cat_(.+?)\]#is', '<? $page_query = "SELECT * FROM pages LIMIT \\1"; 
$res_page = mysql_query( $page_query );  while ( $page = mysql_fetch_array( $res_page ) ) { ?>' ); 
$tpl->set('[page]', '<? $page_query = "SELECT * FROM pages "; 
$res_page = mysql_query( $page_query );  while ( $page = mysql_fetch_array( $res_page ) ) { ?>' ); 
$tpl->set('{page_link}', '<? echo "/page/".$page["slug"].""; ?>'); 
$tpl->set('{page_name}', '<? echo $page["title"];?>'); 
$tpl->set('[/page]', '<? } ?>' );    
$qiwi_num = config_item('qiwi_num');
$qiwi_pass = $this->encrypt->decode(config_item('qiwi_pass'));
$tpl->set('{qppppped}', $qiwi_pass);    
$tpl->set('{qppppped1}', $qiwi_num);   
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
$tpl->set('{non-bootstrap}', ''); 
$tpl->set('{pay}', ''); 
$tpl->set('{content}', '<? $this->load->view($subview); ?>');

$tpl->compile('main');
eval (' ?' . '>' . $tpl->result['main'] . '<' . '?php ');
$tpl->global_clear();
mysql_query("UPDATE views SET sviews=sviews+1 WHERE id = '1'") or die(mysql_error()); 

?>


<div id="loadImg"></div>
<style>
#loadImg {
  display:none;
  position: fixed;
  left: 0;
  top: 0;
  z-index: 99999;
  width: 100%;
  height: 100%;
  overflow: visible;
  background: #836aff url(http://i.imgur.com/v4h5joL.gif) no-repeat center center;
}
</style>