<?php
error_reporting(E_NONE); //Setting this to E_ALL showed that that cause of not redirecting were few blank lines added in some php files.

	function DelDir($dir)   
	{  
		//если не открыть директорию  
		if (!$dd = opendir($dir)) return false;  
		  
		//читаем директорию в цикле  
		while (false !== ($obj = readdir($dd)))  
		{  
			//пропускаем системные каталоги  
			if($obj=='.' || $obj=='..') continue;  
			  
			//пробуем удалить объект, если это не удается, то применяем функцию к этому объекту вновь 
			if (!@unlink($dir.'/'.$obj)) DelDir($dir.'/'.$obj);  
		}  
		closedir($dd);  
		  
			//удаляем пустую директорию  
			@rmdir($dir);  
	}
$db_config_path = '../configs/config/database.php';
// Only load the classes in case the user submitted the form
if($_POST) {

	// Load the classes and create the new objects
	require_once('includes/core_class.php');
	require_once('includes/database_class.php');

	$core = new Core();
	$database = new Database();


	// Validate the post data
	if($core->validate_post($_POST) == true)
	{

		// First create the database, then create tables, then write config file
		if($database->create_database($_POST) == false) {
			$message = $core->show_message('error',"Не удалось создать базу данных!");
		} else if ($database->create_tables($_POST) == false) {
			$message = $core->show_message('error',"Не удалось создать таблицы в базе данных!");
		} else if ($core->write_config($_POST) == false) {
			$message = $core->show_message('error',"Файл конфигурации БД не можеть быть записан, убедитесь что chmod configs/config/database.php равен 777");
		} else if ($core->write_scconf($_POST) == false) {
			$message = $core->show_message('error',"Файл конфигурации скрипта не можеть быть записан, убедитесь что chmod configs/config/config.php равен 777");
		}

		// If no errors, redirect to registration page
		if(!isset($message)) {
			$redir = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
			$redir .= "://".$_SERVER['HTTP_HOST'];
			$redir .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
			$redir = str_replace('install/','',$redir); 
			deldir('../install/');
			echo "<script>
			alert('Вы будете перемещены на страницу входа в админ-панель. \\r\\n\\ После входа, обязательно настройте скрипт в соотвествующем разделе!');
			window.location.href='".$redir."/admin/';
			</script>";;
			}

	}
	else {
		$message = $core->show_message('error','Все поля обязательны к заполнению!');
	}
}
?>
<html style="height: auto; min-height: 100%;"><head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Установка | TOP-CMS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="skin-blue sidebar-mini" style="height: auto; min-height: 100%;">

<!-- heder -->
<header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>T</b>CM</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>TOP-</b>CMS</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">

        </ul>
      </div>
    </nav>
  </header>
<!-- heder -->
<section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Важно</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <strong><i class="fa fa-book margin-r-5"></i> Документация</strong>

              <p class="text-muted">
                Все инструкци будут доступны в админ-панели.
              </p>

              <hr>

              <strong><i class="fa fa-pencil margin-r-5"></i> Обязательно</strong>

              <p>
                <span class="label label-danger">ionCube PHP Loader</span>
                <span class="label label-info">MySql</span>
                <span class="label label-warning">PHP 5.6</span>
              </p>

              <hr>

              <strong><i class="fa fa-file-text-o margin-r-5"></i> Связь</strong>

              <p>Данные для связи вы можете найти на вкладке "Контакты".</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">Установка</a></li>
              <li class=""><a href="#timeline" data-toggle="tab" aria-expanded="false">Информация</a></li>
              <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">Контакты</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="activity">
                <!-- Установка -->
				  			<?php if(isset($message)) {echo '<div class="alert alert-danger">' . $message . '</div>';}	?>
				  <form id="install_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <h4>Настройки для базы данных:</h4>
				  <div class="input-group">
                <span class="input-group-addon">@</span>
                <input type="text" class="form-control" placeholder="localhost" id="hostname" name="hostname">
              </div>
			  <br>
			 	<div class="input-group">
                <span class="input-group-addon">@</span>
                <input type="text" class="form-control" placeholder="Имя базы данных" id="database" name="database">
              </div> 
			  <br>
			  	<div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                <input type="text" class="form-control" placeholder="Логин" id="username" name="username">
              </div> 
			  <br>
			  	<div class="input-group">
                <span class="input-group-addon"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
                <input type="password" class="form-control" placeholder="Пароль" id="password" name="password">
              </div> 
				  <h4>Настройка данных для входа в админ панель:</h4>
				  <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="txt" class="form-control" placeholder="E-mail (для входа в админ-панель)" id="useremail" name="useremail">
              </div>
			  <br>
			   <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
                <input type="password" class="form-control" placeholder="Пароль (для входа в админ-панель)" id="userpass" name="userpass">
              </div>
			  <h4>Ключ активации:</h4>
			  <div class="input-group input-group-sm">
                <input type="text" class="form-control">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat">Активировать!</button>
                    </span>
              </div>
			  <div class="box-footer" style=" margin-top: 15px;">
			  <input type="submit" class="btn btn-block btn-primary btn-lg" value="Установить" id="submit" style="width: 25%">
    </div>
				  </form>
                <!-- /.Установка -->
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <!-- Информация -->
    <h3>&#65279;<p style=" margin-top: -20px; height: 10px;">Версия сайта: 1.0.0 NEW</p></h3>
