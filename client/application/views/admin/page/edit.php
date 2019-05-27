
  
  
     <section class="panel">
            <header class="panel-heading">
               <? echo empty($page->id) ? 'Добавить новую страницу' : 'Редактировать страницу: ' . $page->title; ?> <span class="tools pull-right"><a href="javascript:;" class="fa fa-chevron-down"></a></span> </header>
            <div class="panel-body" style="display: block;">
<? echo validation_errors(); ?>
<? echo form_open(); ?>
<table class="table">
	<tr>
		<td>Заголовок:</td>
		<td><? echo form_input('title', set_value('title', $page->title),'class="form-control"'); ?></td>
	</tr>
	<tr>
		<td>Сайт/page/названия:</td>
		<td><? echo form_input('slug', set_value('slug', $page->slug),'class="form-control"'); ?></td>
	</tr>
	<tr>
		<td>Текст:</td>
		<td><? echo form_textarea('body', set_value('body', $page->body), 'class="tinymce"'); ?></td>
	</tr>
	<tr>
		<td>Отключить основной каркас  : </td>
        <td>
            <input class="tgl tgl-flat" name="loader" id="cb5" type="checkbox" <? if ($page->loader == 1){echo "checked";} ?>>
            <label class="tgl-btn" for="cb5"></label>
       </td>
	</tr>
	<tr>
		<td>Шаблон страницы : </td>
        <td>
            <? echo form_textarea('tpl', set_value('tpl', $page->tpl),'class="form-control" rows="5"'); ?>
			<p>Используется , если отключён основной каркас . ({page_name} - название , {page_body} - текст)</p>
       </td>
	</tr>
	<tr>
		<td></td>
		<td><? echo form_submit('submit','Сохранить','class="btn btn-primary"'); ?></td>
	</tr>
</table>
<? echo form_close(); ?>  </div>
            </div>
        </section>