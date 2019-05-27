
<?php
if (isset($_GET[col])) $col=$_GET[col];
else $col=50;
$file=file("base.php"); ?>

<html>
<head>
<style type='text/css'>
 td.zz {PADDING-LEFT: 3px; FONT-SIZE: 9pt; PADDING-TOP: 2px; FONT-FAMILY: Arial; }
</style>
</head>

<body>
<section class="content-header">
   <h1>
      История авторизаций
   </h1>
   <?php
   if (isset($_GET['p'])) {               #Проверяем существует ли переменная (p)
    if ($_GET['p'] == 'del') {         #Создаем адрес в виде (p=del)
        $file = 'base.php';            #Заносим имя файла в переменную

        unlink($file);                 #Удаляем архив
        header("location: /admin/logs"); #Переходим на главную страницу
    }
}
?>
<a type="button" value="Удалить" onclick="if(confirm('Вы действительно хотите очистить историю авторизаций?'))location.href='logs/?p=del';" style="float: right;margin-top: -26px;height: 33px;" class="btn btn-danger">Очистить историю</a>
  <a class="btn btn-info" style="float: right;margin-top: -26px;height: 33px; "> <?php
if ($col>sizeof($file)) { $col=sizeof($file); }
echo "Последние <code><b>".$col."</b></code> посещений сайта"; ?></a>
</section>
<section class="content">
   <div class="box box-warning">
      <div class="box-header with-border">
         <h3 class="box-title">Список всех действий</h3>
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
 <th style="width: 110px;">Время, дата</th>
 <th>Кто и через что посещал</th>
 <th style="width: 90px;">IP, прокси</th>
 <th>Посещенный URL</th>
</tr>

<?php
   for ($si=sizeof($file)-1; $si+1>sizeof($file)-$col; $si--) {
   $string=explode("|",$file[$si]);
   $q1[$si]=$string[0]; // дата и время
   $q2[$si]=$string[1]; // имя бота
   $q3[$si]=$string[2]; // ip бота
   $q4[$si]=$string[3]; // адрес посещения
echo '<tr><td>'.$q1[$si].'</td>';
echo '<td>'.$q2[$si].'</td>';
echo '<td>'.$q3[$si].'</td>';
echo '<td>'.$q4[$si].'</td></tr>';
}
echo '</table>';
echo '<center><br>Просмотреть последние <a href=?col=100 style="background-color: #1e282c;padding: 5px; border-radius: 3px;color: #ddd;">100</a> <a href=?col=500 style="background-color: #1e282c;padding: 5px; border-radius: 3px;color: #ddd;">500</a>';
echo ' <a href=?col=1000 style="background-color: #1e282c;padding: 5px; border-radius: 3px;color: #ddd;">1000</a> посещений.';
echo '<br>';
echo '<br>Просмотреть <a href=?col='.sizeof($file).' style="background-color: #dd4b39;padding: 5px; border-radius: 3px;color: #ddd;">все посещения</a>.</center>';
echo '</body></html>';
?>
</div>
   </div>
</section>