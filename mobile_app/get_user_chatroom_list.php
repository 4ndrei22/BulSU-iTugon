<?php
     include 'connect.php';

     $ticket_owner = $_POST['ticket_owner'];
     $sort = $_POST['sort'];

    
    $query = $con->query("SELECT ticketinfo.status, messages.ticket_id, messages.msg, messages.timestamp, messages.outgoing_msg_id, messages.msg_subject FROM ticketinfo INNER JOIN messages ON ticketinfo.ticket_id = messages.ticket_id WHERE messages.outgoing_msg_id = '$ticket_owner' GROUP BY ticket_id ORDER by timestamp $sort") or die($con->error);
    
    // $query = $con->query("SELECT ticketinfo.status, messages.ticket_id, messages.msg, messages.timestamp, messages.outgoing_msg_id FROM ticketinfo INNER JOIN messages ON ticketinfo.ticket_id = messages.ticket_id WHERE messages.outgoing_msg_id = '$ticket_owner' AND NOT ticketinfo.status = 'Closed' GROUP BY ticket_id ORDER by timestamp $sort") or die($con->error);

     $result = array();
     
     while($rowData = $query->fetch_assoc()){
         $result[] = $rowData;
     }

     echo json_encode($result);
    

?>