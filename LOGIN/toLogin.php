<?php

	$msg = "";
		$con = new mysqli('localhost', 'root', '', 'db_admin');

		$username = $con->real_escape_string($_POST['usernameL']);
		$password = $con->real_escape_string($_POST['passwordL']);

		$sql = $con->query("SELECT * FROM accountcreation WHERE username='$username'");
		if ($sql->num_rows > 0) {
		    $data = $sql->fetch_array();
		    if (password_verify($password, $data['password']) && $data['adminkey'] == 1) {
            $firstname = $data['firstname'];
            $_SESSION["Firstname"] = $firstname;
            $lastname = $data['lastname'];
            $_SESSION["Lastname"] = $lastname;

		        $msg = "You have been logged IN to staff dashboard";
            $insert = "INSERT INTO loginaccess (Firstname,Lastname,Email,Contactnum, accessLVL,Username) SELECT firstname,lastname,email,contactNum,adminkey,username FROM accountcreation WHERE username = '$username' ";
				    mysqli_query($con,$insert);
            header("Location: ./Dashboard(Staff).php");

            }elseif (password_verify($password, $data['password']) && $data['adminkey'] == 2) {
              $firstname = $data['firstname'];
              $_SESSION["Firstname"] = $firstname;
              $lastname = $data['lastname'];
              $_SESSION["Lastname"] = $lastname;
              $msg = "You have been logged IN to admin dashboard";
              $insert = "INSERT INTO loginaccess (firstname,lastname,email,contactnum, accesslvl,username) SELECT firstname,lastname,email,contactNum,adminkey,username FROM accountcreation WHERE username = '$username' ";
				      mysqli_query($con,$insert);
              header("Location: ./Dashboard(super).php");
              } else
			    $msg = "Incorrect Password";
          header('refresh: 1, url = login.php');
        } else
            $msg = "Incorrect Username";
            header('refresh: 1, url = login.php');
?>