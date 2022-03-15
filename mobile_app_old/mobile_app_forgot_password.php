<?php
    include 'connect.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    #$sql1 = "SELECT * FROM accountcreation WHERE email = '".$email."' AND password = '".md5($password)."'";
    

    $sql = "SELECT * FROM accountcreation WHERE email = '".$email."'";

    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);

    if ($count == 1){
        $newPass = md5($password);
        $update = "UPDATE `accountcreation` SET password = '$newPass' WHERE email = '$email'" or die($con->error);
        

        $query = mysqli_query($con, $update);
        if($query){
            echo json_encode("Success");
        }
        
    }else{        
        echo json_encode("Error");
    }

?>