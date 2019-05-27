
<section class="content-header">
   <h1>
      Категории
   </h1>
   <a href="/admin/categories/edit" class="btn btn-info" style=" float: right; margin-top: -26px; ">Добавить</a>
</section>
<section class="content">
   <div class="box box-warning">
      <div class="box-header with-border">
         <h3 class="box-title">Все Категории</h3>
         <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
         </div>
         <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
         <table class="table table-hover table-striped table-responsive">
            <tbody>
               <tr>
			<th>ID</th>
			<th>Порядок</th>
			<th>Название</th>
			<th>Редактировать</th>
			<th>Удалить</th>
               </tr>
<? if(count($categories)): foreach($categories as $category): ?>
               <tr>
                  <td>
                     <?=$category->id; ?>                       
                  </td>
                  <td>
                     <?=$category->sort; ?>                
                  </td>
                  <td>
                      <?=$category->title; ?>                              
                  </td>
                  <td>
                     <a type="button" href="/admin/categories/edit/<?=$category->id; ?>" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="" data-original-title="Редактировать"><i class="fa fa-pencil"></i>
                     </a>
                  </td>
                  <td>
                     <a type="button" href="/admin/categories/delete/<?=$category->id; ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-container="body" title="" data-original-title="Удалить"><i class="fa fa-trash-o"></i>
                     </a>
                  </td>
               </tr>
               <? endforeach; ?>
               <? else: ?>
               <tr>
                  <td colspan="3">Категории отсутствуют</td>
               </tr>
               <? endif; ?>
            </tbody>
         </table>
      </div>
   </div>
</section>