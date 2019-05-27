<? 
error_reporting(0);
if (config_item('jobsite') == 0) {
?>
<!DOCTYPE html>
<html>
  <head>
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="http://code.jquery.com/jquery.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/css/materialize.min.css">
<link href='//fonts.googleapis.com/css?family=Lobster:400normal|Droid+Sans:400normal|Open+Sans:400normal|Raleway:400normal|Oswald:400normal|Play:400normal|Shadows+Into+Light:400normal|Droid+Serif:400normal|Lato:400normal|PT+Sans:400normal|Ubuntu:400normal&subset=all' rel='stylesheet' type='text/css'>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.96.1/js/materialize.min.js"></script>
 </head>
<body style="background: url(http://i.imgur.com/vdonjoM.png);background-repeat: repeat; ">
 <div class="row">
      <div class="col s12 m5" style=" margin-left: 31%;margin-top: 4%;">
        <div class="card-panel white">
		<center><h1 style="font-family:Lobster"><?=config_item('site_name');?></h1></center>
		<center><h4>Магазин был отключён администрацией магазина.</h4></center>
                 <div class="row">
            </div>
        </div>
      </div>
    </div>   
  <div class="row">
     <div class="s12 m4 l8">
	 </div>
    </div>
  </body>
</html>
<?
} else { 

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
$tpl->set('{cat_link}', '<? echo "/category/".$cat["slug"].""; ?>'); 
$tpl->set('{cat_icon}', '<? echo $cat["icon"];?>'); 
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
}
?>
<script src="/assets/adm/jquery-2.1.4.min.js"></script> 
<script src="/assets/adm/sweetalert2.min.js"></script>
<link rel="stylesheet" href="/assets/adm/sa/sa.css">
<script>
         function validateEmail(email) {
             var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
             return re.test(email);
         }
         function buy(id) {
			 
			swal({
  title: 'Ввод данных',
  html: '<input id="email" name="email" placeholder="Email"> <input id="count" name="count"  placeholder="Кол-во"> <input id="cupon" name="cupon" placeholder="Купон"><? if (config_item('site_pwebmoney') == '1') { ?><label class="" title="WMR" > <input type="radio" id="fund" name="fund" value="1" />  <img src="http://i.imgur.com/xzHmsvU.png"> </label><? } ?><? if (config_item('site_pqiwi') == '1') { ?><label class="" title="Qiwi" > <input type="radio" id="fund" name="fund" value="4" /> <img src="http://i.imgur.com/psm0I7B.png"> </label><? } ?><? if (config_item('site_pyandex') == '1') { ?><label class="" title="Yandex"> <input type="radio" name="fund" id="fund" value="3" /> <img src="http://i.imgur.com/H4F9ZdY.png"> </label> <? } ?><? if (config_item('site_pkassa') == '1') { ?><label class="" title="Free-kassa"> <input type="radio" name="fund" id="fund" value="5" /> <img src="http://i.imgur.com/e3THVhq.png"> </label><? } ?><? if (config_item('ik_status') == '1') { ?><label class="" title="Interkassa"> <input type="radio" name="fund" id="fund" value="6" /> <img src="http://i.imgur.com/qSI6kAf.png"> </label><? } ?><? if (config_item('pr_status') == '1') { ?><label class="" title="Payeer"> <input type="radio" name="fund" id="fund" value="7" /> <img src="http://i.imgur.com/zCqJhzz.png"> </label><? } ?><? if (config_item('rk_status') == '1') { ?><label class="" title="Robokassa"> <input type="radio" name="fund" id="fund" value="8" /> <img src="http://i.imgur.com/dwFVoTD.png"> </label><? } ?>',
  showCancelButton: true,
  closeOnConfirm: false,
  allowEscapeKey: false,
  allowOutsideClick: false
}).then(function(isConfirm) {
  if (isConfirm) {
        var email = $('#email').val();
        var count = $('#count').val() || 0;
        var cupon = $('#cupon').val();
        var fund = $('input[name="fund"]:checked').val();
		
		
        if (!validateEmail(email)) {
            swal("Ошибка!", 'Указан неверный email адрес ', "error");
            return false;
        }
        document.getElementById('loadImg').style.display = 'block';
        $.post("/order/", {
                email: email,
                count: count,
                type: id,
                fund: fund,
                cupon: cupon
            },
			
            function(data) {
				document.getElementById('loadImg').style.display = 'none';
                try {
                    var res = JSON.parse(data);
                    if (res.ok == 'TRUE') {
                        window.location.href = "/oplata"
                    }
                    if (typeof(res.error) !== "undefined" && res.error !== null) {
                        showerr(res.error);
                    }
                } catch (err) {
                    eval(data);
                }
            });	  
	  
	
  }
}) 
			 
			 
			 

         }


</script>


