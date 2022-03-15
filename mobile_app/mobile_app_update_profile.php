<?php
    include 'connect.php';

    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $contactNum = $_POST['contactNum'];
    $username = $_POST['username'];

    #$sql1 = "SELECT * FROM accountcreation WHERE email = '".$email."' AND password = '".md5($password)."'";
    

    $sql = "SELECT * FROM accountcreation WHERE email = '".$email."'";

    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);

    if ($count == 1){
        $update = "UPDATE `accountcreation` SET `firstname` = '".$firstname."', `lastname` = '".$lastname."', 
        `contactNum` = '".$contactNum."', `username` = '".$username."' WHERE email = '".$email."'" or die($con->error);

    #    $update = "UPDATE `accountcreation` SET `firstname` = 'jeri', `lastname` = 'ambray', 
     #   `contactNum` = '+639056441177', `username` = 'jerimiya' WHERE `email` = 'payongayongjeri@gmail.com'" or die($con->error);
        
        $query = mysqli_query($con, $update);
        if($query){
            echo json_encode("Success");
        }
        
    }else{        
        echo json_encode("Error");
    }

?>