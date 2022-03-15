<?php
     include 'connect.php';

     $ticket_id = $_POST['ticket_id'];
     $ticket_owner = $_POST['ticket_owner'];
 
    # $query = $con->query("SELECT * FROM messages LEFT JOIN accountcreation ON accountcreation.unique_id = messages.outgoing_msg_id
    # WHERE (outgoing_msg_id = 169512510 and ticket_id = '1033-20220023')
    # OR (incoming_msg_id = 169512510 and ticket_id = '1033-20220023') ORDER BY timestamp DESC LIMIT 20") or die($con->error);
     $query = $con->query("SELECT outgoing_msg_id, timestamp, msg, unread FROM messages WHERE ticket_id = '".$ticket_id."' ORDER BY timestamp ASC LIMIT 20") or die($con->error);
    # $query = $con->query("SELECT outgoing_msg_id, timestamp, msg, unread FROM messages WHERE ticket_id = '1033-20220023' ORDER BY timestamp DESC LIMIT 20") or die($con->error);
     
     $result = array();
     
     while($rowData = $query->fetch_assoc()){
         $result[] = $rowData;
     }

     echo json_encode($result);
    

?>