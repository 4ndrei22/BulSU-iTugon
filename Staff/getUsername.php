<?php
    include 'connect.php';
 
    if(!empty($_POST)) {
        $username = $con->real_escape_string($_POST['CurUsername']);
        $newUsername =$con->real_escape_string($_POST['NewUsername']);
        $password = $con->real_escape_string($_POST['CUPassword']);

        $sql = $con->query("SELECT id, username,password FROM accountcreation WHERE username='$username'");
        
        if ($sql->num_rows > 0) {
		    $data = $sql->fetch_array();
		    if (password_verify($password, $data['password'])) {

		        $msg = "You have been logged IN to staff dashboard";
                $sql1 = "UPDATE `accountcreation` SET username = '$newUsername' WHERE username = '$username'";
                $sql2 = "UPDATE `loginaccess` SET username = '$newUsername' WHERE username = '$username'";
                mysqli_query($con,$sql1);
                mysqli_query($con,$sql2);
                echo "<meta http-equiv='refresh' content='0'>";
                header('Location: ChangeUsername.php');

            }else
			    $msg = "Please check your inputs!";
        } else
            $msg = "Please check your inputs!";
    } 
 
?>