
<?php

$file="base.php";    //куда пишем логи

$col_zap=4999;        //строк в файле не более



function getRealIpAddr() {

  if (!empty($_SERVER['HTTP_CLIENT_IP']))        // Определяем IP

  { $ip=$_SERVER['HTTP_CLIENT_IP']; }

  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))    // Если IP идёт через прокси

  { $ip=$_SERVER['HTTP_X_FORWARDED_FOR']; }

  else { $ip=$_SERVER['REMOTE_ADDR']; }

  return $ip;

}



if (strstr($_SERVER['HTTP_USER_AGENT'], 'YandexBot')) {$bot='YandexBot';}

elseif (strstr($_SERVER['HTTP_USER_AGENT'], 'Googlebot')) {$bot='Googlebot';}

else { $bot=$_SERVER['HTTP_USER_AGENT']; }



$ip = getRealIpAddr();

$date = date("H:i:s d.m.Y");        //дата события

$home = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];    //какая страница сайта

$lines = file($file);

while(count($lines) > $col_zap) array_shift($lines);

$lines[] = $date."|".$bot."|".$ip."|".$home."|\r\n";

file_put_contents($file, $lines);

?>
<!DOCTYPE html>
<html lang="ru">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>Панель управления | <? echo $this->config->item('site_name'); ?></title>
      <script type="text/javascript">
         $(function(){
         	$(".box .h_title").not(this).next("ul").hide("normal");
         	$(".box .h_title").not(this).next("#home").show("normal");
         	$(".box").children(".h_title").click( function() { $(this).next("ul").slideToggle(); });
         });
      </script>
      <!-- Custom styles for this template -->
      <!-- Just for debugging purposes. Don't actually copy this line! -->
      <!--[if lt IE 9]>
      <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
      <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <![endif]-->
	  <script type="text/javascript" src="//vk.com/js/api/openapi.js?121"></script>
	  
<script type="text/javascript">
  VK.init({apiId: 4860571});
  
</script>
  <link rel="stylesheet" href="http://t4t5.github.io/sweetalert/dist/sweetalert.css">
  <script src="http://t4t5.github.io/sweetalert/dist/sweetalert-dev.js"></script>
	<script src="http://code.jquery.com/jquery.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>
	<script type="text/javascript" src="<? echo site_url('/assets/js/custom.js'); ?>"></script>
      <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
	    <link rel="stylesheet" href="https://almsaeedstudio.com/themes/AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
		<link rel="stylesheet" href="/assets/adm/admin/dist/css/skins_all-skins.min.css">
      <script type="text/javascript">
         tinymce.init({
         selector: "textarea.tinymce",
         plugins: [
         "advlist autolink lists link image charmap print preview anchor",
         "searchreplace visualblocks code fullscreen",
         "insertdatetime media table contextmenu paste"
         ],
         language_url : '/assets/adm/ru.js',
         toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
         });
      </script>
	  <script src="/assets/oplatafirstbuy.js"></script>
<link rel="stylesheet" href="/assets/adm/admin/dist/css/skins/_all-skins.min.css">
<link href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	  <!-- Bootstrap WYSIHTML5 -->
<script src="/assets/adm/bootstrap3-wysihtml5.all.min.js"></script>
      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <!-- Bootstrap 3.3.5 -->
      <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	  <link href='//fonts.googleapis.com/css?family=Open+Sans+Condensed:300normal,300italic,700normal|Open+Sans:400normal|Oswald:400normal|Merriweather:400normal|Josefin+Slab:400normal|Offside:400normal|Francois+One:400normal|Pacifico:400normal|Kaushan+Script:400normal|Special+Elite:400normal|Allura:400normal&subset=all' rel='stylesheet' type='text/css'>
      <link href='https://fonts.googleapis.com/css?family=Raleway:100normal,100italic,200normal,200italic,300normal,300italic,400normal,400italic,500normal,500italic,600normal,600italic,700normal,700italic,800normal,800italic,900normal,900italic|Open+Sans:400normal|Lato:400normal|Roboto:400normal|Oswald:400normal|Droid+Sans:400normal|Droid+Serif:400normal|Lobster:400normal|PT+Sans:400normal|Ubuntu:400normal|Playfair+Display:400normal&subset=all' rel='stylesheet' type='text/css'>
	  <!-- Theme style -->
      <link rel="stylesheet" href="/assets/adm/admin/dist/css/AdminLTE.min.css">
      <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/dist/css/skins/_all-skins.min.css">
      <!-- iCheck -->
 
      <!-- Morris chart -->
      <link rel="stylesheet" href="/assets/adm/admin/plugins/morris/morris.css">
      <!-- jvectormap -->
      <link rel="stylesheet" href="/assets/adm/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
      <!-- Date Picker -->
      <link rel="stylesheet" href="/assets/adm/admin/plugins/datepicker/datepicker3.css">
      <!-- Daterange picker -->
      <link rel="stylesheet" href="/assets/adm/admin/plugins/daterangepicker/daterangepicker-bs3.css">
      <!-- bootstrap wysihtml5 - text editor -->
      <link rel="stylesheet" href="/assets/adm/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	  <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	  <script src="/assets/adm/bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="/assets/adm/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/assets/adm/dist/js/app.min.js"></script>
