<?php
	$servername = 'localhost';
	$username = 'u106223405_admin';
	$password = 'Admin123';
	$dbname = "u106223405_db_admin";
	
	$con = mysqli_connect($servername,$username,$password,$dbname);
	
	if(!$con){
	   die('Could not Connect My Sql:');
	}
?>

