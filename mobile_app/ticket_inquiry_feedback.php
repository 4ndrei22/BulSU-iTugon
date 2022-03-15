<?php
    include 'connect.php';

    $ticket_id = $_POST['ticket_id'];
    $rating = (int)$_POST['rating'];
    $comments = $_POST['comments'];
    $rate = $_POST['rate'];

    #$sql1 = "SELECT * FROM accountcreation WHERE email = '".$email."' AND password = '".md5($password)."'";
    
    $sql = "SELECT * FROM ticketinfo WHERE ticket_id = '".$ticket_id."'";

    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);

    if ($count == 1){

        $update = "UPDATE `ticketinfo` SET `inquiry_rated` = 'Yes', `rating` = '".$rating."', `comments` = '".$comments."' WHERE ticket_id = '".$ticket_id."'" or die($con->error);
        
        $rateinquiry = "INSERT INTO ticket_history(ticket_id, updates) 
        VALUES('".$ticket_id."', '".$rate."')" or die($con->error);

        $query1 = mysqli_query($con, $update);
        $query2 = mysqli_query($con, $rateinquiry);

        if($query1 && $query2 == true){
            echo json_encode("Success");
        }
    }
    else{        
        echo json_encode("Error");
    }

?>