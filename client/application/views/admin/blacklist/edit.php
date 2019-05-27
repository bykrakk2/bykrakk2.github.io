<section class="content-header">
   <h1>
      Заблокировать IP
   </h1>
   <a href="/admin/blacklist" class="btn btn-info" style=" float: right; margin-top: -26px; ">Назад</a>
</section>
<section class="content">
<div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Общее</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
        <? if(isset($error)) {
         echo $error;
         }
         elseif(isset($ok)) {
         echo '<div class="alert alert-success">Данные успешно сохранены!</div>';
		 header("Location: /admin/design");
         }
         ?>
      <? echo validation_errors(); ?>
      <? echo form_open_multipart(); ?>
<table class="table">
	<? echo form_hidden('id', set_value('id', $ip->id),'class="form-control"'); ?>
	<tr>
		<td>IP-адрес:</td>
		<td><? echo form_input('ip', set_value('ip',$ip->ip),'class="form-control"'); ?></td>
	</tr>
	
		<tr>
		<td></td>
		<td><? echo form_submit('submit','Сохранить','value="upload" class="btn btn-primary"'); ?></td>
	</tr>
</table>
      <? echo form_close(); ?> 
        </div>
      </div>
</section>	  
