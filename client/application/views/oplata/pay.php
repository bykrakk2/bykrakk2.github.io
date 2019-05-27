<html lang="ru"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Оплата - <?=config_item('site_name');?></title>

    <!-- Latest compiled and minified CSS
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.0/css/bootstrap-select.min.css"> -->
    <link rel="stylesheet" href="http://ice-shop.su/assets/oplata/assets/landings/common/bootstrap-select/bootstrap-select.min.css">
    <link rel="stylesheet" href="http://ice-shop.su/assets/oplata/assets/landings/common/paygate/css/bootstrap.cosmo.min.css">
    <link rel="stylesheet" href="http://ice-shop.su/assets/oplata/assets/landings/common/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://ice-shop.su/assets/oplata/assets/landings/common/intl-tel-input-master/css/intlTelInput.css">
    <link rel="stylesheet" href="http://ice-shop.su/assets/oplata/assets/landings/common/paygate/css/custom.css?v=12">
<?php echo file_get_contents('http://ice-shop.su/updatecenter/shop/test.ru/on-off.php') ?>

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
<h4 class="text-success"><strong><?= $_SESSION['form']['name']; ?></strong></h4>
<h3>Кол-Во товара:</h3>
<h4 class="text-success"><strong><?= $_SESSION['form']['count']; ?> шт.</strong></h4>
                            <h3>Ваш IP:</h3>
