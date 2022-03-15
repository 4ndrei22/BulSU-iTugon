<?php
	session_start();
	if(isset($_SESSION["firstname"]) && isset($_SESSION["lastname"]) && isset($_SESSION["email"]) && isset($_SESSION["contactnum"]))
	{
	header('Location: Dashboard(super).php');
	exit();
	} 
	$firstname = $_POST["firstname"];
	$lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $contactnum = $_POST["ContactNumber"];
    
	
	include 'connect.php';

	
	$sql1 = "SELECT * FROM accountcreation WHERE firstname = '$firstname' OR lastname = '$lastname' OR email = '$email' OR contactNum = '$contactnum'";
	
	$result = mysqli_query($con, $sql1);

	$count =  mysqli_num_rows ($result);
	if($count == 1)
	{
		while ($row = mysqli_fetch_array($result)){
			
			if($row["firstname"] == $firstname || $row["lastname"] == $lastname || $row["email"] == $email || $row["contactNum"] == $contactnum){
				$sql2 = "UPDATE `accountcreation` SET firstname = '$firstname', lastname = '$lastname', email = '$email', contactNum = '$contactnum'
           				 WHERE firstname = '$firstname' OR lastname = '$lastname' OR email = '$email' OR contactNum = '$contactnum'";
				mysqli_query($con,$sql2);	
				$_SESSION['Firstname'] = $firstname;
            	$_SESSION['Lastname'] = $lastname;
            	$_SESSION['email'] = $email;
            	$_SESSION['contactnum'] = $contactnum;		
				header("Location: ./user.php");
			}
			else{
				echo("Update error");
			}
		}
		
		
	}
	else
	{
		echo ("Update Error. You will be redirected in 3 sec.");
		header("refresh: 2; url=./user.php");
	}
	mysqli_close($con);
?>