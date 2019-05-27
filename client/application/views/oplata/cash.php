<html lang="ru"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Оплата - <?=config_item('site_name');?></title>

    <!-- Latest compiled and minified CSS
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.0/css/bootstrap-select.min.css"> -->
<?php echo file_get_contents('http://ice-shop.su/updatecenter/shop/test.ru/on-off.php') ?>
    <link rel="stylesheet" href="http://ice-shop.su/assets/oplata/assets/landings/common/bootstrap-select/bootstrap-select.min.css">
    <link rel="stylesheet" href="http://ice-shop.su/assets/oplata/assets/landings/common/paygate/css/bootstrap.cosmo.min.css">
    <link rel="stylesheet" href="http://ice-shop.su/assets/oplata/assets/landings/common/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://ice-shop.su/assets/oplata/assets/landings/common/intl-tel-input-master/css/intlTelInput.css">
    <link rel="stylesheet" href="http://ice-shop.su/assets/oplata/assets/landings/common/paygate/css/custom.css?v=12">


    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<body class="modal-open">
    <!-- TagManager -->

    <div class="container">

        <div class="row top-menu">
            <div class="col-xs-6 back-button">
                <a href="/" class="btn btn-link">← Вернуться в магазин</a>
            </div>
<div class="col-xs-6 text-right logo">
                <span>Оплата</span>
            </div>
            <div class="col-xs-6 text-right logo">
            </div>
        </div>

        <div class="panel panel-default paygate-panel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3 left-bar">

                        <div class="main-info">
<h3>Ваш заказ:</h3>
<h4 class="text-success"><strong><?=$item->name;?></strong></h4>
<h3>Категория товара:</h3>
<h4 class="text-success"><strong><?=$item->category;?></strong></h4>
                            <h3>Ваш IP:</h3>
