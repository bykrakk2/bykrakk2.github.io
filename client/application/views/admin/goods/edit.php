<? echo !empty($errors) ? $errors : "" ; ?>
<? echo validation_errors(); ?>
<? echo form_open_multipart();?>
<?php 
   $list = array('0'=>'Без категории');
   foreach ($categories as $key => $value) 
   {
   	$list[$value->slug] = $value->title;
   }
    ?>
<script type="text/javascript">
   var num = 1; //чтобы знать с какой записи вытаскивать данные
   
      $(document).ready(function(){
         $("#imgLoad").hide();  //Скрываем прелоадер
      });
      
   $(function() {
         $("#bot").click(function(){ //Выполняем если по кнопке кликнули
         $("#imgLoad").show(); //Показываем прелоадер
   	  var search = $("#search").val();
         document.getElementById('load').style.display = '';
   	  $("#resSearch").html('');
         $.ajax({
                url: "/admin/goods/icon/?q="+search,
                type: "GET",
                data: {"num": num},
                cache: false,
                success: function(response){
   				if(response == 0){ // Смотрим ответ от сервера и выполняем соответствующее действие
   					$("#resSearch").append('Ошибка ! Мы не нашли картинки.');
   					$("#imgLoad").hide();
   				}else{
   					$("#resSearch").append(response);
                       num = num + 1;
                       $("#imgLoad").hide();
   				}
                 }
              });
          });
         $("#load").click(function(){ //Выполняем если по кнопке кликнули
         $("#imgLoad").show(); //Показываем прелоадер
   	  var search = $("#search").val();
         $.ajax({
                url: "/admin/goods/icon/?q="+search,
                type: "GET",
                data: {"num": num},
                cache: false,
                success: function(response){
   				if(response == 0){ // Смотрим ответ от сервера и выполняем соответствующее действие
   					$("#resSearch").append('Ошибка ! Мы не нашли картинки.');
   					$("#imgLoad").hide();
   				}else{
   					$("#resSearch").append(response);
                       num = num + 1;
                       $("#imgLoad").hide();
   				}
                 }
              });
          });
      });
</script>
<section class="content-header">
      <h1>
        <? echo empty($goods->id) ? 'Добавить товар' : 'Изменить товар: ' . $goods->name; ?>
      </h1>
    </section>

<section class="content">
<div class="row">
   <div class="col-md-6">
      <div class="box box-info">
         <div class="box-header">
            <h3 class="box-title">Основное</h3>
         </div>
         <div class="box-body">
            <!-- Date dd/mm/yyyy -->
            <div class="form-group">
               <label>Название товара:</label>
               <div class="input-group">
                  <div class="input-group-addon">
                     <i class="fa  fa-shopping-cart"></i>
                  </div>
                  <? echo form_input('name', set_value('name', $goods->name),'class="form-control"'); ?>
               </div>
               <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <!-- phone mask -->
            <div class="form-group">
               <label>Категория :</label>
               <div class="input-group" style="width: 100%;">
                  <?php echo form_dropdown('category', $list, $goods->category,'class="form-control select2" '); ?>
               </div>
               <!-- /.input group -->
            </div>
			    <div class="form-group">
		<label>Жанр:</label>
		               <div class="input-group" style="width: 100%;">
		<? echo form_input('janr', set_value('janr', $goods->janr),'class="form-control"'); ?>
		</div>
</div>
			    <div class="form-group">
		<label>Язык:</label>
		               <div class="input-group" style="width: 100%;">
		<? echo form_input('yazuk', set_value('yazuk', $goods->yazuk),'class="form-control"'); ?>
		</div>
</div>
			    <div class="form-group">
		<label>Платформа:</label>
		               <div class="input-group" style="width: 100%;">
		<? echo form_input('platforma', set_value('platforma', $goods->platforma),'class="form-control"'); ?>
		</div>
</div>
			    <div class="form-group">
		<label>Мультиплеер:</label>
		               <div class="input-group" style="width: 100%;">
				<? echo form_input('mylytplayeer', set_value('mylytplayeer', $goods->mylytplayeer),'class="form-control"'); ?>
		</div>
</div>
			    <div class="form-group">
		<label>Дата релиза:</label>
		               <div class="input-group" style="width: 100%;">
		<? echo form_input('relyz', set_value('relyz', $goods->relyz),'class="form-control"'); ?>
		</div>
</div>
			    <div class="form-group">
		<label>Издатель:</label>
		               <div class="input-group" style="width: 100%;">
		<? echo form_input('izdatel', set_value('izdatel', $goods->izdatel),'class="form-control"'); ?>
		</div>
