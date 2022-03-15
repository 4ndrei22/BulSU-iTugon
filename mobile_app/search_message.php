<?php
     include 'connect.php';

     $ticket_owner = $_POST['ticket_owner'];
     $ticket_id = $_POST['ticket_id'];

    // $query = $con->query("SELECT *FROM messages WHERE outgoing_msg_id = '$ticket_owner' GROUP BY ticket_id ORDER by timestamp $sort") or die($con->error);  

    # SELECT ticketinfo.status, messages.ticket_id, messages.msg, messages.timestamp FROM ticketinfo INNER JOIN messages ON ticketinfo.ticket_id = messages.ticket_id WHERE messages.outgoing_msg_id = 169512510 AND NOT ticketinfo.status = 'Closed' GROUP BY ticket_id ORDER by timestamp DESC;
    $query = $con->query("SELECT ticketinfo.status, messages.ticket_id, messages.msg, messages.timestamp, messages.outgoing_msg_id, messages.msg_subject FROM ticketinfo INNER JOIN messages ON ticketinfo.ticket_id = messages.ticket_id WHERE messages.outgoing_msg_id = '$ticket_owner' AND ticketinfo.ticket_id = '$ticket_id'") or die($con->error);

    // $query = $con->query("SELECT ticketinfo.status, messages.ticket_id, messages.msg, messages.timestamp, messages.outgoing_msg_id FROM ticketinfo INNER JOIN messages ON ticketinfo.ticket_id = messages.ticket_id WHERE messages.outgoing_msg_id = '$ticket_owner' AND NOT ticketinfo.status = 'Closed' GROUP BY ticket_id ORDER by timestamp $sort") or die($con->error);

     $result = array();
     
     while($rowData = $query->fetch_assoc()){
         $result[] = $rowData;
     }

     echo json_encode($result);
    

?>