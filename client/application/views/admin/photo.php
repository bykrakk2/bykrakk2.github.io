<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Добавить фото</h3>
  </div>
<div class="panel-body">
<form action="#" method="post" enctype="multipart/form-data">
      <input type="file" name="filename"><br> 
      <input type="submit" value="Загрузить"><br>
      </form>
	</div></div>  

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Каталог фотографий</h3>
  </div>
<div class="panel-body">


 
 

      <table class='table table-hover table-bordered'>
        <thead>
          <tr>
              <th data-field="">Картинка</th>
              <th data-field="">Имя</th>
			  <th data-field=""></th>
          </tr>
        </thead>

        <tbody>
		<?php
		if($_POST['submit']) {
			$var='./assets/user/'.$_POST['text'].'';
            unlink($var);

		}
$handle = opendir( "./assets/user/");

while ( $file = readdir ($handle) ) //юзаем директорию с картинками
{

    @$temp = GetImageSize ($file); // Считывание параметров изображения
	
   

    if (preg_match('/\.png$/i',$file))     {
		$t1 = '"iconurl"';
		$t2 = '"/assets/user/'.$file.'"';
		
    echo "
	<tr>
	 <td><img class='imgd' src='/assets/user/$file' style='height: 41px; width: 41px; ' border=0></td>
	 <td>$file</td>
	 
	<td> 
	<form action='' method='POST'>
<input type='text' value='$file' style='display: none;' name='text'>
<input type='submit'  name='submit' value='Удалить'>
</form>
</td>  
	</tr>
	";
    $counter ++;  // счетчик проверки изображений в ряд
    }
}
?>
	
       
        </tbody>
      </table>
	  <style>

.imgd{
 width: 100%;
 height: 100%;
 border-radius:5px;
 box-shadow: 0 0 0 1px #fff;
 border:1px solid #eee;
 transition:all .25s ease-in-out;
 -webkit-transition:all .25s ease-in-out;
 -moz-transition:all .25s ease-in-out;
 -o-transition:all .25s ease-in-out;
 -ms-transition:all .25s ease-in-out;
}
.imgd:hover{
 width: 130%;
 height: 130%;
 box-shadow: 0 12px 6px -6px #666,0 0 3px 0 #ccc;
 margin: -1% 0% 0% -1%;
 border-radius:7px;
 CURSOR:pointer;
}
</style>
</div></div>
<?php
$extensions = array('jpeg', 'jpg', 'png', 'gif','mp3','mp4','xls');
$max_size = 500000;
   if($_FILES["filename"]["size"] > 1024*3*1024)
   {
     echo ("Размер файла превышает три мегабайта");
     exit;
   }
   // Проверяем загружен ли файл
   if(is_uploaded_file($_FILES["filename"]["tmp_name"]))
   {
	     $ext = strtolower(pathinfo($_FILES['filename']['name'], PATHINFO_EXTENSION));
    if (in_array($ext, $extensions)){
     // Если файл загружен успешно, перемещаем его
     // из временной директории в конечную
     move_uploaded_file($_FILES["filename"]["tmp_name"], "./assets/user/".$_FILES["filename"]["name"]);
		}
	   
   } else {
   }

?>
