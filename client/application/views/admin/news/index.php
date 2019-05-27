<section class="content-header">
   <h1>
      Новости
   </h1>
   <!-- Modals info -->
   <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Информация</h4>
      </div>
      <div class="modal-body">
+ Вывод на странице, только 10 последних новстей.<br>
+ Для перехода в ностости <? echo $_SERVER['HTTP_HOST'] ; ?>/news_all<br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>
<!-- Modals info -->
<a data-toggle="modal" data-target="#myModal" style="float: right;margin-top: -26px;" class="btn btn-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></a>
   <a href="/admin/news/edit" class="btn btn-info" style=" float: right; margin-top: -26px; ">Добавить новость</a>
</section>
<section class="content">
   <div class="box box-warning">
      <div class="box-header with-border">
         <h3 class="box-title">Все новости</h3>
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
                  <th>Дата создания</th>
                  <th>Время создания</th>
                  <th>Изменить</th>
                  <th>Удалить</th>
               </tr>
	</thead>
            <tbody>
               <? if(count($news)): foreach($news as $new): ?>
               <tr id="item-<? echo $new->id; ?>">
                  <td>
                     <? echo $new->id; ?>                    
                  </td>
                  <td>
                     <? echo $new->name; ?>                           
                  </td>
                  <td>
                     <? echo $new->date; ?>                             
                  </td>
                  <td>
                     <? echo $new->time; ?>                
                  </td>
                  <td>
                     <a type="button" href="/admin/news/edit/<?=$new->id; ?>" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="" data-original-title="Редактировать"><i class="fa fa-pencil"></i>
                     </a>
                  </td>
                  <td>
                     <a type="button" href="/admin/news/delete/<?=$new->id; ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-container="body" title="" data-original-title="Удалить"><i class="fa fa-trash-o"></i>
                     </a>
                  </td>
               </tr>
               <? endforeach; ?>
               <? else: ?>
               <tr>
                  <td>Новости отсутствуют</td> 
               </tr>
               <? endif; ?>
            </tbody>
         </table>
      </div>
   </div>
</section>