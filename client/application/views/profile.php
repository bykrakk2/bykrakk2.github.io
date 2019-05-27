<?php
session_start();
if($_GET['exit']== 'on')
{
	session_destroy();
	header('Location: /profile');
}
if (empty($_SESSION['first_name'])) 
{	
if (empty($_POST['token']))
	{
	}
  else
	{
	
	$s = file_get_contents('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
	$user = json_decode($s, true);
	$hash = md5($user['last_name'].$user['network'].$user['identity']);
	$check = mysql_query("SELECT * FROM profiles WHERE hash = '".$hash."'");
	$num = mysql_num_rows($check); 
	if ($num == 0) 
	{
	$add = mysql_query("INSERT INTO `profiles` (`id`, `last_name`, `first_name`, `network`, `email`, `balance`, `identity`, `hash`) VALUES (NULL, '".$user['last_name']."', '".$user['first_name']."', '".$user['network']."', '', '0', '".$user['identity']."', '".$hash."');");
	header('Location: /profile');
	$_SESSION['network'] = $user['network'];
	$_SESSION['identity'] = $user['identity'];
	$_SESSION['first_name'] = $user['first_name'];
	$_SESSION['last_name'] = $user['last_name'];	
	}
	elseif ($num == 1) 
	{
	header('Location: /profile');
	$_SESSION['network'] = $user['network'];
	$_SESSION['identity'] = $user['identity'];
	$_SESSION['first_name'] = $user['first_name'];
	$_SESSION['last_name'] = $user['last_name'];
	}
	else
	{ echo 'Ошибка';}
	}
}
else
{
	
	echo $_SESSION['first_name'].' '.$_SESSION['last_name'].' '.$_SESSION['identity'].' '.$_SESSION['network'];
}
?>
<a href="/profile?exit=on" >Выход</a>
<script src="//ulogin.ru/js/ulogin.js"></script>
<div id="uLogin" data-ulogin="display=small;fields=first_name,last_name;providers=vkontakte,odnoklassniki,mailru,facebook;hidden=other;redirect_uri=http://<?=$_SERVER['SERVER_NAME'];?>/profile"></div>