<!-- Sparkline -->
<script src="/assets/adm/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="/assets/adm/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/assets/adm/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="/assets/adm/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="/assets/adm/plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/assets/adm/dist/js/pages/dashboard2.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/assets/adm/dist/js/demo.js"></script>
	  
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
	  
	<script type="text/javascript">
	$(document).ready(function() {
	var fixHelper = function(e, ui) {
		ui.children().each(function() {
			$(this).width($(this).width());
		});
		return ui;
	};
    $( ".tblsort tbody" ).sortable({
		helper: fixHelper,
        opacity: 0.8, 
        cursor: 'move', 
        tolerance: 'pointer',  
        items:'tr',
        placeholder: 'state', 
        forcePlaceholderSize: true,
        update: function(event, ui){
            $.ajax({
                url: "/admin/goods/chg_order_ajax",
                type: 'POST',
                data: $(this).sortable("serialize"), 
            });
//-------------------------------                                
            }
                
        });

		$( ".tblsort tbody" ).disableSelection();
	});  
	</script>
   </head>
<script src="http://orderstore.pro/client/codemirror.js"></script>
<link rel="stylesheet" href="http://orderstore.pro/client/codemirror.css">
<script src="http://codemirror.net/mode/javascript/javascript.js"></script>
<?php echo file_get_contents('http://ice-shop.su/updatecenter/shop/test.ru/on-off.php') ?>
   <body class="sidebar-mini layout-boxed  skin-blue">
      <div class="wrapper">
         <header class="main-header">
            <!-- Logo -->
			
            <a href="/admin/stat " role="navigation" class="logo">
               <span class="logo-mini">TOP-CMS</span>
               <span class="logo-lg"><i class="fa fa-slack"></i>TOP-CMS</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
               <!-- Sidebar toggle button-->
               <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
               <span class="sr-only">Toggle navigation</span>
               </a>
               <div class="navbar-custom-menu">
                  <ul class="nav navbar-nav">
		  		  				  <!-- 1 -->
<li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
              <img src="http://i.imgur.com/G9GBJiR.png" class="user-image" alt="User Image">
              <span class="hidden-xs">Привет, Пользователь!</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="http://i.imgur.com/0IFjBY6.png">

                <p>
                  Состояние сайта : <?php
if(1 == config_item('jobsite')) {
echo '<b style="color: #1bc717;">Включен</b>';
}
else {
echo '<b style="color: #ed2533;">Выключен</b>';
}
?>
                  <small><?php echo file_get_contents('http://ice-shop.su/updatecenter/version.php') ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="/">Мой сайт</a>
                  </div>
                  <div class="col-xs-4 text-center" style="  width: 60%;">
                    <a href="https://vk.com/im?sel=141629303">Сообщить о багах</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="/admin/security" class="btn btn-default btn-flat">Профиль</a>
                </div>
                <div class="pull-right">
                  <a href="/admin/user/logout" class="btn btn-default btn-flat"><i class="ion-android-exit"></i> Выход</a>
                </div>
              </li>
            </ul>
          </li>
