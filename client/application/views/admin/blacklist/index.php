<? echo validation_errors(); ?>
<? echo form_open_multipart(); ?>
<section class="content-header">
   <h1>
      Чёрный список
   </h1>
   <a href="/admin/blacklist/edit" class="btn btn-info" style=" float: right; margin-top: -26px; ">Заблокировать ip</a>
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
         <table class="table table-hover table-striped table-responsive">
            <tbody>
               <tr>
		<th>ID</th>
		<th>IP адрес</th>
		<th>Редактировать</th>
		<th>Удалить</th>
               </tr>
               <? if(count($ips)): foreach($ips as $ip): ?>
               <tr>
			       <td>
                     <?=$ip->id; ?>                       
                  </td>
                  <td>
                     <?=$ip->ip; ?>                       
                  </td>
                  <td>
                     <a type="button" href="/admin/blacklist/edit/<?=$ip->id; ?>" class="btn btn-default btn-sm" data-toggle="tooltip" data-container="body" title="" data-original-title="Редактировать"><i class="fa fa-pencil"></i>
                     </a>
                  </td>
                  <td>
                     <a type="button" href="/admin/blacklist/delete/<?=$ip->id; ?>" class="btn btn-danger btn-sm" data-toggle="tooltip" data-container="body" title="" data-original-title="Удалить"><i class="fa fa-trash-o"></i>
                     </a>
                  </td>
               </tr>
               <? endforeach; ?>
               <? else: ?>
               <tr>
                  <td colspan="3">В данный момент нету заблокированных ip </td>
               </tr>
               <? endif; ?>
            </tbody>
         </table>
      </div>
   </div>
</section>
<? echo form_close(); ?> 
