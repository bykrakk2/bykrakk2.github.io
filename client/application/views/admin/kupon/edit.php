

  
  <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><? echo empty($kupon->id) ? 'Создание купона' : 'Редактировать купон: ' . $kupon->kupon_name; ?></h3>
  </div>
<div class="panel-body">

<? echo validation_errors(); ?>
<? echo form_open(); ?>
<table style="margin-top:10px;"class="table">
	<tr>
		<td>Купон:</td>
		<td><? echo form_input('kupon_name', set_value('kupon_name', $kupon->kupon_name),'class="form-control"'); ?></td>
	</tr>
	<tr>
		<td>Процент скидки:</td>
		<td><? echo form_input('percentage', set_value('percentage', $kupon->percentage), 'class="form-control"'); ?></td>
	</tr>
	<tr>
		<td>Количество использований:<br>
		<div style="font-size:10px;">0 - бесконечное число использований</div></td>
		<td><? echo form_input('pago', set_value('pago', $kupon->pago), 'class="form-control"'); ?></td>
	</tr>
	<tr>
		<td>ID товара:<br>
		<div style="font-size:10px;">0 - для всех товаров</div></td>
		<td><? echo form_input('goods', set_value('goods', $kupon->goods), 'class="form-control"'); ?></td>
	</tr>
	<tr>
		<td></td>
		<td><? echo form_submit('submit','Сохранить','class="btn btn-primary"'); ?></td>
	</tr>
</table>
<? echo form_close(); ?></div>
</div>