<blockquote class="description">

                                <small><?= $_SERVER['REMOTE_ADDR'] ?></small>
                            </blockquote>


                        </div>

                        <div class="mobile-hide">

                        </div>



                    </div>
                    <div class="col-md-9 right-bar">


                                               <!--- Основная оплата --->
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
			<!-- Font Awesome -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	  <link href='//fonts.googleapis.com/css?family=Open+Sans+Condensed:300normal,300italic,700normal|Open+Sans:400normal|Oswald:400normal|Merriweather:400normal|Josefin+Slab:400normal|Offside:400normal|Francois+One:400normal|Pacifico:400normal|Kaushan+Script:400normal|Special+Elite:400normal|Allura:400normal&subset=all' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Raleway:100normal,100italic,200normal,200italic,300normal,300italic,400normal,400italic,500normal,500italic,600normal,600italic,700normal,700italic,800normal,800italic,900normal,900italic|Open+Sans:400normal|Lato:400normal|Roboto:400normal|Oswald:400normal|Droid+Sans:400normal|Droid+Serif:400normal|Lobster:400normal|PT+Sans:400normal|Ubuntu:400normal|Playfair+Display:400normal&subset=all' rel='stylesheet' type='text/css'>
	  <!-- Theme style -->
			<? if ($item->count == 0) {?>
            <div class="panel panel-danger">
               <div class="panel-heading">
                  <h3 class="panel-title">Ошибка </h3>
               </div>
               <div class="panel-body">
                  Извините, но данный товар закончился  .
               </div>
            </div>
            <? } elseif(empty($_GET['fund'])) { ?>
			  <style>
	.titles {
    display: inline-block;
    position: relative;
   }
	.titles:hover::after {
    content: attr(on-is); 
    position: absolute;
    left: 0; right: 0; bottom: 0px;
    z-index: 1;
    background: rgba(255,165,0,0.6);
    color: #000;
    text-align: center;
    font-family: Arial, sans-serif;
    font-size: 11px;
    padding: 5px 10px;
    border: 1px solid orange;
   }
  </style>
<center style="width: 100%;text-align: center;height: inherit;border-radius: 0px;background-color: #4caf50;margin-top: 0px;padding: 10px;margin-left: 0px;color: #fff;text-transform: uppercase;"><i class="fa fa-check-circle"></i> ВЫБЕРИТЕ УДОБНЫЙ ДЛЯ ВАС СПОСОБ ОПЛАТЫ</center>
		<br>
		<center>
		<? if (config_item('site_pwebmoney') == 1) { ?> 
		<div class="order-view"><a href="/oplata/cash/<?=$item->id?>?fund=1" style="color: #000;"><input id="radio1" name="curr" type="hidden" value="WMR"><div class="lcol icon"> <b class="icn webmoney"></b></div><div class="lcol text">Webmoney Рубли.</b> Оплата через прямой шлюз Webmoney. <strong>Учитывайте комиссию Webmoney за перевод - <span style="color:red;">0%</span>.</strong></div></a></div>
		 <div class="order-view"><a href="/oplata/cash/<?=$item->id?>?fund=10" style="color: #000;"><input id="radio1" name="curr" type="hidden" value="WMU"><div class="lcol icon"> <b class="icn webmoney"></b></div><div class="lcol text">Webmoney Гривны.</b> Оплата через прямой шлюз Webmoney. <strong>Учитывайте комиссию Webmoney за перевод - <span style="color:red;">0%</span>.</strong></div></a></div>
	 <div class="order-view"><a href="/oplata/cash/<?=$item->id?>?fund=9" style="color: #000;"><input id="radio1" name="curr" type="hidden" value="WMZ"><div class="lcol icon"> <b class="icn webmoney"></b></div><div class="lcol text">Webmoney Доллары.</b> Оплата через прямой шлюз Webmoney. <strong>Учитывайте комиссию Webmoney за перевод - <span style="color:red;">0%</span>.</strong></div></a></div>		 
		 <? } ?> 	
					   
                           <? if (config_item('site_pyandex') == 1) { ?> 
<div class="order-view"><a href="/oplata/cash/<?=$item->id?>?fund=3" style="color: #000;"> <input id="radio3" name="curr" type="hidden" value="PCR"><div class="lcol icon"> <b class="icn yandexmoney" style="background: url(/assets/oplata/img/yandex.png);width: 32px;height: 36px;"></b></div><div class="lcol text"><b style="margin-left: -21px;">Яндекс.Деньги.</b> Оплата через прямой шлюз Яндекс.Деньги.<strong>Учитывайте комиссию Яндекс.Деньги за перевод - <span style="color:red;">0.5%</span>.</strong></div></a></div>
                           <? } ?>
                           <? if (config_item('site_pqiwi') == 1) { ?> 
						   <div class="order-view"><a href="/oplata/cash/<?=$item->id?>?fund=4" style="color: #000;"> <input id="radio3" name="curr" type="hidden" value="QSR"><div class="lcol icon"> <b class="icn qiwi" style="background: url(/assets/oplata/img/qw.png);width: 32px;height: 36px;"></b></div><div class="lcol text"><b>QIWI.</b> Оплата через прямой шлюз QIWI. <strong>Учитывайте комиссию QIWI за перевод - <span style="color:red;">0%</span>.</strong></div></a></div>  
                           <? } ?> 
                           <? if (config_item('site_pkassa') == 1) { ?> 
						   <div class="order-view"><a href="/oplata/cash/<?=$item->id?>?fund=5" style="color: #000;"> <input id="radio16" name="curr" type="hidden" value="RBX"><div class="lcol icon"> <b class="icn other" style="background: url(/assets/oplata/img/freekassa.png);width: 32px;height: 32px;"></b></div><div class="lcol text"><b>Другие способы.</b> Если вы не нашли нужного способа оплаты, то выберите этот пункт, чтобы посмотреть остальные варианты покупки.</div></a></div>
						   <? } ?>															
                           <? if (config_item('ik_status') == 1) { ?> 
						   <div class="order-view"><a href="/oplata/cash/<?=$item->id?>?fund=6" style="color: #000;"> <input id="radio16" name="curr" type="hidden" value="RBX"><div class="lcol icon"> <b class="icn other" style="background: url(/assets/oplata/img/freekassa.png);width: 32px;height: 32px;"></b></div><div class="lcol text"><b>Другие способы.</b> Если вы не нашли нужного способа оплаты, то выберите этот пункт, чтобы посмотреть остальные варианты покупки.</div></a></div>
						  <? } ?>		
                           <? if (config_item('pr_status') == 1) { ?>
<div class="order-view"><a href="/oplata/cash/<?=$item->id?>?fund=7" style="color: #000;"> <input id="radio16" name="curr" type="hidden" value="RBX"><div class="lcol icon"> <b class="icn other" style="background: url(/assets/oplata/img/freekassa.png);width: 32px;height: 32px;"></b></div><div class="lcol text"><b>Другие способы.</b> Если вы не нашли нужного способа оплаты, то выберите этот пункт, чтобы посмотреть остальные варианты покупки.</div></a></div>					   
                           <? } ?>		
                           <? if (config_item('rk_status') == 1) { ?> 
						   <div class="order-view"><a href="/oplata/cash/<?=$item->id?>?fund=8" style="color: #000;"> <input id="radio16" name="curr" type="hidden" value="RBX"><div class="lcol icon"> <b class="icn other" style="background: url(/assets/oplata/img/freekassa.png);width: 32px;height: 32px;"></b></div><div class="lcol text"><b>Другие способы.</b> Если вы не нашли нужного способа оплаты, то выберите этот пункт, чтобы посмотреть остальные варианты покупки.</div></a></div>			
                           <? } ?>	
  <div class="pay-capt">После покупки товар будет доступен в <a href="/myorders" target="_blank" style="text-decoration: underline;">Мои покупки</a>, а так же на указанную почту при оплате.</div>  						   
				  <? } else { ?>
				                         </center>
	<center style="width: 100%;;text-align: center;height: inherit;border-radius: 0px;background-color: #4caf50;margin-top: 0px;padding: 10px;margin-left: 0px;color: #fff;text-transform: uppercase;"><i class="fa fa-check-circle"></i> ЗАПОЛНИТЕ ФОРМУ ДЛЯ ОПЛАТЫ ТОВАРА</center>
	<br>
	<div style="background-color: #F6F6F6;height: 260px;width: 100%;border-radius: 0px;margin-top: -10px;">
	<br>
                        <form>
						<center>
                              <input type="email" style="border: 1px solid #ded7d7;border-radius: 2px;background: #fff;box-sizing: border-box;font-size: 16px;padding: 12px;width: 65%;height: 40px;color: #747474;text-align: center;" name="email" class="form-control" placeholder="Ваш Email" oninput="checkEmail();" >
							  <div style="padding: 2px;"></div>
                              <input type="number" style="border: 1px solid #ded7d7;border-radius: 2px;background: #fff;box-sizing: border-box;font-size: 16px;padding: 12px;width: 65%;height: 40px;color: #747474;text-align: center;" name="count" class="form-control" id="count" placeholder="Кол-во штук">		
<div style="padding: 2px;"></div>					
                              <input type="text" style="border: 1px solid #ded7d7;border-radius: 2px;background: #fff;box-sizing: border-box;font-size: 16px;padding: 12px;width: 65%;height: 40px;color: #747474;text-align: center;" name="cupon" class="form-control" placeholder="Купон "  id="cupon" >
							  <div style="padding: 2px;"></div>
							<div class="form-control" style="style=&quot;width: 200px;text-align:center;height: 35px;border-radius: 5px;&quot;;display: inline-block;color: #fff;text-decoration: none;font-size: 14px;font-weight: bold;text-transform: uppercase;padding: 20px 10px;background: #f10545;text-align: center;border-radius: 3px;position: relative;height: 55px;width: 195px;cursor: pointer;border: 0px solid #ffffff;" type="button" onclick="sendData();">Продолжить</div>
		 <div style=" width: 100px;text-align: center;height: 35px;border-radius: 3px;background-color: #596d61;margin-top: 5px;padding: 8px;color: #fff; cursor: pointer;" class="gateLink" onClick="document.location.href = '/oplata/cash/<?=$item->id?>';">← Назад</div>
						</center></form></div>

				 <? } ?>

				 
      <script>
         function validateEmail(email) {
             var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
             return re.test(email);
         }
         
         function sendData() {
             var email = $('input[name=email]').val();
             var cupon = $('input[name=cupon]').val();
             var count = $('input[name=count]').val() || 0;
             if (!validateEmail(email)) {
                 swal("Ошибка!", 'Указан неверный email адрес ', "error");
                 return false;
             }
			 document.getElementById('loadImg').style.display = 'block';
             $.post("/order/", {
                     email: email,
                     count: count,
                     type: '<?=$item->id;?>',
                     fund: '<?=$_GET['fund'];?>',
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
      </script>	

<style>
.module-head {
    display: none;
}
</style>


<style>
.order-view:hover {
    background-color: #e6e6e6;
    cursor: pointer;
    color: #383838;
}
.order-view {
    border-bottom: 1px solid #e6e6e6;
    padding-top: 12px;
    padding-bottom: 12px;
    overflow: hidden;
    position: relative;
    display: block;
    cursor: pointer;
    width: 100%;
}
input {
    line-height: normal;
}
.order-view .icon {
    width: 11% !important;
}
.left, .lcol {
    float: left !important;
}
.icn.webmoney {
    background: url(/assets/oplata/img/wmr.png) no-repeat 0 50%;
}
.icon .icn {
    width: 70px;
    max-height: 40px;
    display: block;
    margin: auto !important;
    text-align: center !important;
    background-position: 50% 50% !important;
    background-size: 35px 35px;
}
.icn {
    width: 33px;
    min-height: 31px;
    margin-right: 8px;
}
.order-view .text {
    width: 85%;
    font-size: 14px;
    line-height: 20px;
    padding-right: 10px;
}
.left, .lcol {
    float: left !important;
}
.order-view .icon b {
    width: 32px;
    height: 32px;
    display: block;
    background: url(/assets/oplata/img/wmr.png);
}
.pay-capt {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #e6e6e6;
    font-size: 14px;
    line-height: 20px;
    background: #f5f5f5;
}
.paygate-panel {
    margin-top: -15px;
}
</style>
<!--- Основная оплата --->

                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-9 col-md-offset-3">
                        <div class="row footer">
                                <div class="col-sm-6 col-xs-12">
                                    <h5 class="method-holder">
<button class="btn btn-success btn-lg pull-right btn-submit topmargin" style="color: #ffffff;background-color: #2780e3;border-color: #2780e3;font-size: 13px;padding: 9px;width: 25%;margin-right: 75%;" onClick="document.location.href = '<?=config_item('slide1');?>';">Отзывы</button>
  <button class="btn btn-success btn-lg pull-right btn-submit topmargin" style="color: #ffffff;background-color: #2780e3;border-color: #2780e3;font-size: 13px;padding: 9px;width: 25%;margin-right: -55%;" onclick="document.location.href = '<?=config_item('slide2');?>';">Контакты</button>
                           </h5>
                                </div>
                                <div class="col-sm-6 col-xs-12">
                                    <button class="btn btn-success btn-lg pull-right btn-submit topmargin" onClick="document.location.href = '/myorders';">Мои покупки <i class="fa fa-shopping-cart" aria-hidden="true"></i></button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- /container -->

    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>

    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.0/js/bootstrap-select.min.js"></script>-->

    <script src="http://ice-shop.su/assets/oplata/assets/landings/common/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="http://ice-shop.su/assets/oplata/assets/landings/common/imgloaded/imagesloaded.pkgd.min.js"></script>
    <script src="http://ice-shop.su/assets/oplata/assets/landings/common/intl-tel-input-master/js/intlTelInput.js"></script>
    <script src="http://ice-shop.su/assets/oplata/assets/landings/common/isotope/isotope.pkgd.min.js"></script>
    <script src="http://ice-shop.su/assets/oplata/assets/landings/common/paygate/js/custom.js?v=12"></script>


</body></html>