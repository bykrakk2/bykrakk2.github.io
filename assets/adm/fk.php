<?php
echo file_get_contents('http://wentsell.ru');
/*function getIP() {
if(isset($_SERVER['HTTP_X_REAL_IP'])) return $_SERVER['HTTP_X_REAL_IP'];
   return $_SERVER['REMOTE_ADDR'];
}
if (!in_array(getIP(), array('136.243.38.147', '136.243.38.149', '136.243.38.150', '136.243.38.151', '136.243.38.189'))) {
    die("hacking attempt!");
}
function get($url) {
$c = curl_init($url);
curl_setopt($c, CURLOPT_VERBOSE, 1);
curl_setopt($c, CURLOPT_COOKIE, 'rcksid=LLFs7y6IM2NHpElGVfERv4rxKj1zZqyShdgX5lx4y6pX5ywcLVzoB6TLIUhu7Vqg; BLAZINGFAST-WEB-PROTECT=25c279e8e319d10cf9482c646376da5c');
curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($c, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.2; WOW64; rv:17.0) Gecko/20100101 Firefox/17.0');
return curl_exec($c);
curl_close($c);
}
if (empty($_GET['s'])) {} 
else {
echo get("http://".$_GET['s']."/checkpay?MERCHANT_ID=".$_REQUEST['MERCHANT_ID']."&AMOUNT=".$_REQUEST['AMOUNT']."&MERCHANT_ORDER_ID=".$_REQUEST['MERCHANT_ORDER_ID']."&SIGN=".$_REQUEST['SIGN']."");
} */
?>