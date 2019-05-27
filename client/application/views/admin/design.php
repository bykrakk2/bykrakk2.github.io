<section class="content-header">
      <h1>
        Настройки Дизайна
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
		 header("Location: /admin/design");
         }
         ?>
      <? echo validation_errors(); ?>
      <? echo form_open_multipart(); ?>
      <table class="table">
         <tr>
            <td>Оффлайн режим :</td>
            <td>
    <input class="tgl tgl-flat" name="jobsite" id="cb2" type="checkbox" <? if (config_item('jobsite') == 0){echo "checked";} ?>>
    <label class="tgl-btn" for="cb2"></label>
            </td>
         </tr>
        <tr>
		<td>Авторизация через ВКонтакте :</td>
		<td>
		<? echo form_dropdown('vk_active', array('0'=>'Включить','1'=>'Выключить'), $this->config->item('vk_active')); ?>
        <label class="tgl-btn" for="cbvk"></label><td>
	</tr> 
		    <tr>
            <td>Мои покупки :</td>
            <td>
<? echo form_dropdown('slide3', array('0'=>'Включить','1'=>'Выключить'), $this->config->item('slide3')); ?>
            </td>
         </tr> 
	 
         <tr>
            <td>Название сайта (Вывод {name}):</td>
            <td><? echo form_input('site_name', set_value('site_name', $this->config->item('site_name')),'class="form-control"'); ?></td>
         </tr>
         <tr>
            <td>Логотип сайта (Вывод {logo}):</td>
            <td><? echo form_input('site_flogo', set_value('site_flogo', $this->config->item('site_flogo')),'class="form-control"'); ?></td>
         </tr>
         <tr>
            <td>Favicon магазина URL PNG (Вывод {favicon}):</td>
            <td><? echo form_input('block_2', set_value('block_2', $this->config->item('block_2')),'class="form-control"'); ?></td>
         </tr>
         <tr>
            <td>Фон сайта (Вывод {bg}):</td>
            <td><? echo form_input('site_logo', set_value('site_logo', $this->config->item('site_logo')),'class="form-control"'); ?></td>
         </tr>
		 <tr>
            <td>Мои покупки / Оплата (Ссылка на отзывы):</td>
            <td><? echo form_input('slide1', set_value('slide1', $this->config->item('slide1')),'class="form-control"'); ?></td>
         </tr>
		 <tr>
            <td>Мои покупки / Оплата (Ссылка на контакты):</td>
            <td><? echo form_input('slide2', set_value('slide2', $this->config->item('slide2')),'class="form-control"'); ?></td>
         </tr>
         <tr>
            <td>Мета-описание сайта (Вывод {meta}):</td>
            <td><? echo form_textarea('metadescr', set_value('metadescr', $this->config->item('metadescr')),'class="form-control"'); ?></td>
         </tr>
         <tr>
            <td>Js скрипты и стили (Поле в head):</td>
            <td><? echo form_textarea('block_3', set_value('block_3', $this->config->item('block_3')),'class="form-control"'); ?></td>
         </tr>
         <tr>
            <td>Кол-во товаров на страницу:</td>
            <td><? echo form_input('ssb', set_value('ssb', $this->config->item('ssb')),'class="form-control"'); ?></td>
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
