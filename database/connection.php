<?php
	$servername = 'localhost';
	$username = 'root';
	$password = '';
	
	try{
		$conn = new PDO("mysql:host=$servername;dbname=quanlykho;charset=utf8", $username, $password);
		$conn->exec("set names utf8");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//$error_message = 'Connected Sucessfully !';	
	}catch(PDOException $e){
		//$error_message = $e->getMessage();
	}
?>