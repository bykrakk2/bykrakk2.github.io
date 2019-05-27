<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<? 
$query = mysql_query("SELECT * FROM `news` WHERE `id` = '".$_GET['id']."'");
$new = mysql_fetch_assoc($query);
?>

<div class="panel panel-default" style="border-color: #ddd;border: 1px solid #ddd;border-radius: 3px;">
<div class="panel-heading" style="border-radius: 3px 3px 0px 0px;padding: 10px 15px;border-bottom: 1px solid transparent; color: #333; background-color: #f5f5f5;border-color: #ddd;"> <b><? echo $new['name']; ?></b></div>
<div class="panel-body" style="padding: 15px; background-color: #fff;">
<div class="row" style="margin-right: -15px; margin-left: 0px;">
<? echo $new['text']; ?>
</div>
</div>
<div class="panel-footer" style="border-radius: 0px 0px 3px 3px; padding: 10px 15px; background-color: #f5f5f5; border-top: 1px solid #ddd;"><ul class="pagination pull-right" style="margin: 0px;float: right!important;"><li style="display: inline;"><a style="text-decoration: none;" href="/news_all/" class="next"><span style="color: #666666;">Назад</span></a></li></ul><div class="datatime228" style="margin-top: 3%;"></div></div>
</div>
