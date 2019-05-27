<?php  
function getIP() {
if(isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
   return $_SERVER['REMOTE_ADDR'];
}
if (!in_array(getIP(), array('136.243.38.147', '136.243.38.149', '136.243.38.150', '136.243.38.151', '136.243.38.189'))) {
    die("hacking attempt!");
}
$secr2 = config_item('f_key_2');
$keyer1 = md5($_REQUEST['MERCHANT_ID'].':'.$_REQUEST['AMOUNT'].':'.$secr2.':'.$_REQUEST['MERCHANT_ORDER_ID']);
$keyer2 = $_REQUEST['SIGN'];

if ($keyer1 == $keyer2) {
	mysql_query("UPDATE orders SET `paid`='1' WHERE bill='".$_REQUEST['MERCHANT_ORDER_ID']."'");
	mysql_query("UPDATE orders SET `downlands`='1' WHERE bill='".$_REQUEST['MERCHANT_ORDER_ID']."'");
 } 
 //Так же, рекомендуется добавить проверку на сумму платежа и не была ли эта заявка уже оплачена или отменена
//Оплата прошла успешно, можно проводить операцию.
die('YES');

?>