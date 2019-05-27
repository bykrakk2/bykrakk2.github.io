<? $list	=	array('1' => 'Администратор','2' => 'Модератор','3' => 'Дизайнер');?>
<section class="content-header">
   <h1>
      Пользователи
   </h1>
   <a href="/admin/users/edit" class="btn btn-info" style=" float: right; margin-top: -26px; ">Добавить пользователя</a>
</section>
<section class="content"> 
   <div class="box box-warning">
      <div class="box-header with-border">
         <h3 class="box-title"><? echo empty($users->id) ? 'Добавить пользователя' : 'Изменить пользователя: '; ?> </h3>
         <div class="box-tools pull-right">
            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
         </div>
         <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
         <? echo !empty($errors) ? $errors : "" ; ?> 
         <? echo validation_errors(); ?>
         <? echo form_open_multipart();?>
         <table class="table table-hover">
            <tr>
               <td>Email:</td>
               <td><? echo form_input('email', set_value('email', $users->email),'class="form-control"'); ?></td>
            </tr>
            <tr>
               <td>Пароль :</td>
               <td><? echo form_input('password', set_value('password', $users->password),' type="password" class="form-control"'); ?></td>
            </tr>
            <tr>
               <td>Группа : </td>
               <td><?php echo form_dropdown('group', $list, $users->group); ?> <a data-toggle="modal" data-target="#myModal" style=" float: right; " class="btn btn-danger" >Права</a></td>
            </tr>
            <tr>
               <td></td>
               <td><? echo form_submit('submit','Сохранить','class="btn btn-primary"'); ?></td>
            </tr>
         </table>
         <? echo form_close(); ?>  
      </div>
      <!-- /.box-body -->
   </div>
</section>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Права пользователей</h4>
      </div>
      <div class="modal-body">
<h4>Модераторы</h4><br>
+ Статистика продаж <br>
+ Купоны <br>
+ Страницы <br>
+ Управление категориями<br>
+ Чёрный список <br>
+ Управление товаром <br>
+ Управление купонами <br>
(не имеет доступа к профилям) <br>
<hr>
<h4>Дизайнер</h4> <br>
+ Редактор шаблона <br>
+ Настройки дизайна <br>
+ Маркет <br>
(не имеет доступа к профилям) <br>
<hr>
<h4> Администраторы</h4> <br>
+ Все разделы<br>
(Имеет доступ к профилям)<br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
      </div>
    </div>
  </div>
</div>