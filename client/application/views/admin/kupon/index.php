<section class="content-header">
   <h1>
      Купоны
   </h1>
   <a href="/admin/kupon/edit" class="btn btn-info" style=" float: right; margin-top: -26px; ">Добавить один</a><a href="/admin/kupon/edit_more" class="btn btn-info" style=" float: right; margin-top: -26px; ">Добавить несколько</a>
</section>
<section class="content">
   <div class="box box-warning">
      <div class="box-header with-border">
         <h3 class="box-title">Все купоны</h3>
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
		<th>Купон</th>
        <th>Скидка</th>
		<th>Исполь-ий</th>
		<th>ID товара</th>
		<th>Изменить</th>
		<th>Удалить</th>
               </tr>
<? if(count($kupons)): foreach($kupons as $kupon): ?>
               <tr>
                  <td>
                     <?=$kupon->id; ?>                       
                  </td>
                  <td>
                     <?=$kupon->kupon_name; ?>                
                  </td>
                  <td>
                      <?=$kupon->percentage; ?>  %                            
                  </td>
                  <td>
				  <?php if($kupon->pago == 0) {echo 'Бесконечно ';}else { echo $kupon->pago; } ?>                          
                  </td>
                  <td>
                      <?php if($kupon->goods == 0) {echo 'Все ';}else { echo $kupon->goods; } ?>                          
                  </td>
                  <td>
                     <a type="button" href="/admin/kupon/edit/<?=$kupon->id; ?>" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="" data-original-title="Редактировать"><i class="fa fa-pencil"></i>
                     </a>
                  </td>
                  <td>
                     <a type="button" href="/admin/kupon/delete/<?=$kupon->id; ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-container="body" title="" data-original-title="Удалить"><i class="fa fa-trash-o"></i>
                     </a>
                  </td>
               </tr>
               <? endforeach; ?>
               <? else: ?>
               <tr>
                  <td colspan="3">Вы ещё не создавали купонов!</td>
               </tr>
               <? endif; ?>
            </tbody>
         </table>
      </div>
   </div>
</section>