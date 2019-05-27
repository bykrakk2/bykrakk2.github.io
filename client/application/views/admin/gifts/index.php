<section class="content-header">
   <h1>
      Розыгрыши 
   </h1>
   <a href="/admin/gifts/edit" class="btn btn-info" style=" float: right; margin-top: -26px; ">Добавить</a>
</section>
<section class="content">
   <div class="box box-warning">
      <div class="box-header with-border">
         <h3 class="box-title">Все розыгрыши</h3>
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
                  <th>Название</th>
                  <th>Дата проведения</th>
                  <th>Редактировать</th>
                  <th>Удалить</th>
               </tr>
               <?if (count($gifts)):foreach ($gifts as $gift):?>
               <tr <?if ($gift->status == 1) {?> style=" background: rgba(221, 75, 57, 0.13); " <?} else {?> style=" background: rgba(0, 166, 90, 0.15); " <?}?> >
                  <td>
                     <span class="label label-primary"><?= $gift->id; ?>    </span>                   
                  </td>
                  <td>
                     <?= $gift->title; ?>                
                  </td>
                  <td>
                    <span class="label label-success"> <?= $gift->time; ?>  <i class="fa fa-clock-o"></i>    </span>                        
                  </td>
                  <td>
                     <a type="button" href="/admin/gifts/edit/<?= $gift->id; ?>" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="" data-original-title="Редактировать"><i class="fa fa-pencil"></i>
                     </a>
                  </td>
                  <td>
                     <a type="button" href="/admin/gifts/delete/<?= $gift->id; ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-container="body" title="" data-original-title="Удалить"><i class="fa fa-trash-o"></i>
                     </a>
                  </td>
               </tr>
               <?endforeach; ?>
               <?else:?>
               <tr>
                  <td colspan="3">Розыгрыши отсутствуют</td>
               </tr>
               <?endif; ?>
            </tbody>
         </table>
      </div>
   </div>
</section>