</div>
			    <div class="form-group">
		<label>Активация:</label>
		               <div class="input-group" style="width: 100%;">
		<? echo form_dropdown('atkiv', array('Steam'=>'Steam','Origin'=>'Origin','Uplay'=>'Uplay','Battle.net'=>'Battle.net','PlayStation'=>'PlayStation','eveonline.com'=>'eveonline.com','ArenaNet'=>'ArenaNet','XBOX'=>'XBOX','TES online'=>'TES online','Social Club'=>'Social Club','Mojang'=>'Mojang','Wargaming.net'=>'Wargaming.net','GOG.com'=>'GOG.com'), $goods->atkiv); ?>
		</div>
</div>
            <!-- /.form group -->
            <!-- phone mask -->
            <div class="form-group">
               <label>Отображение на главной странице:</label>
               <div class="input-group">
				      <input class="tgl tgl-flat" name="onmain" id="cb2" type="checkbox" <? if ($goods->onmain == 1){echo "checked";} ?>>
                      <label class="tgl-btn" for="cb2"></label>
               </div>
               <!-- /.input group -->
            </div>
            <div class="form-group">
               <label>Скрыть товар при его отсутствии :</label>
               <div class="input-group">
				      <input class="tgl tgl-flat" name="del" id="cb3" type="checkbox" <? if ($goods->del == 1){echo "checked";} ?>>
                      <label class="tgl-btn" for="cb3"></label>
               </div>
               <!-- /.input group -->
            </div>
            <!-- /.form group -->
         </div>
         <!-- /.box-body -->
      </div>
      <div class="box box-info">
         <div class="box-header">
            <h3 class="box-title">Настройки товара</h3>
         </div>
         <div class="box-body">
            <div class="form-group">
               <label>Цена :</label>
               <div class="input-group">
                  <? echo form_input('price_rub', set_value('price_rub', $goods->price_rub),'class="form-control"'); ?>
				                    <div class="input-group-addon">
                     <i class="fa fa-rub"></i>
                  </div>
               </div>
               <!-- /.input group -->
            </div>
            <div class="form-group">
               <label>Тип товара:</label>
               <div class="input-group" style="width: 100%;">
                  <? echo form_dropdown('type_Item', array('0'=>'Обычный','2'=>'Распродажа'), $goods->type_Item,'class="form-control select2"'); ?>
               </div>
               <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <!-- phone mask -->
            <div class="form-group">
               <label>Скидка на товар:</label>
               <div class="input-group">
                  <? echo form_input('skidka', set_value('skidka', $goods->skidka),'class="form-control"'); ?>
				                    <div class="input-group-addon">
                    <i class="fa fa-percent"></i>
                  </div>
               </div>
               <!-- /.input group -->
            </div>
            <div class="form-group">
               <label>Мин. кол-во для заказа:</label>
               <div class="input-group">
                  <? echo form_input('min_order', set_value('min_order', $goods->min_order),'class="form-control"'); ?>
				                    <div class="input-group-addon">
                     <i class="fa fa-download"></i>
                  </div>
               </div>
               <!-- /.input group -->
            </div>
            <div style="display: none;">
               <td>Метод продажи:</td>
               <td>
                  <div class="btn-group" data-toggle="buttons" data-toggle-name="sell_method">
                     <label data-id="0" class="btn btn-primary <? echo $goods->sell_method == 0 ? 'active' : ''?>">
                     <input type="radio">Строки
                     </label>
                     <label data-id="1" class="btn btn-primary <? echo $goods->sell_method == 1 ? 'active' : ''?>">
                     <input type="radio">Файл
                     </label>
                  </div>
                  <? echo form_hidden('sell_method', set_value('sell_method', $goods->sell_method)); ?>
               </td>
            </div>
            <div class="form-group">
               <label>Товар (строки):</label>
               <div class="input-group" style="width: 100%;">
                  <tr class="goodtype">
                     <? if($goods->sell_method == 0) : ?>
                     <? echo form_textarea('goods', set_value('goods', $goods->goods),'class="form-control"'); ?>
                     <? elseif($goods->sell_method == 1): ?>
                     <td>Товар (файл):</br>
                        <span class="label label-success"><? echo $goods->goods;?></span>
                     </td>
                     <td><input type="file" name="userfile" size="20" class="form-control"/></td>
                     <? endif; ?>
                  </tr>
               </div>
               <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <!-- phone mask -->
            <!-- /.form group -->
         </div>
         <!-- /.box-body -->
      </div>
	 
		
	  
   </div>
   <div class="col-md-6">
      <div class="box box-info">
         <div class="box-header">
            <h3 class="box-title">Данные о товаре</h3>
         </div>
         <div class="box-body">
            <div class="form-group">
               <label>Изображение товара URL:</label>
               <div class="input-group">
                  <div class="input-group-addon">
                     <i class="fa fa-picture-o"></i>
                  </div>
                  <? echo form_input('iconurl', set_value('iconurl', $goods->iconurl),'class="form-control" id="iconurl" '); ?>
                  <div class="input-group-addon">
                     <a data-toggle="modal" data-target="#lib"><i class="fa fa-search"></i></a>
                  </div>
               </div>
               <!-- /.input group -->
            </div>
            <div class="form-group">
               <label>Описание:</label>
               <div class="input-group" style=" width: 100%; ">
                  <? echo form_textarea('descr', set_value('descr', $goods->descr),'id="textarea" class="tinymce" style=" width: 100%; "'); ?>
               </div>
               <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <!-- phone mask -->
            <div class="form-group">
               <label>Краткое описание :</label>
               <div class="input-group" style=" width: 100%; ">
                  <? echo form_textarea('info', set_value('info', $goods->info),'id="textarea" class="tinymce" style=" width: 100%; "'); ?>
               </div>
               <!-- /.input group -->
            </div>
            <!-- /.form group -->
            <!-- phone mask -->
            <!-- /.form group -->
         </div>
         <!-- /.box-body -->
      </div>
	  	<div class="col-md-3" style="width: 100%; margin-left: -3%;">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Информация!</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
              <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            1 строка приравнивается к 1 штуке<br>
			10 строк = 10 штук в наличии<br>
			100 строк = 100 штук в наличии<br>
			1000 строк = 1000 штук в наличии и так далее<br>
			<b>После продажи строки автоматически удаляются в том количестве сколько было указано покупателем перед оплатой.</b>
			<br>
			<hr class="after-nav">
			<b>Как продавать товар в большом количестве (пачками) или как продавать товар файлами?</b>
										<br>
										1) Загружаем файл в любое файловое хранилище, например <a href="https://disk.yandex.ru" target="_blank" style="color: #b73232;">disk.yandex.ru</a><br>
										2) Получаем ссылку на загруженный Вами файл, пример <img class="img-responsive" src="http://i.imgur.com/R5jhHgq.png"><br>
										Вставляем нашу полученную ссылку в пункте 2 в строки<br>
										1 строка = 1 штука =  1 ссылка = 1 файл который покупатель получит после оплаты<br>
										
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
   </div>
   
      <div class="col-md-12">
	  <div class="box box-solid">
            <!-- /.box-header -->
            <div class="box-body">
              <? echo form_submit('submit','Сохранить','class="btn btn-info btn-block btn-flat"'); ?>
            </div>
            <!-- /.box-body -->
          </div>
	  
	  </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Выбор изображения</h4>
         </div>
         <div class="modal-body">
            <div class='row'>
               <?php
                  $handle = opendir( "./assets/user/");
                  
                  while ( $file = readdir ($handle) ) //юзаем директорию с картинками
                  {
                  
                      @$temp = GetImageSize ($file); // Считывание параметров изображения
                      
                      if (preg_match('/\.png$/i',$file))     {
                  		$t1 = '"iconurl"';
                  		$t2 = '"/assets/user/'.$file.'"';
                  		
                      echo "
                  
                  	
                  <div style=' width: 169px;  display: inline-block;  margin: 16px 12px; ' class='panel panel-success'>
                  
                  <img style=' width: 100%; height: 136px;'style=' width: 100px; height: 100px;'  src='/assets/user/$file'>
                  <a data-dismiss='modal'  href='javascript://' onclick='document.getElementById(".$t1.").value=".$t2."' role='button' style=' width: 100%; margin-top: 0px; border-radius: 0; margin-left: 0px;' class='btn btn-primary btn-lg'>Выбор</a>
                  
                    
                   </div>
                  
                    
                  	";
                      $counter = 0;
                      }
                  }
                  ?>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="lib" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title" id="myModalLabel">Библиотека изображений</h4>
         </div>
         <div class="modal-body">
            <form action="" method="get" name="form" class="sidebar-form" onsubmit="return false;">
               <div class="callout callout-info">
                  <div class="input-group">
                     <input type="text" name="search" id="search" class="form-control" placeholder="Введите запрос для поиска">
                     <span class="input-group-btn">
                     <input style=" background: #3c8dbc; " type="button" name="search" id="bot" value='Поиск' class="btn btn-flat">
                     </input>
                     </span>
                  </div>
                  <p>Поисковой запрос вводите на английском языке.</p>
               </div>
            </form>
            <div id="resSearch">Начните вводить запрос</div>
            <div class="progress active" id="imgLoad">
               <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
               </div>
            </div>
            <button id="load" type="button" style="display:none" class="btn btn-default btn-block">Загрузить еще</button>
         </div>
      </div>
   </div>
</div>
</section>
<? echo form_close(); ?>

<style>
select {
    width: 100%;
    border-color: #d2d6de;
    height: 34px;
}
</style>