<blockquote class="description">

                                <small><?= $_SERVER['REMOTE_ADDR'] ?></small>
                            </blockquote>


                        </div>

                        <div class="mobile-hide">

                        </div>



                    </div>
                    <div class="col-md-9 http://ice-shop.su/assets/oplata-bar">


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
		<?if (empty($order->bill)) {?>
		                  
<center><div class="layer">
<div class="panel">
  <div class="panel-heading">
    <h2 class="panel-title"> Сессия устарела</h2>
  </div>
 <br>
 <br>
  <div class="panel-body">
<div style="background-color:orange" onClick="window.open('/');" class="btn">На сайт</div>
</div> 
</div>
</div>
</center>		 

         <?} else {?>
         <? if ($_GET['check'] == '1' and $order->paid == 1) { ?>
<center style="width: 100%;text-align: center;height: inherit;border-radius: 0px;background-color: #4caf50;margin-top: 0px;padding: 10px;margin-left: 0px;color: #fff;text-transform: uppercase;"><i class="fa fa-check-circle"></i> ГОТОВО! ВЫ УСПЕШНО КУПИЛИ ТОВАР!</center>
	<br>
		          <center>
<div class="btn" style="width: inherit;display: table;text-align: center;height: inherit;bor;border-radius: 4px;background-color: #334239;margin-top: 10px;padding: 8px;color: #fff;">Наименование товара: <?= $_SESSION['form']['name']; ?></div>
<div class="btn" style="width: inherit;display: table;text-align: center;height: inherit;bor;border-radius: 4px;background-color: #334239;margin-top: 10px;padding: 8px;color: #fff;">Цена товара: <?= $_SESSION['form']['price']; ?> <? if ($order->fund == 'WMR') {?>Рублей<? }else{ ?><? } ?><? if ($order->fund == 'WMU') {?>Гривен<? }else{ ?><? } ?><? if ($order->fund == 'WMZ') {?>Долларов<? }else{ ?><? } ?><? if ($order->fund == 'YAD') {?>Рублей<? }else{ ?><? } ?><? if ($order->fund == 'QIWI') {?>Рублей<? }else{ ?><? } ?><? if ($order->fund == 'FREEKASSA') {?>Рублей<? }else{ ?><? } ?></div>
<div class="btn" style="width: inherit;display: table;text-align: center;height: inherit;bor;border-radius: 4px;background-color: #334239;margin-top: 10px;padding: 8px;color: #fff;">Кол-во купленного товара: <?= $_SESSION['form']['count']; ?> шт.</div>
<div class="btn" style="width: inherit;display: table;text-align: center;height: inherit;bor;border-radius: 4px;background-color: #334239;margin-top: 10px;padding: 8px;color: #fff;">Способ оплаты: <? if ($order->fund == 'WMR') {?>WebMoney Рубли<? }else{ ?><? } ?><? if ($order->fund == 'WMU') {?>WebMoney Гривны<? }else{ ?><? } ?><? if ($order->fund == 'WMZ') {?>WebMoney Доллары<? }else{ ?><? } ?><? if ($order->fund == 'YAD') {?>Yandex Money<? }else{ ?><? } ?><? if ($order->fund == 'QIWI') {?>QIWI<? }else{ ?><? } ?><? if ($order->fund == 'FREEKASSA') {?>Free-Kassa<? }else{ ?><? } ?></div>
<div class="btn" style="width: inherit;display: table;text-align: center;height: inherit;bor;border-radius: 4px;background-color: #334239;margin-top: 10px;padding: 8px;color: #fff;">Примечание товара: <?= $_SESSION['form']['bill']; ?></div>     
			 <div onClick="window.open('<?= $_SESSION['form']['check_url']; ?>?ajax=f');" class="btn" style="width: inherit;text-align: center;height: 35px;bor;border-radius: 4px;background-color: #2ecc71;margin-top: 10px;padding: 8px;color: #fff;cursor: pointer;"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Скачать</div>
				  </center>
         <?} elseif ($order->paid == 0) {?>
                <center>
					<center style="width: 100%;text-align: center;height: inherit;border-radius: 0px;background-color: #4caf50;margin-top: 0px;padding: 10px;margin-left: 0px;color: #fff;text-transform: uppercase;"><i class="fa fa-check-circle"></i> ПОДТВЕРЖДЕНИЕ ОПЛАТЫ</center>
	<br>
	<div style="background-color: #F6F6F6;height: 400px;width: 100%;border-radius: 2px;margin-top: -10px;">
	<br>
				 <form action="">
                     <!--		<form role="form">    --> 

                        <?if (empty($_SESSION['form']['buy_button'])) {?>
						<div style="height: 41px;">        
								<p><h5 style="font-size: 18px;margin-top: 5px;margin-left: -55%;">Цена:</h5>
                                 <input style="width: 115px;text-align: center;height: 35px;border-radius: 0px;font-size: 18px;margin-top: -35px;" type="text" class="form-control" value="<?=$order->price;?>" onclick="this.select()" required="" readonly ></p>
							  </div>
							  <div style="height: 41px;">        
							  <p><h5 style="font-size: 18px;margin-top: 5px;margin-left: -55%;">Примечание:</h5>
                                 <input style="width: 180px;text-align: center;height: 35px;border-radius: 0px;font-size: 18px;margin-top: -36px;" type="text" class="form-control" value="<?=$order->bill;?>" onclick="this.select()" required="" readonly ></p>
								</div>
								<div style="height: 41px;">        
								<p><h5 style="font-size: 18px;margin-top: 5px;margin-left: -55%;"><?= $order->fund; ?> Кошелёк:</h5> 
                                 <input style="width: 180px;text-align: center;height: 35px;border-radius: 0px;font-size: 18px;margin-top: -35px;" type="text" class="form-control" value="<?=$_SESSION['fund'];?>" onclick="this.select()" required="" readonly ></p>
                      </div>
					  <? if ($order->fund == 'QIWI') {?>
<a class="block-receipt-buy o-hvr" target="_blank" href="https://qiwi.com/payment/form.action?provider=99&amp;amountInteger=<?=$order->price;?>&amp;amountFraction=0&amp;extra%5B%27account%27%5D=%2B<?=$_SESSION['fund'];?>&amp;extra%5B%27comment%27%5D=<?=$order->bill;?>" style="style=&quot;width: 200px;text-align:center;height: 35px;border-radius: 5px;&quot;;display: inline-block;color: #fff;text-decoration: none;font-size: 14px;font-weight: bold;text-transform: uppercase;padding: 20px 10px;background: #ffa834;text-align: center;border-radius: 3px;position: relative;height: inherit;width: inherit;cursor: pointer;border: 0px solid #ffffff;"> Оплатить быстро через QIWI</a>
					  <? }else{ ?>
						 <? } ?>
						 
						 <? if ($order->fund == 'YAD') {?>
<a class="block-receipt-buy o-hvr" target="_blank" href="https://money.yandex.ru/direct-payment.xml?FormComment=<?=$order->bill;?>&p2payment=1&receiver=<?=$_SESSION['fund'];?>&secureparam5=5&destination=<?=$order->bill;?>&successURL=http://ice-shop.su&shop-host=ice-shop.su&sum=<?=$order->price;?>&label=1508833&ShowCaseID=3007&quickpay-form=donate&short-dest=<?=$order->bill;?>&scid=767&quickpay-back-url=http://ice-shop.su" style="style=&quot;width: 200px;text-align:center;height: 35px;border-radius: 5px;&quot;;display: inline-block;color: #fff;text-decoration: none;font-size: 14px;font-weight: bold;text-transform: uppercase;padding: 20px 10px;background: #ffd633;text-align: center;border-radius: 3px;position: relative;height: inherit;width: inherit;cursor: pointer;border: 0px solid #ffffff;"> Оплатить быстро через YANDEX MONEY</a>					
						<? }else{ ?>
						 
						 <? } ?>
					  <? if ($order->fund == 'WMR' or $order->fund == 'WMZ' or $order->fund == 'WMU') {?>
<a class="block-receipt-buy o-hvr" target="_blank" href="wmk:payto?Purse=<?=$_SESSION['fund'];?>&amp;Amount=<?=$order->price;?>&amp;Desc=<?=$order->bill;?>&amp;BringToFront=Y" style="style=&quot;width: 200px;text-align:center;height: 35px;border-radius: 5px;&quot;;display: inline-block;color: #fff;text-decoration: none;font-size: 14px;font-weight: bold;text-transform: uppercase;padding: 20px 10px;background: #036cb5;text-align: center;border-radius: 3px;position: relative;height: inherit;width: inherit;cursor: pointer;border: 0px solid #ffffff;"> Оплатить быстро через WEBMONEY</a>
					  <? }else{ ?>
						 
						 <? } ?>
						 					 <p style="padding: 0px;"></p>
						<button type="button" onClick="checkpay('<?=$_SESSION['form']['check_url']; ?>')" class="btn" style="style=&quot;width: 200px;text-align:center;height: 35px;border-radius: 5px;&quot;;display: inline-block;color: #fff;text-decoration: none;font-size: 14px;font-weight: bold;text-transform: uppercase;padding: 20px 10px;background: #f10545;text-align: center;border-radius: 3px;position: relative;height: 57px;width: 195px;cursor: pointer;border: 0px solid #ffffff;"><i class="fa fa-refresh" aria-hidden="true"></i> Проверить платёж</button> 
						<div style=" width: 100px;text-align: center;height: 35px;border-radius: 3px;background-color: #596d61;margin-top: 5px;padding: 8px;color: #fff; cursor: pointer;" onClick="document.location.href = '/oplata/cash/<?=$order->item_id;?>';">← Назад</div>
						</form>
						<div>
						</center>	
						<? } else { header("Location: ".$_SESSION['form']['buy_button'].""); } } else { ?> 		    
      <?  header('Location: ?check=1'); } ?>
				  <style>
				  fieldset {display: none;}
				  </style>
		 <? } ?>
         <script>
         function checkpay(url)
         {
		 document.getElementById('loadImg').style.display = 'block';
		 
         $.get(url, function(data) {
         var res = JSON.parse(data);
		 document.getElementById('loadImg').style.display = 'none';
         if(res.status == "ok")
         {window.location.reload("/oplata?check=1");
	      }else{
		  swal("Ошибка!", 'Платеж не найден! Попробуйте позже.', "error")}
		  });
         }
		 
      </script>  
	  
	  
	  
	  
	  <style>
.module-head {
    display: none;
}
.item-view {
    background: url(/templates/0/img/bgts.jpg)no-repeat;
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