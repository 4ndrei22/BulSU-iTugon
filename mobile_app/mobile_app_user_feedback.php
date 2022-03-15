<?php
    include 'connect.php';

    $unique_id = $_POST['unique_id']; 
    $rating = (int)$_POST['rating'];
    $suggestions = $_POST['suggestions'];

    $sql = "SELECT * FROM accountcreation WHERE unique_id = '".$unique_id."'";

    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);

    if ($count == 1){

        $update = "UPDATE `accountcreation` SET `rating` = '".$rating."', `suggestions` = '".$suggestions."' WHERE unique_id = '".$unique_id."'" or die($con->error);

        $query = mysqli_query($con, $update);

        if ($query){
            echo json_encode("Success");
        }
        
    }else{

        echo json_encode("Error");
    }

?>