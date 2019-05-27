<?php
$db_query_views = mysql_query("SELECT * FROM views LIMIT 1");
$db_views = mysql_fetch_assoc($db_query_views);
$vasip = $_SERVER['REMOTE_ADDR'];
?>
<?php
$all = mysql_query("SELECT SUM(count) as sum FROM `orders` WHERE paid = '0'");
$al = mysql_fetch_array($all);
?>
<?php
$all1 = mysql_query("SELECT SUM(count) as sum FROM `orders` WHERE paid = '0' AND date = '".date("j.n.Y")."'");
$als = mysql_fetch_array($all1);
?>
<?php
$tov = mysql_query("SELECT * FROM `goods`");
$tova = mysql_num_rows($tov);
?>
<?php
function payday($date)
{
$q = mysql_query("SELECT SUM(count) as sum FROM `orders` WHERE paid = '0' AND date = '".$date."'");
$q = mysql_fetch_array($q);
return $q['sum'] + 0;
}
?>

  <script type="text/javascript"
          src="https://www.google.com/jsapi?autoload={
            'modules':[{
              'name':'visualization',
              'version':'1',
              'packages':['corechart']
            }]
          }"></script>

  <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Дата', 'Кол-во транзакций'],
		  ['<?=date("j.n.Y", strtotime("-7 day"));?>', <?=payday(date("j.n.Y", strtotime("-7 day")));?> ],
		  ['<?=date("j.n.Y", strtotime("-6 day"));?>',  <?=payday(date("j.n.Y", strtotime("-6 day")));?> ],
		  ['<?=date("j.n.Y", strtotime("-5 day"));?>',  <?=payday(date("j.n.Y", strtotime("-5 day")));?> ],
		  ['<?=date("j.n.Y", strtotime("-4 day"));?>',  <?=payday(date("j.n.Y", strtotime("-4 day")));?> ],
          ['<?=date("j.n.Y", strtotime("-3 day"));?>',  <?=payday(date("j.n.Y", strtotime("-3 day")));?> ],
          ['<?=date("j.n.Y", strtotime("-2 day"));?>',  <?=payday(date("j.n.Y", strtotime("-2 day")));?> ],
          ['<?=date("j.n.Y", strtotime("-1 day"));?>',  <?=payday(date("j.n.Y", strtotime("-1 day")));?> ],
          ['<?=date("j.n.Y");?>',  <?=payday(date("j.n.Y"));?>]
        ]);

        var options = {
          vAxis: {minValue: 0},
		  
		   legend: {position: 'none', maxLines: 3}
        };

       var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
	<div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">График транзакций</h3>
                  <div class="box-tools pull-right">
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                 <div id="chart_div"></div>
                </div><!-- /.box-body -->
              </div>
<section class="content-header">
</section>
<section class="content">
   <div class="box box-warning">
      <div class="box-header with-border">
         <h3 class="box-title">Транзакции</h3>
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
		<th>Примечание</th>
		<th style="width: 10%;">Дата</th>
		<th>Товар</th>
		<th style="width: 7%;">Кол-во</th>
		<th style="width: 10%;">Цена</th>
		<th>IP</th>
		<th>E-mail</th>
		<th>Оплачен</th>
               </tr>
	</thead>
            <tbody>
               <? if(count($orders)): foreach($orders as $order): ?>
		          <tr>
               			<td><? echo $order->id; ?></td>
			<td><? echo $order->bill; ?></td>
			<td style="font-size:11px;"><? echo $order->date; ?></td>
			<td style="font-size:11px;"><? echo $order->name; ?></td>
			<td><? echo $order->count; ?></td>
			<td><? echo $order->price.' '.$order->fund; ?></td>
			<td><? echo $order->ip_address; ?></td>
			<td><? echo $order->email; ?></td>
                  <td>
                     <? echo $order->paid ? '<b style="color: #00a65a;font-size: 20px;"><i class="fa fa-fw fa-check"></i></b>' : '<b style="color: red;font-size: 20px;"><i class="fa fa-fw fa-times-circle-o"></i></b>' ?>
                  </td>
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