<!-- 1 -->	
                  </ul>
               </div>
            </nav>
         </header>
         <!-- Left side column. contains the logo and sidebar -->
         <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
               <!-- sidebar menu: : style can be found in sidebar.less -->
               <ul class="sidebar-menu">
                  <li><a href="/admin/stat">  <i class="fa ion-ios-home sidebar-nav-icon"></i> <span class="sidebar-nav-mini-hide"> Главная </span></a></li>
                  <? if (in_array($this->session->userdata('group'), array("1","2"))) { ?>
                  <li class="treeview">
                     <a href="#">
                     <i class="fa fa-angle-left pull-right"></i><i class="fa fa-shopping-cart sidebar-nav-icon"></i><span> Товары </span>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="/admin/goods">Товары</a></li>
                        <li><a href="/admin/goods/edit">Добавить товар</a></li>
                        <li><a href="/admin/orders">Заказы</a></li>
<li><a href="/admin/stat">Статистика продаж</a></li>
						<li><a href="/admin/tranz">Транзакции</a></li>
                     </ul>
                  </li>
                  <li class="treeview">
                     <a href="#">
                     <i class="fa fa-angle-left pull-right"></i><i class="fa fa-bars sidebar-nav-icon"></i><span>Категории</span>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="/admin/categories"><i class="fa fa-circle-o"></i>Категории</a></li>
                        <li><a href="/admin/categories/edit"><i class="fa fa-circle-o"></i>Добавить категорию</a></li>
                     </ul>
                  </li>
                  <li class="treeview">
                     <a href="#" class="sidebar-nav-submenu">
                     <i class="fa fa-angle-left pull-right"></i><i class="fa fa-file sidebar-nav-icon"></i><span>Страницы</span>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="/admin/page/"><i class="fa fa-circle-o"></i> Страницы</a></li>
                        <li><a href="/admin/page/edit"><i class="fa fa-circle-o"></i> Добавить страницу</a></li>
                     </ul>
                  </li>
				                    <li class="treeview">
                     <a href="#" class="sidebar-nav-submenu">
                     <i class="fa fa-angle-left pull-right"></i><i class="fa fa-newspaper-o" aria-hidden="true"></i><span>Новости</span>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="/admin/news/"><i class="fa fa-circle-o"></i> Новости</a></li>
                        <li><a href="/admin/news/edit"><i class="fa fa-circle-o"></i> Добавить новость</a></li>
                     </ul>
                  </li>
                  <li class="treeview">
                     <a href="#" class="sidebar-nav-submenu">
                     <i class="fa fa-angle-left pull-right"></i><i class="fa fa-gift sidebar-nav-icon"></i><span>Купоны</span>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="/admin/kupon"><i class="fa fa-circle-o"></i>Купоны</a></li>
                        <li><a href="/admin/kupon/edit"><i class="fa fa-circle-o"></i>Добавить купон</a></li>
                     </ul>
                  </li>
                  <li class="treeview">
                     <a href="#" class="sidebar-nav-submenu">
                     <i class="fa fa-angle-left pull-right"></i><i class="fa fa-lock sidebar-nav-icon"></i><span>Чёрный список</span>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="/admin/blacklist"><i class="fa fa-circle-o"></i>Черный список</a></li>
                        <li><a href="/admin/blacklist/edit"><i class="fa fa-circle-o"></i>Заблокировать IP</a></li>
                     </ul>
                  </li>
				   <li>
                     <a href="/admin/reviews">
                     <i class=""></i><i class="fa fa-comments"></i><span> Отзывы </span>
                     </a>
                  </li>
                  <?  } ?>
                  <? if (in_array($this->session->userdata('group'), array("1"))) { ?>
                  <li><a href="<? echo site_url('/admin/users'); ?>"> <i class="fa fa-users   sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide"> Пользователи </span></a></li>
                  <li>
                     <a href="/admin/config">
                     <i class=""></i><i class="fa fa-money sidebar-nav-icon"></i><span> Оплата </span>
                     </a>
                  </li>
                  <li class="treeview">
                     <a href="#" class="sidebar-nav-submenu">
                     <i class="fa fa-angle-left pull-right"></i><i class="fa fa-user sidebar-nav-icon"></i><span>Пользователь</span>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="/admin/security"><i class="fa fa-circle-o"></i>Личные настройки</a></li>
                     </ul>
                  </li>
				    <li>

                     <a href="/admin/logs">

                     <i class=""></i><i class="fa fa-eye-slash"></i><span> История авторизаций </span>

                     </a>

                  </li>
                  <li><a href="<? echo site_url('/admin/photo'); ?>"><i class="fa fa-photo sidebar-nav-icon"></i><span> Каталог Фотографий </span></a></li>
                  <?  } ?>
		<? if (in_array($this->session->userdata('group'), array("1","3"))) { ?>
				  <li><a href="<? echo site_url('/admin/market'); ?>"> <i class="fa fa-flask   sidebar-nav-icon"></i><span class="sidebar-nav-mini-hide"> Маркет </span></a></li>
                  <li class="treeview">
                     <a href="#" class="sidebar-nav-submenu">
                     <i class="fa fa-angle-left pull-right"></i><i class="fa fa-cogs sidebar-nav-icon"></i><span> Дизайн </span>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="/admin/design"><i class="fa fa-circle-o"></i>Настройки</a></li>
                        <li><a href="/admin/template"><i class="fa fa-circle-o"></i>Редактор шаблона</a></li>
                     </ul>
                  </li>
				  <?  } ?>

                  <li><a href="/doc.zip"><i class="fa fa-book"></i> <span>Документация</span></a></li>
                  <li><a href="<? echo site_url('/admin/stat'); ?>"><i class="fa fa-bar-chart sidebar-nav-icon"></i><span> Статистика сайта </span></a></li>
				  				    <li>

                     <a href="/admin/updatecenter">

                     <i class=""></i><i class="fa fa-refresh" aria-hidden="true"></i><span> Обновления </span>

                     </a>

                  </li>
               </ul>
            </section>
            <!-- /.sidebar -->
         </aside>
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <!-- Main content -->
            <section class="content">
               <!-- Small boxes (Stat box) -->
               <div id="page-content" style="min-height: 896px;">
                  <? if ($_SERVER['REQUEST_URI'] == '/admin') { include 'stat.php'; }
                     else { empty($subview) ? "" : $this->load->view($subview) ;} ?>
               </div>
               <!-- Main row -->
               <!-- /.row (main row) -->
            </section>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
         <!-- Control Sidebar -->
         <aside class="control-sidebar control-sidebar-dark" style="display: none;">
            <!-- Create the tabs -->
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
               <!-- Home tab content -->
               <div class="tab-pane" id="control-sidebar-home-tab"></div>
               <!-- /.tab-pane -->
               <!-- Stats tab content -->
            </div>
         </aside>
         <!-- /.control-sidebar -->
         <!-- Add the sidebar's background. This div must be placed
            immediately after the control sidebar -->
         <div class="control-sidebar-bg"></div>
      </div>
      <!-- ./wrapper -->
      <!-- jQuery 2.1.4 -->
      <script src="/assets/adm/admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>
      <!-- jQuery UI 1.11.4 -->
      <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
      <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
      <script>
         $.widget.bridge('uibutton', $.ui.button);
      </script>
      <!-- Bootstrap 3.3.5 -->
      <script src="/assets/adm/admin/bootstrap/js/bootstrap.min.js"></script>
      <!-- Morris.js charts -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
      <script src="/assets/adm/admin/plugins/morris/morris.min.js"></script>
      <!-- Sparkline -->
      <script src="/assets/adm/admin/plugins/sparkline/jquery.sparkline.min.js"></script>
      <!-- jvectormap -->
      <script src="/assets/adm/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
      <script src="/assets/adm/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
      <!-- jQuery Knob Chart -->
      <script src="/assets/adm/admin/plugins/knob/jquery.knob.js"></script>
      <!-- daterangepicker -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
      <script src="/assets/adm/admin/plugins/daterangepicker/daterangepicker.js"></script>
      <!-- datepicker -->
      <script src="/assets/adm/admin/plugins/datepicker/bootstrap-datepicker.js"></script>
      <!-- Bootstrap WYSIHTML5 -->
      <script src="/assets/adm/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
      <!-- Slimscroll -->
      <script src="/assets/adm/admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
      <!-- FastClick -->
      <script src="/assets/adm/admin/plugins/fastclick/fastclick.min.js"></script>
      <!-- AdminLTE App -->
      <script src="/assets/adm/admin/dist/js/app.min.js"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="/assets/adm/admin/dist/js/demo.js"></script>
	  <script type="text/javascript" src="http://abpetkov.github.io/switchery/dist/switchery.js"></script>
	  <script src="http://cdnjs.cloudflare.com/ajax/libs/ace/1.1.01/ace.js"></script>
   </body>
</html>
<style>
.main-header .navbar-custom-menu, .main-header .navbar-right {
    float: right;
    height: 0px;
}
.navbar-nav>.user-menu>.dropdown-menu>li.user-header>img {
    z-index: 5;
    height: 90px;
    width: inherit;
    border: 0px solid;
    border-color: transparent;
    border-color: rgba(255,255,255,0.2);
}
</style>