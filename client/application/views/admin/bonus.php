<section class="content-header">
      <h1>
        Бонусы
      </h1>
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
                header("Location: /admin/bonus");
	} ?>
  <? echo validation_errors(); ?>
  <? echo form_open_multipart(); ?></h3>
  <? if (1 == $this->session->userdata('group')):?>
<table class="table">
  <tr>
		<td bgcolor="#FFFFFF" style="color: #333333;font-size:14px;"><b>Рефералы:</b></td>
	<td bgcolor="#FFFFFF"></td>
  </tr>
  <tr>
		<td bgcolor="#FFFFFF" style="color: #000">Процент начисления от товара:</td>
		<td bgcolor="#FFFFFF"><? echo form_input('referal_procent', set_value('referal_procent', $this->config->item('referal_procent')),'class="form-control"'); ?></td>
  </tr>
  <tr bgcolor="#000000">
		<td bgcolor="#FFFFFF"></td>
		<td bgcolor="#FFFFFF"><? echo form_submit('submit','Сохранить','value="upload" class="btn btn-primary"'); ?></td>
	</tr>
  </table>
          </div>
      </div>
</section>	 
<?else:?>
<div style="font-size:14px;">К сожалению у Вас нет доступа в этот раздел</div>
<? endif; ?>




<p><span class="table"></span><? echo form_close(); ?>
  
  
  
  <style>
.spoiler >  input + .box {
    display: none;
}
.spoiler >  input:checked + .box {
    display: block;
}
  </style>
</p>

