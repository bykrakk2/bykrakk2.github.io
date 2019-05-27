<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<? $query = mysql_query("SELECT * FROM `news` ORDER BY id DESC LIMIT 5");
while($news = mysql_fetch_array($query)) {
if($news['date'] == date('Y-m-d')) {
$data = 'Сегодня в';
}
else{
$data = $news['date'];
}
$times = substr($news['time'], 0,5);
echo '<div class="panel panel-default" style="border-color: #ddd;border: 1px solid #ddd;border-radius: 3px;">
<div class="panel-heading" style="border-radius: 3px 3px 0px 0px;padding: 10px 15px;border-bottom: 1px solid transparent; color: #333; background-color: #f5f5f5;border-color: #ddd;"> <b>'.mb_substr($news['name'], '0', '24').'</b></div>
<div class="panel-body" style="padding: 15px; background-color: #fff;">
<div class="row" style="margin-right: -15px; margin-left: 0px;">
'.mb_substr(strip_tags($news['text']), '0', '110').'
</div>
</div>
<div class="panel-footer" style="border-radius: 0px 0px 3px 3px; padding: 10px 15px; background-color: #f5f5f5; border-top: 1px solid #ddd;"><ul class="pagination pull-right" style="margin: 0px;float: right!important;"><li style="display: inline;"><a style="text-decoration: none;" href="/news/?id='.$news['id'].'" class="next"><span style="color: #666666;">Подробнее</span></a></li></ul><div class="datatime228" style=""><i class="ace-icon fa fa-calendar"></i> Добавлено: '.$data.'  '.$times.'</div></div>
</div>';
}
?>
