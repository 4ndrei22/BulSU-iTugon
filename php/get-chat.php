<?php 
    session_start();
    if(isset($_SESSION['U_unique_id'])){
        include 'config.php';
        $outgoing_id = $_SESSION['U_unique_id'];
        $incoming_id = mysqli_real_escape_string($con, $_POST['incoming_id']);
        $ticket_id = $_SESSION['convo_user_id'];
        $limit = $_POST['limit'];
        $output = "";
        
        $sql = "SELECT * FROM messages LEFT JOIN ticketinfo ON ticketinfo.ticket_id = messages.ticket_id
                WHERE messages.ticket_id= '{$ticket_id}'ORDER BY msg_id DESC LIMIT {$limit}";
        $query = mysqli_query($con, $sql);
        if(mysqli_num_rows($query) > 0){
            
            while($row = mysqli_fetch_assoc($query)){
                date_default_timezone_set('Asia/Manila');
                $timestamp =  $row['timestamp'];
                $timestamp = strtotime($timestamp) + 60 * 60 * 8;
                //$timestamp = strtotime($timestamp);
                $timediff = $_SERVER['REQUEST_TIME'] - $timestamp; 

                $image = $row['img'];
                if($image == NULL){
                    $image = 'blank-profile-picture-973460_1280.png';
                }
                if(date('d.m.Y',strtotime("-1 days"))==date('d.m.Y',strtotime($timestamp))){
                    $timestamp = date("D · g:i A", $timestamp);
                }else if(($timediff > 86400)&&($timediff < 604800)){
                    $timestamp = date("D · g:i A", $timestamp);
                }elseif(($timediff > 604800)){
                    $timestamp = date("M d · g:i A", $timestamp);
                }else{
                    if(date('d.m.Y',$_SERVER['REQUEST_TIME'])!=date('d.m.Y',$timestamp)){
                        $timestamp = 'Yesterday'.date(" · g:i A", $timestamp);
                    }elseif($timediff < 60 ){
                        $timestamp = 'Just now';
                    }
                    else{
                        $timestamp = date("g:i A", $timestamp);
                    }
                }

                if($row['outgoing_msg_id'] === $outgoing_id){
                    $output .= '<div><div class="d-flex flex-row-reverse mt-2"> 
                                    <div class="outgoing-chat py-2 px-3" Style="max-width: 80%; background-color: #671e1e; border-radius: 50px 50px 5px 50px;">
                                        <p class="fs-6 p-0 m-0 text-white" style="word-wrap: break-word; ">'. $row['msg'] .'</p>
                                    </div>
                                </div>
                                <div class="d-flex flex-row-reverse mb-2">
                                    <small class="mb-2 text-muted">'.$timestamp.'</small>
                                </div>
                                </div>';
                                
                
                }else{
                    $output .= '<div class="d-flex my-2">
                                    <img class="rounded-circle p-0 align-self-top me-2" src="../BulSU.png" width="28px" height="28px">
                                    <div style="max-width: 80%; ">
                                        <div class="py-2 px-3 bg-secondary incoming-chat" Style="border-radius: 50px 50px 50px 5px;">
                                            <p class="fs-6 p-0 m-0 text-white" style="word-wrap: break-word;">'. $row['msg'] .'</p></div>
                                        <small class="mb-2 text-muted">'.$timestamp.'</small>
                                    </div>
                                </div>';
                }
            }
        }else{
            $output .= '<div class="fw-600 text-secondary text-center mt-5">No messages are available. Once you send message they will appear here.</div>';
            
            //continuation of query
        }
        echo $output;
    }else{
        header("location: ../login.php");
    }

?>