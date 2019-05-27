<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><? echo empty($news->id) ? 'Добавление новости' : 'Редактирование новости: ' . $news->name; ?></h3></div>
	<? echo validation_errors(); ?>
<? echo form_open(); ?>
<? 
$date = date('Y.m.d');
$time = date('H:i:s');

?>
<div class="panel-body">

<? echo validation_errors(); ?>
<? echo form_open(); ?>
<table style="margin-top:10px;"class="table">
	<tr>
		<td>Название новости:</td>
		<td><? echo form_input('name', set_value('name', $news->name),'class="form-control"'); ?></td>
	</tr>
	<tr>
		<td>Текст:</td>
		<td><? echo form_textarea('text', set_value('text', $news->text), 'class="tinymce"'); ?></td>
	</tr>
	<tr style="display:none;">
		<td>Дата:</td>
		<td><? echo form_input('date', set_value('date', $date), 'class="tinymce"'); ?></td>
	</tr>
	<tr style="display:none;">
		<td>Время:</td>
		<td><? echo form_input('time', set_value('time', $time), 'class="tinymce"'); ?></td>
	</tr>
	<tr>
		<td><? echo form_submit('submit','Сохранить','class="btn btn-primary"'); ?></td>
	</tr>
</table>
<? echo form_close(); ?></div>
</div>