<?php
session_start();
require_once 'connect.php';
if (isset($_POST['search_param'])) {
    $search_param = mysqli_real_escape_string($con, $_POST['search_param']);
    $query = mysqli_query($con, "SELECT 
                    	ticketinfo.ticket_id AS ticket_id,
                        ticketinfo.ticket_owner AS ticket_owner,
                        ticketinfo.subject AS subject,
                    	ticketinfo.status AS status,
                        ticketinfo.date_needed AS date_needed,
                        ticketinfo.priority_lvl AS priority_lvl,
                        ticketinfo.message AS message,
                        accountcreation.firstname AS firstname
                        ,accountcreation.lastname AS lastname,
                        accountcreation.img AS img
                    FROM ticketinfo 
                    INNER JOIN accountcreation ON accountcreation.unique_id = ticketinfo.ticket_owner where (ticketinfo.ticket_assignee =  {$_SESSION['U_unique_id']}) AND (ticketinfo.status='Resolved') AND (ticketinfo.ticket_id like '%$search_param%' or ticketinfo.priority_lvl like '%$search_param%') order by date_needed");
    $output = '';
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_array($query)) {
            $ticketnum=$row['ticket_owner'];
                        $ticketId = $row['ticket_id'];
                        $prioLvl = $row['priority_lvl'];
                        $message = $row['message'];
                        $Stat = $row['status'];
                        $date = $row['date_needed'];
                        $subj = $row['subject'];
                        $fullname = $row['firstname'] . ' ' . $row['lastname'];
                        $ticketname = $fullname;
                        $image = $row['img'];
                        if(strlen($subj) > 25){
                            $sub = substr($subj, 0, 25);
                            $subj = $sub."".'...';
                        }else{
                            $subj;
                        }
                        if(strlen($message) > 50){
                            $mess = substr($message, 0, 50);
                            $message = $mess."".'...';
                        }else{
                            $message;
                        }
                        if($prioLvl=='Urgent'){
                                    $color="red";
                                }elseif($prioLvl=='High'){
                                    $color="orange";
                                }elseif($prioLvl=='Normal'){
                                    $color="green";
                                }elseif($prioLvl=='Low'){
                                    $color="blue";
                                }
            $output .= '<tr>
                            <td>
                                <div class="col-lg-12 col-md-12 col-sm-12"  style="margin-top:-2%;" >
                                    <div class="card card-stats">
                                        <div class="card-body">
                                            <a href="Ticket(conversation)?user_id='.$row['ticket_id'].'" style="text-decoration:none; color:#000000;">
                                                <div class="row">
                                                    <div class="col-lg-1 col-md-1 col-sm-1">
                                                        <div class="icon-small text-center icon-warning">
                                                            <img class="rounded-circle" src="../BulSU.png" alt="" width=42px; height=42px;>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                                        <div class="numbers">
                                                            <p Style="font-size:12px; text-align:left; font-weight: bold;">#'.$row['ticket_id'].'</p>  
                                                            <p Style="font-size:12px; text-align:left;">'.$fullname.'</p>
                                                            <p Style="font-size:10px; text-align:left;">'.$row['message'].'</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <div class="numbers">
                                                            <p Style="font-size:10px; text-align:left;">
                                                                <span class="status bg-success"></span>'.$row['status'].'
                                                            </p>  
                                                            <p Style="font-size:10px; text-align:left;">
                                                                <span class="status '.$color.'"></span>'.$row['priority_lvl'].'
                                                            </p>
                                                            <p Style="font-size:12px; text-align:left;">
                                                                <i class="fa fa-calendar"></i>
                                                                '.$row['date_needed'].'
                                                            </p>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </a> 
                                        </div>
                                        <div class="text-center card-footer">
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>';
        }
    } else {
        $output .= '
                    <tr>
                        <td colspan="4"> No result found. </td>   
                    </tr>';
    }
    echo $output;
}
?>