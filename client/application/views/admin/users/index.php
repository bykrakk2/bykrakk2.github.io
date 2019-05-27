<section class="content-header">
   <h1>
      Пользователи
   </h1>
   <a href="/admin/users/edit" class="btn btn-info" style=" float: right; margin-top: -26px; ">Добавить пользователя</a>
</section>
<section class="content">
<div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">Все пользователи</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
         <table class="table table-hover table-striped table-responsive">
            <tbody>
               <tr>
			      <th>id</th>
                  <th>Email</th>
                  <th>Изменить</th>
                  <th>Удалить</th>
               </tr>
               <? if(count($users)): foreach($users as $user): ?>
               <tr>
                  <td>
                     <?=$user->id; ?>                              
                  </td>
                  <td>
                     <?=$user->email; ?>                              
                  </td>
                  <td>
                     <a type="button" href="/admin/users/edit/<?=$user->id; ?>" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="" data-original-title="Редактировать"><i class="fa fa-pencil"></i>
                     </a>
                  </td>
                  <td>
                     <a type="button" href="/admin/users/delete/<?=$user->id; ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-container="body" title="" data-original-title="Удалить"><i class="fa fa-trash-o"></i>
                     </a>
                  </td>
               </tr>
               <? endforeach; ?>
               <? else: ?>
               <tr>
                  <td colspan="3">Пользователи отсутствуют</td>
               </tr>
               <? endif; ?>
            </tbody>
         </table>
                </div><!-- /.box-body -->
</div>

</section>