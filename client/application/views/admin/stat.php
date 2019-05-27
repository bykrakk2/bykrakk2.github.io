<style>
span#bank-eur {
    display: none;
}
span#bank-byr {
    display: none;
}
span#bank-uah {
    display: none;
}
span#bank-usd {
    display: none;
}
span#bank-kzt {
    display: none;
}
</style>
<?php 
 $content = get_content(); 
 $pattern = "#<Valute ID=\"([^\"]+)[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>[^>]+>([^<]+)[^>]+>[^>]+>([^<]+)#i"; 
 preg_match_all($pattern, $content, $out, PREG_SET_ORDER); 
 
 $usd = ""; 
 $eur = ""; 
 $byr = ""; 
 $uah = ""; 
 $kzt = ""; 

 foreach($out as $cur) 
 
 { 
   if($cur[2] == 840) $usd  = str_replace(",",".",$cur[4]); 
   if($cur[2] == 978) $eur   = str_replace(",",".",$cur[4]); 
   if($cur[2] == 974) $byr   = str_replace(",",".",$cur[4]); 
   if($cur[2] == 980) $uah   = str_replace(",",".",$cur[4]); 
   if($cur[2] == 398) $kzt   = str_replace(",",".",$cur[4]); 
 } 

 echo "<span id=\"bank-usd\">".$usd."</span> <span id=\"bank-eur\">".$eur."</span> <span id=\"bank-byr\">".$byr."</span> <span id=\"bank-uah\">".$uah."</span> <span id=\"bank-kzt\">".$kzt."</span>"; 
 
 function get_content() 

 { 
   $link = "http://www.cbr.ru/scripts/XML_daily.asp"; 
   $fd = fopen($link, "r"); 
   $text=""; 
   echo "";
   while (!feof ($fd)) $text .= fgets($fd, 4096); 
   fclose ($fd); 
   return $text; 
 }

?>
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
          ['Дата', 'Доход (руб)'],
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
	
	
	<div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa ion-ios-browsers-outline sidebar-nav-icon" style="margin-top: 20px;"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Товаров</span>
                  <span class="info-box-number"><?php echo $tova; ?> шт.<small></small></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa ion-ios-analytics-outline" style="margin-top: 20px;"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Общий доход</span>
                  <span class="info-box-number"><?php echo $al['sum'] + 0; ?> <i class="fa fa-rub"></i></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa ion-ios-time-outline" style="margin-top: 20px;"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">За сегодня</span>
                  <span class="info-box-number"><?php echo $als['sum'] + 0; ?> <i class="fa fa-rub"></i></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa ion-ios-monitor-outline" style="margin-top: 20px;"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Просмотров </span>
                  <span class="info-box-number"><?php echo $db_views['sviews'] + 0; ?></span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
            </div><!-- /.col -->
          </div>
		  
	<div class="box box-warning">
                <div class="box-header with-border">
                  <h3 class="box-title">График продаж</h3>
                  <div class="box-tools pull-right">
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                 <div id="chart_div"></div>
                </div><!-- /.box-body -->
				<!--Валюты-->
			<div class="box-footer">
              <div class="row">
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> В рублях</span>
                    <h5 class="description-header"><span id="rub"></span> ₽</h5>
                    <span class="description-text">За сегодня</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-yellow"><i class="fa fa-caret-left"></i> В гривнах</span>
                    <h5 class="description-header"><span id="uah"></span> ₴</h5>
                    <span class="description-text">За сегодня</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-green"><i class="fa fa-caret-up"></i> В долларах</span>
                    <h5 class="description-header"><span id="usd"></span> $</h5>
                    <span class="description-text">За сегодня</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-xs-6">
                  <div class="description-block">
                    <span class="description-percentage text-red"><i class="fa fa-caret-down"></i> В евро</span>
                    <h5 class="description-header"><span id="eur"></span> €</h5>
                    <span class="description-text">За сегодня </span>
                  </div>
                  <!-- /.description-block -->
                </div>
              </div>
              <!-- /.row -->
            </div>
			<!--Валюты-->
              </div>
			  
	
		  
 <div>
           
		  <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Статистика продаж</h3>
                  <div class="box-tools pull-right">
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
		     <section class="panel">
            <div>
  <table id="general-table" class="table table-striped table-bordered table-vcenter">
                <tbody>
                    <tr>
                        <th>ID</th>
                        <th>Название товара</th>
						<th>Кол-во в наличии</th>
						<th>Общий доход</th>
						<th>Доход за сегодня</th>
                    </tr>
                    <? $sql=mysql_query( "SELECT * FROM `goods`"); while ( $nw=mysql_fetch_array( $sql ) ) { ?>
                    <tr>
                        <td>
                           <span class="label label-default"> <?=$nw["id"];?></span>
                        </td>
                        <td>
                            <span class="label label-primary"><?=$nw["name"];?></span>
                        </td>
						 <td>
                          <center>  <span class="label label-success"><? 
			    $TITLE = $nw['name'];
				$HASH = preg_replace('/[^\p{L}\p{N}\s]/u','',md5(config_item('encryption_key').$TITLE));
				$uppath = './assets/uploads/'.preg_replace('/[^\p{L}\p{N}\s]/u','', md5(config_item('encryption_key').$HASH.$TITLE)).'/';
				$fl = file($uppath.$HASH);
				$count = count($fl);		
				echo $count;
							 ?></span></center>
                        </td>
						
                        <td>
							<center><span class="label label-info"><?php
$itemm = mysql_query("SELECT SUM(price) as sum FROM `orders` WHERE paid = '1' AND item_id	 = '".$nw["id"]."'");
$al1 = mysql_fetch_array($itemm);
?>
                           <?php echo $al1['sum'] + 0; ?> <i class="fa fa-rub"></i></span></center>
                        </td>
					                        <td>
							<?php
$itemm = mysql_query("SELECT SUM(price) as sum FROM `orders` WHERE paid = '1' AND item_id	 = '".$nw["id"]."' AND date = '".date("j.n.Y")."'");
$pays = mysql_fetch_array($itemm);
?>
                        <center>  <span class="label label-info"> <?php echo $pays['sum'] + 0; ?> <i class="fa fa-rub"></i></span></center>
                        </td>	

                    </tr>
                    <? } ?>
                </tbody>
            </table>
				
				

 </div>
            </div>
        </section>
		
		                </div><!-- /.box-body -->
              </div>
<script>
var rub = <?php echo $als['sum'] + 0; ?>;
var bankUSD = document.getElementById('bank-usd').innerText;
var bankEUR = document.getElementById('bank-eur').innerText;
var bankUAH = document.getElementById('bank-uah').innerText;

document.getElementById('rub').innerHTML = rub;
document.getElementById('usd').innerHTML = (rub/bankUSD).toFixed(2);
document.getElementById('eur').innerHTML = (rub/bankEUR).toFixed(2);
document.getElementById('uah').innerHTML = (10*rub/bankUAH).toFixed(2);
</script>