<hr>
	<li><b>АДРЕС ВАШЕГО САЙТА</b>: <u><font color="#0000dd"></font></u><? echo $_SERVER['HTTP_HOST'] ; ?></li>
	<li><b>Требуемая версия PHP: </b> <font color="red"> 5.6 </font></li>
	<li><b>ionCube PHP Loader: </b> <font color="red"> Требуется </font></li>
<!-- Информация -->
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="settings">
			   <!-- /.Контакты -->
			 <ul style="background: #ececee; border: 0px; font-size: 14px; margin: 0px; padding: 0px; outline: none; vertical-align: baseline; list-style: none; color: #383838; font-family: Calibri, tahoma; text-align: -webkit-center; box-sizing: border-box; line-height: normal;">
<li style="background: transparent; border: 0px; margin: 0px 0px 16px; padding: 0px; outline: none; vertical-align: baseline; box-sizing: border-box; list-style: none;"><span class="c1" style="background: transparent; border: 0px; margin: 0px; padding: 0px; outline: none; vertical-align: baseline; box-sizing: border-box; color: #3fa100;">•</span>&nbsp;Максимальное время ответа Тех.Поддержки – 24 часа. В случае форс.мажорных обстоятельств - 72 часа.</li>
<li style="background: transparent; border: 0px; margin: 0px 0px 16px; padding: 0px; outline: none; vertical-align: baseline; box-sizing: border-box; list-style: none;"><span class="c1" style="background: transparent; border: 0px; margin: 0px; padding: 0px; outline: none; vertical-align: baseline; box-sizing: border-box; color: #3fa100;">•</span>&nbsp;Контакты, по которым принимаются заявки :</li>
</ul>
<p style="background: #ececee; border: 0px; font-size: 14px; margin: 10px 0px; padding: 0px; outline: none; vertical-align: baseline; color: #383838; text-align: -webkit-center; box-sizing: border-box; font-family: Calibri, sans-serif; line-height: 20px;"><img style="background: transparent; margin: 0px; padding: 0px; outline: none; vertical-align: middle; box-sizing: border-box; max-width: 100%;" src="http://ic.pics.livejournal.com/antidogmat/27278863/10605/10605_original.gif" alt="Наша электронная почта">&nbsp;<strong style="background: transparent; border: 0px; margin: 0px; padding: 0px; outline: 0px; vertical-align: baseline;">chery_78@mail.ru</strong></p>
<p style="background: #ececee; border: 0px; font-size: 14px; margin: 10px 0px; padding: 0px; outline: none; vertical-align: baseline; color: #383838; text-align: -webkit-center; box-sizing: border-box; font-family: Calibri, sans-serif; line-height: 20px;"><img style="background: transparent; border-width: initial; border-style: none; margin: 0px; padding: 0px; outline: 0px; vertical-align: baseline;" src="data:image/jpeg;base64,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" alt="" width="14" height="14"><span style="background: transparent; border: 0px; font-size: 18px; margin: 0px; padding: 0px; outline: none; vertical-align: baseline; box-sizing: border-box;">&nbsp;mrlale228</span></p>
<p style="background: #ececee; border: 0px; font-size: 14px; margin: 10px 0px; padding: 0px; outline: none; vertical-align: baseline; color: #383838; text-align: -webkit-center; box-sizing: border-box; font-family: Calibri, sans-serif; line-height: 20px;"><strong style="background: transparent; border: 0px; margin: 0px; padding: 0px; outline: none; vertical-align: baseline; box-sizing: border-box;"><img style="background: transparent; margin: 0px; padding: 0px; outline: none; vertical-align: middle; box-sizing: border-box; max-width: 100%; width: 16px; height: 16px;" src="http://cs405118.vk.me/v405118021/5fc0/OGUKbYgm_-I.jpg" alt="">&nbsp;&nbsp;</strong><span style="background: #f3f3f3; border: 0px; margin: 0px; padding: 0px; outline: 0px; vertical-align: baseline; font-family: Calibri, tahoma; line-height: normal;">&nbsp;</span><span style="background: transparent; border: 0px; margin: 0px; padding: 0px; outline: 0px; vertical-align: baseline; font-family: Calibri, tahoma; line-height: normal;">VK Support:&nbsp;</span><a href="https://vk.com/mr.lalka">https://vk.com/mr.lalka</a></p>
						 <!-- /.Контакты -->
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
	<!-- jQuery 3 -->
<script async="" src="//www.google-analytics.com/analytics.js" style="display: none !important;"></script><script src="https://adminlte.io/themes/AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="https://adminlte.io/themes/AdminLTE/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="https://adminlte.io/themes/AdminLTE/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="https://adminlte.io/themes/AdminLTE/dist/js/demo.js"></script>


<style>
body {
    font-family: 'Exo 2', sans-serif;
    background: #13181b url(https://orig12.deviantart.net/ef42/f/2015/341/d/6/flat_landscape__winter_edition__by_jovicasmileski-d9jbz70.jpg) no-repeat top center fixed;
    background-size: auto;
    margin: 0;
    padding: 0;
}
</style></body></html>