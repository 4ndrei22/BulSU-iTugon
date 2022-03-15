<?php
	$servername = 'localhost';
	$username = 'root';
	$password = '';
	$dbname = "chatapp";
	
	$con = mysqli_connect($servername,$username,$password,$dbname);
	
	if(!$con){
	   die('Could not Connect My Sql:' .Sql_error());
	}
?>

