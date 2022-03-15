<?php
   include 'connect.php';
    // ini_set('display_errors', 'Off');
    
    $ticket_owner = $_POST['ticket_owner'];
    $ticket_id = $_POST['ticket_id'];
    $message = $_POST['message'];
    $subject = $_POST['subject'];
    $sub_category = $_POST['sub_category'];
    $date_needed = $_POST['date_needed']; 
    $office_code = $_POST['office_code'];
    $msg = $_POST['msg']; 
    $priority_lvl = $_POST['priority_lvl']; 
    $updates = $_POST['updates']; 

    $sql = "SELECT * FROM ticketinfo WHERE ticket_id  = '".$ticket_id."'";

    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);

    if ($count == 1){
        echo json_encode("Error");
    }else{
        $createTicket = "INSERT INTO ticketinfo(priority_lvl, ticket_owner, ticket_id, message, subject, sub_category, date_needed, office_code) 
        VALUES('".$priority_lvl."', '.$ticket_owner.', '".$ticket_id."', '".$message."', '".$subject."', '".$sub_category."', '".$date_needed."', '.$office_code.')" or die($con->error);

        $newMessage = "INSERT INTO messages(outgoing_msg_id, ticket_id, msg, msg_subject) 
        VALUES('.$ticket_owner.', '".$ticket_id."', '".$msg."', '".$subject."')" or die($con->error);

        $tickethistory = "INSERT INTO ticket_history(ticket_id, updates) 
        VALUES('".$ticket_id."', '".$updates."')" or die($con->error);
    #    $insert = "INSERT INTO ticketinfo(ticket_id, message, subject, sub_category) 
    #    VALUES('".$ticket_id."', '".$message."', '".$subject."', '".$sub_category."')" or die($db->error);

        $query1 = mysqli_query($con, $createTicket);
        $query2 = mysqli_query($con, $newMessage);
        $query3 = mysqli_query($con, $tickethistory);
        
        if($query1 && $query2 && $query3== true){
            echo json_encode("Success");
        }
        else 
            echo json_encode("Error");
    }

?>