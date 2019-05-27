<? 
error_reporting(0);
if (config_item('slide3') == 0) {
?>
<html lang="ru"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Мои покупки - <?=config_item('site_name');?></title>

    <!-- Latest compiled and minified CSS
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.0/css/bootstrap-select.min.css"> -->

    <link rel="stylesheet" href="/assets/oplata/assets/landings/common/bootstrap-select/bootstrap-select.min.css">
    <link rel="stylesheet" href="/assets/oplata/assets/landings/common/paygate/css/bootstrap.cosmo.min.css">
    <link rel="stylesheet" href="/assets/oplata/assets/landings/common/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/assets/oplata/assets/landings/common/intl-tel-input-master/css/intlTelInput.css">
    <link rel="stylesheet" href="/assets/oplata/assets/landings/common/paygate/css/custom.css?v=12">


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
                <span>Мои покупки</span>
            </div>
            <div class="col-xs-6 text-right logo">
            </div>
        </div>

        <div class="panel panel-default paygate-panel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3 left-bar">

                        <div class="main-info">

                            

                            <h3>Ваш IP:</h3>
<blockquote class="description">

                                <small><?= $_SERVER['REMOTE_ADDR'] ?></small>
                            </blockquote>


                        </div>

                        <div class="mobile-hide">

                        </div>



                    </div>
                    <div class="col-md-9 right-bar">


                                               <!--- Основная --->
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
.paygate-panel {
    margin-top: -15px;
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
    background: url(/assets/oplata/img/carts_myorders.png);
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
.modal-open {
    overflow: auto;
}
</style>
											   	<center style="width: 100%;;text-align: center;height: inherit;border-radius: 0px;background-color: #4caf50;margin-top: 0px;padding: 10px;margin-left: 0px;color: #fff;text-transform: uppercase;"><i class="fa fa-check-circle"></i> ЗАПОЛНИТЕ ФОРМУ ДЛЯ ОТПРАВКИ ПИСЬМА</center>
											   <br>
											   <div style="background-color: #F6F6F6;height: inherit;width: 100%;border-radius: 0px;margin-top: -10px;">
						                        <form method="post" action="/myorders" style=" padding: 10px;">
   <input type="text" style="width:200px"  placeholder="Введите e-mail" class="form-control" name="email">
   <input type="submit" class="btn btn-primary btn-xs" value="Отправить" style=" height: 43px; margin-left: 205px; margin-top: -43px;">
</form>
				  </div>
				  <br>
				  
				  <?= $info;if (empty($orders)) {} else { ?>
			
<center style="width: 100%;;text-align: center;height: inherit;border-radius: 0px;background-color: #4caf50;margin-top: 0px;padding: 10px;margin-left: 0px;color: #fff;text-transform: uppercase;"><i class="fa fa-check-circle"></i> ВАШИ ПОКУПКИ</center>
      <?if ($orders):foreach ($orders as $order):?>
		<div class="order-view"><a href="/order/<?=$order->bill;?>" style="color: #000;"><input id="radio1" name="curr" type="hidden" value="Товар можно скачать нажав на него"><div class="lcol icon"> <b class="icn webmoney"></b></div><div class="lcol text"></b> <strong>Товар: <?=$order->name;?> <span style="color:red;">Цена: <?=$order->price;?> Руб</span>.</strong></div></a></div>     
	 <?endforeach;?>
      <?else:?>
         Товары отсутствуют
      <?endif;?>

<?}?>
<!--- Основная --->

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

    <script src="/assets/oplata/assets/landings/common/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="/assets/oplata/assets/landings/common/imgloaded/imagesloaded.pkgd.min.js"></script>
    <script src="/assets/oplata/assets/landings/common/intl-tel-input-master/js/intlTelInput.js"></script>
    <script src="/assets/oplata/assets/landings/common/isotope/isotope.pkgd.min.js"></script>
    <script src="/assets/oplata/assets/landings/common/paygate/js/custom.js?v=12"></script>


</body></html>
<?
} else { 
}
?>