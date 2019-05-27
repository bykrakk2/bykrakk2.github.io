<?php
$template = config_item('items');
$head = explode('[items]', $template);
$template = explode('[/items]', $head['1']); 
function search($query)
{
    $text  = '';
    $query = trim($query);
    $query = strip_tags($query);
    $query = mysql_real_escape_string($query);
    if (!empty($query)) {

            $result = mysql_query("SELECT * FROM `goods` WHERE `name` LIKE '%$query%' OR `info` LIKE '%$query%'");
            $end_result = '';
            if (mysql_num_rows($result) > 0) {
                while ($row = mysql_fetch_object($result)) {
                    $cat                     = mysql_query("SELECT * FROM categories where id =" . $row->category . "");
                    $c                       = mysql_fetch_array($b);
                    $cat                     = $c["title"];
					$template = config_item('items');
                    $head = explode('[items]', $template);
                    $template = explode('[/items]', $head['1']); 
                    if ($row->sell_method == 0) {
                        $filename = preg_replace('/[^\p{L}\p{N}\s]/u', '', md5(config_item('encryption_key') . $row->name));
                        $uppath   = './assets/uploads/' . preg_replace('/[^\p{L}\p{N}\s]/u', '', md5(config_item('encryption_key') . $filename . $row->name)) . '/';
                        $data     = file($uppath . $filename);
                        if (empty($data)) {
                            $row->count = '0';
                        } else {
                            $row->count = count($data);
                            $row->goods = "";
                        }
                    } elseif ($row->sell_method == 1) {
                        $row->count = 'Файл';
                        $row->goods = "";
                    }
                    if (round($row->price_final * 100) / 100 < 1) {
                        $sum = $row->price_final;
                    } else {
                        $sum = round($row->price_final * 100) / 100;
                    }
                    $end_result .= str_replace(array('{items_id}','{items_min}','{items_cat}','{items_count}','{items_name}','{items_skidka}','{items_icon}','{items_rub}','{items_url}','{items_info}','{items_full}','{items_janr}','{items_yazuk}','{items_platforma}','{items_mylytplayeer}','{items_relyz}','{items_izdatel}','{items_atkiv}','<?','?>','[no-items]','[/no-items]','[items]','[/items]'), array($row->id,$row->min_order,$cat,$row->count,$row->name,$row->skidka,$row->iconurl,$sum,base_url("item/" . $row->id),$row->info,$row->descr,'<!--','-->','<!--','-->','',''), $template['0']);
                }
                $text = $end_result;
            } else {
                $text = '<p style="text-align: center;"><strong><span style="font-size: large;">По вашему запросу ничего не найдено!</span></strong></p><p style="text-align: center;"><strong><span style="font-size: large;"><br /></span></strong></p>';
            }
        
    } else {
        $text = '<p style="text-align: center;"><strong><span style="font-size: large;">Задан пустой поисковый запрос.</span></strong></p><p style="text-align: center;"><strong><span style="font-size: large;"><br /></span></strong></p>';
    }
    Echo $text;
}
if (isset($_POST['query']) && !empty($_POST['query'])) {
    $search_result = search($_POST['query']);
	echo $head['0'];
    echo $search_result;
	echo str_replace(array('[no-items]','[/no-items]','{pagination} '),array('<!--','-->',''),$template['1']);
}
?>


<style>
.main-top-section {
    display: none;
}
</style>