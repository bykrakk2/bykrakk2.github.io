      <link rel="stylesheet" href="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" />
	  <script type="text/javascript" src="https://cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
	<script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker();
            });
        </script>
<section class="panel">
    <header class="panel-heading">
        <? echo empty($gift->id) ? 'Добавить рызгрыш' : 'Изменить рызгрыш: ' . $gift->title; ?> <span class="tools pull-right"><a href="javascript:;" class="fa fa-chevron-down"></a></span> </header>
    <div class="panel-body" style="display: block;">
        <? echo !empty($errors) ? $errors : "" ; ?>
        <? echo validation_errors(); ?>
        <? echo form_open_multipart();?>
        <table class="table">
            <tr>
                <td>Название:</td>
                <td>
                <? echo form_input( 'title', set_value( 'title', $gift->title),'class="form-control"'); ?></td>
            </tr>
            <tr>
                <td>Описание :</td>
                <td>
                <? echo form_textarea( 'descr', set_value( 'descr', $gift->descr),'id="textarea" class="textarea"'); ?></td>
            </tr>
            <tr>
                <td>Фото:</td>
                <td>
                <? echo form_input( 'photo', set_value( 'photo', $gift->photo),'class="form-control"'); ?></td>
            </tr>
            <tr>
                <td>Группа в вк:</td>
                <td>
                <? echo form_input( 'vk_group', set_value( 'vk_group', $gift->vk_group),'class="form-control"'); ?></td>
            </tr>
            <tr>
                <td>Время проведения:</td>
                <td>
				<div class='input-group date' id='datetimepicker1'>
                <? echo form_input( 'time', set_value( 'time', $gift->time),'class="form-control"'); ?>
				                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
					</div>
				</td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <? echo form_submit( 'submit', 'Сохранить', 'class="btn btn-primary"'); ?>
                </td>
            </tr>
        </table>
        <? echo form_close(); ?> </div>
    </div>
</section>