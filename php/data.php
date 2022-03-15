<?php
    while($row = mysqli_fetch_assoc($query)){
        //$ticket_id = $_SESSION['convo_user_id'];
            $sql1 = "SELECT * FROM messages WHERE (incoming_msg_id = {$row['ticket_owner']}
                OR outgoing_msg_id = {$row['ticket_owner']} AND ticket_id = '{$row['ticket_id']}') AND (outgoing_msg_id = {$outgoing_id} 
                OR incoming_msg_id = {$outgoing_id}  AND ticket_id = '{$row['ticket_id']}') ORDER BY msg_id DESC LIMIT 1";
            $query1 = mysqli_query($con, $sql1);
            $row1 = mysqli_fetch_assoc($query1);
    
            
            $timestamp =  '';
            if(mysqli_num_rows($query1) > 0){
                $timestamp =  $row1['timestamp'];
    
                date_default_timezone_set('Asia/Manila');
                $timestamp = strtotime($timestamp);
                $timediff = $_SERVER['REQUEST_TIME'] - $timestamp; 
    
                $result = $row1['msg'];
                if(date('Y',$_SERVER['REQUEST_TIME'])!=date('Y',$timestamp)){
                    $timestamp = date("M d Y", $timestamp);
                }else if(($timediff > 86400)&&($timediff < 604800)){
                    $timestamp = date("D", $timestamp);
                }elseif(($timediff > 604800)){
                    $timestamp = date("M d", $timestamp);
                }else{
                    if(date('d.m.Y',$_SERVER['REQUEST_TIME'])!=date('d.m.Y',$timestamp)){
                        $timestamp = 'Yesterday';
                    }elseif($timediff < 60){
                        $timestamp = 'Just now' ;
                    }
                    else{
                        $timestamp = date("g:i A", $timestamp);
                    }
                }
             }else{
                 $result ="No message available";
             }
            (strlen($result) > 28) ? $msg =  substr($result, 0, 28) . '...' : $msg = $result;
            if(isset($row1['outgoing_msg_id'])){
                ($outgoing_id == $row1['outgoing_msg_id']) ? $you = "You: " : $you = "";
            }else{
                $you = "";
            }
            ($outgoing_id == $row['ticket_owner']) ? $hid_me = "hide" : $hid_me = "";
    
            $selectedConvo = "";
            if(!isset($_SESSION['convo_user_id'])){
                $_SESSION['convo_user_id'] = $row['ticket_id'];
            }
            if($row['ticket_id'] == $_SESSION['convo_user_id']){
                $selectedConvo = "#671e1e";
                $color = "white";
            }else{
                $color = "black";
            }
            $output .= '
                    <a  href="javascript:showConversation('.$row['ticket_id'].')" class="text-decoration-none">
                        <div class="chat-convo-list-item p-2 rounded m-0 mb-2 min-vw-100" Style="background-color: '.$selectedConvo.'" >
                            <div class="d-flex flex-row">
                                <img class="rounded-circle p-0 align-self-xl-center my-auto" src="../BulSU.png" width="42px" height="42px">
                                <div class="flex-grow-1 align-self-stretch px-2 text-truncate">
                                    <div class="pe-2 overflow-visible"><p class="text-truncate lh-1 mt-1 fs-6 fw-600 mb-0 overflow-visible text-'.$color.'">'. $row['ticket_id'].'</p></div>
                                    <div class="d-flex">
                                        <span class="text-truncate fs-6 mt-0 flex-grow-1 pe-2 text-'.$color.'">'. $you . $msg .'</span>
                                        <span class="text-muted mt-0 text-end">'.$timestamp.'</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>';
    }
?>