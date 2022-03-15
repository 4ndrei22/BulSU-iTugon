<?php
    include 'connect.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM accountcreation WHERE email = '".$email."' AND password = '".md5($password)."'";

    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);

    if ($count == 1){
        echo json_encode("Success");
    }else{        
        echo json_encode("Error");
    }

?>