<?php
	$servername = 'localhost';
	$username = 'root';
	$password = '';
	$dbname = "db_admin";
	
	$con = mysqli_connect($servername,$username,$password,$dbname);
	
	if(!$con){
	   die('Could not Connect My Sql:' .Sql_error());
	}
?>

