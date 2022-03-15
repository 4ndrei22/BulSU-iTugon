<?php
    session_start();
    include_once "config.php";
    $outgoing_id = $_SESSION['U_unique_id'];
    //$incoming_id = $_SESSION['convo_user_id'];
    $sql = "SELECT t1.*, U.* FROM messages t1 JOIN ( SELECT LEAST(incoming_msg_id, outgoing_msg_id) user1, GREATEST(incoming_msg_id, outgoing_msg_id) user2, MAX(msg_id) msg_id FROM messages t2 GROUP BY user1, user2 ) t3 ON t1.incoming_msg_id IN (t3.user1, t3.user2) AND t1.outgoing_msg_id IN (t3.user1, t3.user2) AND t1.msg_id = t3.msg_id INNER JOIN ticketinfo U ON (U.ticket_owner = incoming_msg_id XOR U.ticket_owner = outgoing_msg_id) AND U.ticket_assignee = {$outgoing_id} ORDER BY t1.timestamp DESC;";
    $query = mysqli_query($con, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "<p class='text-center text-black mt-5 p-4 fs-5 fw-600'>Select open ticket to start conversation.</>";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
?>