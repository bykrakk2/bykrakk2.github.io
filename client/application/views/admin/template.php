<? if(isset($error)) { echo $error;}elseif(isset($ok)) {echo '<div class="alert alert-success">Данные успешно сохранены!</div>';

header("Location: /admin/template");} ?>

<section class="content">
   <div class="panel-body" style="display: block;">
      <div class="nav-tabs-custom">
         <ul id="myTab" class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Основное</a></li>
            <li class=""><a href="#tab_2" onclick="" data-toggle="tab" aria-expanded="false">Страница товара</a></li>
            <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Вид товара</a></li>
			<li class=""><a href="#tab_9" data-toggle="tab" aria-expanded="false">Вид страниц</a></li>
			<li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">Отзывы</a></li>

            <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
         </ul>

        <? echo validation_errors(); ?>
        <? echo form_open_multipart(); ?>
         <div class="tab-content">
            <div class="tab-pane active" id="tab_1"> <? echo form_textarea( 'main', set_value( 'main', $this->config->item('main')),'class="form-control uk-syntax-highlight" id="main"  rows="5"'); ?></div>
            <div class="tab-pane " id="tab_2"><? echo form_textarea( 'item', set_value( 'item', $this->config->item('item')),'class="form-control" id="item" rows="5"'); ?></div>
            <div class="tab-pane " id="tab_3"><? echo form_textarea( 'items', set_value( 'items', $this->config->item('items')),'class="form-control" id="codesnippet_editable"  rows="5"'); ?></div>
           <div class="tab-pane " id="tab_9"><? echo form_textarea( 'page', set_value( 'page', $this->config->item('page')),'class="form-control" id="page"  rows="5"'); ?></div>
		   <div class="tab-pane " id="tab_4"><? echo form_textarea( 'reviews', set_value( 'reviews', $this->config->item('reviews')),'class="form-control" id="reviews"  rows="5"'); ?></div>
         </div>
         <!-- /.tab-content -->
         <div class="content" style=" min-height: 1px;  " ><? echo form_submit( 'submit', 'Сохранить', 'value="upload" class="btn btn-primary"'); ?></div>
         <? echo form_close(); ?>

      </div>
   </div>
</section>
  <script>
  </script>
<style>
textarea.form-control {
    color: rgb(0, 24, 111);
    max-height: inherit;
    max-width: inherit;
    height: 100%;
}
body.sidebar-mini.layout-boxed.skin-blue {
    margin-top: -20px;
}
</style>