<?php
    include 'connect.php';
    // ini_set('display_errors', 'Off');
    
    $ticket_owner = $_POST['ticket_owner'];
    $ticket_id = $_POST['ticket_id'];
    $message = $_POST['message'];
    $subject = $_POST['subject'];
    $sub_category = $_POST['sub_category'];
    $date_needed = $_POST['date_needed']; 

    $sql = "SELECT * FROM ticketinfo WHERE ticket_id  = '".$ticket_id."'";

    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);

    if ($count == 1){
        echo json_encode("Error");
    }else{
        $insert = "INSERT INTO ticketinfo(ticket_owner, ticket_id, message, subject, sub_category, date_needed) 
        VALUES('.$ticket_owner.', '".$ticket_id."', '".$message."', '".$subject."', '".$sub_category."', '".$date_needed."')";

    #    $insert = "INSERT INTO ticketinfo(ticket_id, message, subject, sub_category) 
    #    VALUES('".$ticket_id."', '".$message."', '".$subject."', '".$sub_category."')" or die($db->error);

        $query = mysqli_query($con, $insert);

        if ($query){
            echo json_encode("Success");
        }
    }

?>