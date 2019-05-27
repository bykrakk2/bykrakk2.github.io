<?php

class Database {

	function create_database($data)
	{
		$mysqli = new mysqli($data['hostname'],$data['username'],$data['password'],'');
		if(mysqli_connect_errno())
			return false;
		$mysqli->query("CREATE DATABASE IF NOT EXISTS ".$data['database']);
		$mysqli->close();
		return true;
	}
	function create_tables($data)
	{
		$mysqli = new mysqli($data['hostname'],$data['username'],$data['password'],$data['database']);
		$email = $data['useremail'];
		$pass = md5($data['userpass']);
		if(mysql_errno())
			return false;
		$query = file_get_contents('assets/install.sql');
		$mysqli->set_charset("utf8");
		
		$mysqli->multi_query($query);
		
		while($mysqli->next_result()) $mysqli->store_result();
		$create = "INSERT INTO `users` (`id`, `email`, `password`, `name`, `vdata`, `group`) VALUES (NULL, '".$email."', '".$pass."', 'admin', NULL, '1');";
		$mysqli->query($create);
		print_r($mysqli->error);
		$mysqli->close();

		return true;
	}

}