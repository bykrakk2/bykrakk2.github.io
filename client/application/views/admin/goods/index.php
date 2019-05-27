<section class="content-header">
   <h1>
      Товары
   </h1>
   <a href="/admin/goods/edit" class="btn btn-info" style=" float: right; margin-top: -26px; ">Добавить</a>
</section>
<section class="content">
   <div class="box box-warning">
      <div class="box-header with-border">
         <h3 class="box-title">Все товары</h3>
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
                  <th>ID</th>
                  <th>Название</th>
                  <th>Кол-во</th>
                  <th>Цена</th>
                  <th>Скидка</th>
                  <th>Изменить</th>
                  <th>Удалить</th>
               </tr>
	</thead>
            <tbody>
               <? if(count($goods)): foreach($goods as $good): ?>
               <tr id="item-<? echo $good->id; ?>">
                  <td>
                     <?=$good->id; ?>                       
                  </td>
                  <td>
                     <?=$good->name; ?>                           
                  </td>
                  <td>
                     <?=$good->count; ?>                             
                  </td>
                  <td>
                     <? echo $good->price_rub * $good->min_order ?> <i class="fa fa-rub"></i> за  <?=$good->min_order ?>  строк                 
                  </td>
				  <td>
                     <?=$good->skidka; ?> <i class="fa fa-percent"></i>             
                  </td>
                  <td>
                     <a type="button" href="/admin/goods/edit/<?=$good->id; ?>" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="" data-original-title="Редактировать"><i class="fa fa-pencil"></i>
                     </a>
                  </td>
                  <td>
                     <a type="button" href="/admin/goods/delete/<?=$good->id; ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-container="body" title="" data-original-title="Удалить"><i class="fa fa-trash-o"></i>
                     </a>
                  </td>
               </tr>
               <? endforeach; ?>
               <? else: ?>
               <tr>
                  <td>Создайте первый магазин</td> 
               </tr>
               <? endif; ?>
            </tbody>
         </table>
      </div>
   </div>
</section>