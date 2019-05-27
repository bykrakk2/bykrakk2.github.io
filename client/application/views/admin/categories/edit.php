     <section class="panel">
            <header class="panel-heading">
                <? echo empty($categories->id) ? 'Добавить категорию' : 'Изменить категорию: ' . $categories->title; ?> <span class="tools pull-right"><a href="javascript:;" class="fa fa-chevron-down"></a></span> </header>
            <div class="panel-body" style="display: block;">




<? echo !empty($errors) ? $errors : "" ; ?>
<? echo validation_errors(); ?>
<? echo form_open_multipart();?>
<table class="table table-hover">
	<tr>
		<td>Название:</td>
		<td><? echo form_input('title', set_value('title', $categories->title),'class="form-control"'); ?></td>
	</tr>
	<tr>
	<td>URL адрес:</td>
	<td><? echo form_input('slug', set_value('slug', $categories->slug),'class="form-control"'); ?></td>
	</tr>
		<tr>
		<td>Код картинки:</td>
		<td><? echo form_input('icon', set_value('icon', $categories->icon),'class="form-control"'); ?></td>
	</tr>
	<tr>
		<td>Порядок:</td>
		<td><? echo form_input('sort', set_value('sort', $categories->sort),'class="form-control" style="width:100px; text-align:center;"'); ?></td>
	</tr>
	<? 
	$list	=	array(
			'1' => 'Показывать',
			'0' => 'Не показывать',
			
			);
	?>
	<tr>
		<td></td>
		<td><?php echo form_dropdown('show', $list, $categories->show); ?></td>
	</tr>
	<tr>
		<td></td>
		<td><? echo form_submit('submit','Сохранить','class="btn btn-primary"'); ?></td>
	</tr>
</table>
<? echo form_close(); ?>       </div>
            </div>
        </section>