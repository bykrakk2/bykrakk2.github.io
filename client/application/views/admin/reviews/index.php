<section class="content-header">
   <h1>
      Отзывы
   </h1>
   <a href="/reviews" class="btn btn-info" style=" float: right; margin-top: -26px; ">На страницу отзывов</a>
</section>
<section class="content">
   <div class="box box-warning">
      <div class="box-header with-border">
         <h3 class="box-title">Все отзывы</h3>
         <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
         </div>
         <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
         <table class="table table-hover tblsort table-striped table-responsive">
	<thead>
               <tr>
                  <th>Автор</th>
                  <th>Содержимое</th>
				  <th>Примечание</th>
                  <th>Дата</th>
                  <th>Удалить</th>
               </tr>
	</thead>
            <tbody>
<?php
$this->load->model('reviews_model');
?>
<? echo validation_errors(); ?>
<? echo form_open(); ?>
<? echo form_close(); ?>
        <? if(count($reviews)): foreach($reviews as $reviews): ?>
		<tr <? if($reviews->status == 1) {echo 'style="background: rgba(178, 255, 209, 0.36)"';}else{ echo 'style="background: #F1BFBF;color: #4E4E4E;"';} ?>>
			<td><? echo $reviews->title; ?></td>
			<td><? echo $reviews->body; ?></td>
			<td><? echo $reviews->bill; ?></td>
			<td style="width: 14%;"><? echo $reviews->slug; ?></td>
                  <td>
                     <a type="button" href="/admin/reviews/delete/<?=$reviews->id; ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-container="body" title="" data-original-title="Удалить"><i class="fa fa-trash-o"></i>
                     </a>
                  </td>
               </tr>
<? endforeach; ?>
<? else: ?>
	<tr>
		<td>Отзывов нет</td>
	</tr>
<? endif; ?>
            </tbody>
         </table>
      </div>
   </div>
</section>
<style>
.layout-boxed .wrapper {
    max-width: 100%;
    margin: -20px auto;
    min-height: 80%;
    box-shadow: 0 0 8px rgba(0,0,0,0.5);
    position: relative;
}
</style>