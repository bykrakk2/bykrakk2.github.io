<?php
$db_query_views = mysql_query("SELECT * FROM views LIMIT 1");
$db_views = mysql_fetch_assoc($db_query_views);
$vasip = $_SERVER['REMOTE_ADDR'];
?>
<?php
$all = mysql_query("SELECT SUM(price) as sum FROM `orders` WHERE paid = '1'");
$al = mysql_fetch_array($all);
?>
<?php
$all1 = mysql_query("SELECT SUM(price) as sum FROM `orders` WHERE paid = '1' AND date = '".date("j.n.Y")."'");
$als = mysql_fetch_array($all1);
?>
<?php
$tov = mysql_query("SELECT * FROM `goods`");
$tova = mysql_num_rows($tov);
?>
<?php
function payday($date)
{
$q = mysql_query("SELECT SUM(price) as sum FROM `orders` WHERE paid = '1' AND date = '".$date."'");
$q = mysql_fetch_array($q);
return $q['sum'] + 0;
}
?>

<section class="content-header">
<div class="btn btn-info" style="float: right;margin-top: -26px;background-color: #dd4b39;cursor: no-drop;"> Доход за сегодня: <b><?php echo $als['sum'] + 0; ?> ₽</b></div>
<a href="/admin/tranz" class="btn btn-info" style=" float: right; margin-top: -26px; ">Транзакции</a>
</section>
<section class="content">
   <div class="box box-warning">
      <div class="box-header with-border">
         <h3 class="box-title">Заказы</h3>
         <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
         </div>
         <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
<? echo $pagination; ?>
        <table class="table table-hover tblsort table-striped table-responsive" style="font-size: 13px;">
	<thead>
               <tr>
		<th>ID</th>
		<th>Примечание</th>
		<th>Дата</th>
		<th>Товар</th>
		<th style="min-width:70px;">Кол-во</th>
		<th>Цена</th>
		<th>E-mail</th>
		<th>Вк</th>
		<th style="display: ">Дополнительно</th>
		<th>Оплачен</th>
                <th>Скачать</th>
               </tr>
	</thead>
            <tbody>
              <? if(count($orders)): foreach($orders as $order): ?>
		          <tr>
                 			<td><? echo $order->id; ?></td>
			<td><? echo $order->bill; ?></td>
			<td style="font-size:11px;"><? echo $order->date; ?></td>
			<td style="font-size:11px;"><? echo $order->name; ?></td>
			<td><? echo $order->count; ?> шт.</td>
			<td><? echo $order->price.' '.$order->fund; ?></td>
			<td><? echo $order->email; ?></td>
			<td><? echo $order->vkpage; ?></td>
			<td style="display: "><? echo $order->adds; ?></td>
			<td><? echo $order->paid ? '<b style="color: #00a65a;font-size: 20px;"><i class="fa fa-fw fa-check"></i></b>' : '<b style="color: red;font-size: 20px;"><i class="fa fa-fw fa-times-circle-o"></i></b>' ?></center></td>
			<td><a title="Скачать купленный товар" href="/order/<? echo $order->bill; ?>?ajax=f" style="padding: 4px; color: #fff; border-radius: 3px; background-color: #ff9c00;">Скачать</span></td>
               </tr>
               <? endforeach; ?>
               <? else: ?>
               <tr>
                  <td>Заказов нет...</td> 
               </tr>
               <? endif; ?>
            </tbody>
         </table>
      </div>
   </div>
</section>
