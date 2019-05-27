<aside id="wk-center">
					<!-- Отзывы -->
				
			<div class="digiseller-reviewList" style="float: left;width: 560px;">
<h1 style=" border-radius: 1px; text-align: center; background: #383838;width: 935px;padding: 11px;color: #c6beff;text-shadow: 0px 0px 6px #7473ff;font-size: 16px;text-transform: uppercase;">Автозамена товара<span class="digiseller-labelIcon" <span="">&nbsp;</span></h1>
			


<?
$sql = "SELECT COUNT(*) FROM autochange";
$xxx = mysql_query($sql)  or die(mysql_error());
$row = mysql_fetch_row($xxx);
$total = $row[0];

?>
		<?
	
		$db_table_to_show = 'autochange';
				 $qr_result = mysql_query("select * from  . $db_table_to_show ORDER BY `id` DESC")
        or die(mysql_error());

    // выводим на страницу сайта заголовки HTML-таблицы
    
   // выводим в HTML-таблицу все данные клиентов из таблицы MySQL 
    while($data = mysql_fetch_array($qr_result)){ 
    if($data['status'] == 1)
{       
	   echo '';
	   }
	   else 
	   {
	   echo '';
	   }
        echo '';
	    echo '';
        echo '';

	}
    
    echo '';
    echo '';
					
	
	?>


<script type="text/javascript" language="javascript">

function proverka(www) { //Открываем и передаем данные
	
	if (www.title.value=='') { //Проверяем пустое ли
	
	alert("Необходимо заполнить имя"); //Выводим ошибку если пусто
	
	return false; //Ворачиваем ошибку 
	
	}
	
	if (www.body.value=='') { //Проверяем пустое ли
	
	alert("Необходимо заполнить текст комментария"); //Выводим ошибку если пусто
	
	return false; //Ворачиваем ошибку 
	
	}
	
	}

</script>
<?
$ip = $_SERVER["REMOTE_ADDR"];
$db_query_ip = mysql_query("SELECT * FROM autochange WHERE ip = '$ip' LIMIT 1");
$db_ip = mysql_fetch_array($db_query_ip);
?>
  <div class="loform">
    <?
if($db_ip['ip'] == $ip){
echo '<center style="color: red;">Вы уже оставляли отзыв</center>';
}
else{
echo '';
}

  ?>
<?
if($db_ip['ip'] == $ip){
echo '';
}
else{
echo '<form  name="form1" onsubmit="return proverka(form1)" method="post" action="autochange" >

			<input placeholder="Ваше имя" style=" margin-top: 10px; padding: 10px; border: 1px solid rgba(182, 172, 172, 0.44);color: #8B8888; width: 300px;outline: none;" type="text" class="form-control" name="title" /></p>
			<input placeholder="Примечание" style=" margin-top: 10px; padding: 10px; border: 1px solid rgba(182, 172, 172, 0.44);color: #8B8888; width: 170px;outline: none;" type="text" class="form-control" name="bill" /></p>
			

			<textarea placeholder="Текст отзыва..." name="body" class="form-control" cols="40" rows="5" style="width: 440px; padding: 10px;border: 1px solid rgba(182, 172, 172, 0.44);color: #8B8888;margin-top: 10px;"></textarea></p>
            <p>
<br>
<p><select name="status" style=" margin-top: 0px; padding: 10px; border: 1px solid rgba(182, 172, 172, 0.44); color: #8B8888;font-family: sans-serif;font: 13.3333px Arial;">
<option value="1">Положительный</option>
<option value="2">Отрицательный</option>
</select><p>
                <input type="submit" class="submit" name="submit" value="Отправить отзыв" size="40" name="go" style=" background: #ff943e; font-size: 16px; padding: 9px 20px; border-right: none; border-left: none; height: 39px; border-top: none; color: #fff;float: right; margin-top: -39px;border: 1px solid #ff943e;cursor: pointer; margin-right: 200px;">

            </p>
        </form>';
}

  ?> 	
		</div>  
<?php    

//подключаем базу в моём случае
if(count($_POST['submit']) && $db_ip['ip'] != $ip && !preg_match('~\s*script\s*~u', $_POST['body']) && !preg_match('~\s*script\s*~u', $_POST['title']) && !preg_match('~\s*script\s*~u', $_POST['bill']))
{
$title = mysql_real_escape_string($_POST['title']);
$status = mysql_real_escape_string($_POST['status']);
$ip = mysql_real_escape_string($_SERVER["REMOTE_ADDR"]);
$body = mysql_real_escape_string($_POST['body']);
$slug = mysql_real_escape_string(date("d-m-Y G:i"));
$bill = mysql_real_escape_string($_POST['bill']);

$sql = 'INSERT INTO autochange(title,body,slug,status,ip,bill) 
 VALUES("'.$title.'", "'.$body.'", "'.$slug.'", "'.$status.'", "'.$ip.'", "'.$bill.'")';

 header("Location: autochange");
 }


else{
echo '';
}
// проверка
 if(!mysql_query($sql))
 {echo 'ошибка';} 
 else 
 {echo '';}




?>
<div class="digiseller-both"></div>					
				</div>
<div style="clear:both;"></div>

				

		
</aside>

<style>
.digiseller-productList.digiseller-homepage {
    width: 1160px;
	margin-left: -10px;
}
.loform {
    background: #F6F6F6;
    padding: 15px;
    margin-top: 15px;
    width: 538px;
}
</style>