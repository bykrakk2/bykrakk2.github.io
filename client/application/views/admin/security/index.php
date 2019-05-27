<? echo validation_errors(); ?>
<? echo form_open_multipart(); ?>
<? if(isset($error)) {echo $error;}elseif(isset($ok)) {echo '<div class="alert alert-success">Данные успешно сохранены!</div>';}?>
<section class="content">
<div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Настройки профиля</h3>
        </div>
        <div class="box-body">
<table class="table">
	<tr>
		<td>Введите текущий пароль:</td>
		<td><? echo form_input('old_password', set_value('old_password'),'class="form-control"'); ?></td>
	</tr>
		<tr>
		<td>Введите новый пароль:</td>
		<td><? echo form_input('password', set_value('password'),'class="form-control"'); ?></td>
	</tr>
		<tr>
		<td>Повторите новый пароль:</td>
		<td><? echo form_input('password1', set_value('password1'),'class="form-control"'); ?></td>
	</tr>
		
		<tr>
		<td></td>
		<td><? echo form_submit('submit','Сохранить','value="upload" class="btn btn-primary"'); ?></td>
	</tr>
</table>
	  
        </div>
      </div>  
</section>	  
<section class="content">
<div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Настройки авторизации через соц сети</h3>
        </div>
        <div class="box-body">

 <p>Авторизация c помощью ВКонтакте :</p>
     <? $id = user('vk_id'); if (empty($id)) {?><a class="btn  btn-info"  href="https://oauth.vk.com/authorize?client_id=6118214&redirect_uri=http://<?=$_SERVER['HTTP_HOST']?>/admin/security&scope=offline&display=popup&response_type=code&v=5.52">Авторизация VK</a><? } else { ?>Вы используете аккаунт с id <?=user('vk_id');?> . <a href="/admin/security/vk_exit">Выход</a><? } ?>
  
        </div>
      </div>  
</section>	
<? echo form_close(); ?> 
