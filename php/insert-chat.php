<?php 
    session_start();
    if(isset($_SESSION['U_unique_id'])){
        include_once "config.php";
        $outgoing_id = $_SESSION['U_unique_id'];
        $incoming_id = mysqli_real_escape_string($con, $_POST['incoming_id']);
        $ticket_id = mysqli_real_escape_string($con, $_POST['ticket_id']);
        $message = mysqli_real_escape_string($con, $_POST['message']);
        if(!empty($message)){
            $select = mysqli_query($con, "SELECT * FROM ticketinfo WHERE status = 'Open' AND ticket_id = '{$ticket_id}' ");
            if(mysqli_num_rows($select)>0){
                $row = mysqli_fetch_assoc($select);
                
                $ticket_sender = $row['ticket_owner'];
                $ticket_created = $row['ticket_created'];
                $send = mysqli_query($con, "SELECT * FROM accountcreation WHERE unique_id = '{$ticket_sender}' ");
                 if(mysqli_num_rows($send)>0){
                     $row2 = mysqli_fetch_assoc($send);
                     $email = $row2['email'];
                    $name = $row2['firstname']." ".$row2['lastname'];
                    ini_set( 'display_errors', 1 );
                    error_reporting( E_ALL );
                    $from = "bulsuitugonservicedesk@bulsu-itugon.com";
                    $to = "$email";
                    
                    $subject = "BulSU iTugon Service Desk";
                    $email_message = "Hello $name,\n\nYour ticket has now been assigned to a staff for processing.\n\nKindly allow 3–5 working days for completion and/or resolution.\n\nProcessing of your request may take longer during weekends, holidays, and future unforeseen events.\n\nPlease take note of the following details for your reference.\n\nTicket #:$ticket_id \nTicket Details:$ticket_created";
                    $headers = "From:" . $from;
                    if(mail($to,$subject,$email_message, $headers)) {
                        $msg = "The email message was sent.";
                    } else {
                        $msg = "The email message was not sent.";
                       ;
                    }
                 }
                
                $insert = mysqli_query($con,"INSERT INTO ticket_history (ticket_id,updates) VALUES ('{$ticket_id}','Assigned')");
                $update = mysqli_query($con, "UPDATE ticketinfo SET status='Assigned',ticket_assignee = $outgoing_id WHERE ticket_id ='{$ticket_id}'");
                $sql = mysqli_query($con, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, ticket_id)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}','{$ticket_id}')") or die(); 
            }else{
               $sql = mysqli_query($con, "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg, ticket_id)
                                        VALUES ({$incoming_id}, {$outgoing_id}, '{$message}','{$ticket_id}')") or die(); 
            }
            
            
        }
    }else{
        header("location: ../login.php");
    }


    
?>