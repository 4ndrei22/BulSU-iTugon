<?php
    include 'connect.php';

    $email = $_POST['email'];
    $newemail = $_POST['newemail'];

    #$sql1 = "SELECT * FROM accountcreation WHERE email = '".$email."' AND password = '".md5($password)."'";
    

    $sql = "SELECT * FROM accountcreation WHERE email = '".$email."'";

    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);

    if ($count == 1){

        $newsql = "SELECT * FROM accountcreation WHERE email = '".$newemail."'";
        $newresult = mysqli_query($con, $newsql);
        $newcount = mysqli_num_rows($newresult);

        if ($newcount == 1){
            echo json_encode("Duplicate");
        }
        else{        

            $update = "UPDATE `accountcreation` SET `email` = '".$newemail."' WHERE email = '".$email."'" or die($con->error);

            $query = mysqli_query($con, $update);
            if($query){
                echo json_encode("Success");
            }
        }
    }
    else{        
        echo json_encode("Error");
    }

?>