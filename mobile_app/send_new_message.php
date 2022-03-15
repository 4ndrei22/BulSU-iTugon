<?php
    include 'connect.php';
    // ini_set('display_errors', 'Off');
    
    $ticket_owner = $_POST['ticket_owner'];
    $ticket_id = $_POST['ticket_id'];
    $msg = $_POST['msg'];

    $sql = "SELECT * FROM ticketinfo WHERE ticket_id  = '".$ticket_id."'";

    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);

    if ($count == 1){
        $newMessage = "INSERT INTO messages(outgoing_msg_id, ticket_id, msg) 
        VALUES('{$ticket_owner}', '".$ticket_id."', '".$msg."')" or die($con->error);

    #    $newMessage = "INSERT INTO messages(outgoing_msg_id, ticket_id, msg) 
    #    VALUES(1287107276, '1029-20220003', 'test send new message')" or die($con->error);

        $query = mysqli_query($con, $newMessage);

        if ($query){
            echo json_encode("Success");
        }

    }else{
        echo json_encode("Error");
    }

?>