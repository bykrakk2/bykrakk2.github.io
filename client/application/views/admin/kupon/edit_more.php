  <div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><? echo empty($kupon->id) ? 'Создание купона' : 'Редактировать купон: ' . $kupon->kupon_name; ?></h3>
  </div>
<div class="panel-body">
<? echo validation_errors(); ?>
<? echo form_open(); ?>
<table style="margin-top:10px;"class="table">
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
	<tr>
		<td>Слог купона:<br>
		<div style="font-size:10px;">Например: J-BUY</div></td>
		<td>
		<form method="POST" name="submit_more" style='display:block;' >
		<input type='text' class="form-control" name='slog' id="slog" value=''></td>
	</tr>
	<tr>
		<td>Количество купонов:<br>
		<div style="font-size:10px;">Максимально 20 за раз</div></td>

	<td><input type='text' class="form-control" name='colvo' id="colvo" value=''></td></form>
	</tr>
	<tr>
		<td></td>
		<td><? echo form_submit('submit_more','Создать','class="btn btn-primary"'); ?></td>
	</tr>
</table>
<? $procent = $_POST['percentage'];
   $used = $_POST['pago'];
   $id_good = $_POST['goods'];
   $kupon = $_POST['colvo'];
   $slog = $_POST['slog'];
   if(isset($_POST['submit_more'])) {
   if(20 >= $kupon) {
   for($i = 1; $i<=$kupon; $i++){ 
   $rand = ''.$slog.''.rand(1,100000).'';
 $query = mysql_query("INSERT INTO `kupons` (`kupon_name`,`pago`,`goods`,`percentage`) VALUES ('$rand','$used','$id_goods','$procent')");
 header('Location:/admin/kupon');
}  
}
else{
echo 'Нельзя создать больше 20-и купонов за раз';
}
   }

?>
<? echo form_close(); ?></div>
</div></div>