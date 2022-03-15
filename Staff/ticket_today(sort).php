<?php
    if(isset($_POST['submit'])){
    if(!empty($_POST['status'])) {
        $selected = $_POST['status'];
        $select = mysqli_query($con,"SELECT
                        ticketinfo.ticket_id AS ticket_id,
                        ticketinfo.ticket_owner AS ticket_owner,
                        ticketinfo.subject AS subject,
                    	ticketinfo.status AS status,
                        ticketinfo.date_needed AS date_needed,
                        ticketinfo.priority_lvl AS priority_lvl,
                        ticketinfo.message AS message,
                        accountcreation.firstname AS firstname,
                        accountcreation.lastname AS lastname
       FROM ticketinfo INNER JOIN accountcreation ON ticketinfo.ticket_owner = accountcreation.unique_id WHERE date_needed IN (CURRENT_DATE, CURRENT_DATE) AND ticketinfo.ticket_assignee = '{$_SESSION['U_unique_id']}' AND ticketinfo.status = '$selected' AND NOT ticketinfo.status = 'Closed'");
       if(mysqli_num_rows($select) > 0){
                    while ($row = mysqli_fetch_array($select)){
                        
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
                        
                        if($image == NULL){
                            $image = 'blank-profile-picture-973460_1280.png';
                        }
                        if($ticketname == NULL){
                            $ticketname = 'Unknown user';
                        }
                            if($prioLvl == "Urgent"){ 
                            echo "
                                <div class='col-lg-12 col-md-12 col-sm-12' >
                                        <div class='card card-stats'>
                                            <div class='card-body'>
                                                <a href='Ticket(conversation)?user_id=$ticketId' style='text-decoration:none; color:#000000;'>
                                                    <div class='row'>
                                                        <div class='col-lg-1 col-md-1 col-sm-1'>
                                                            <div class='icon-small text-center icon-warning'>
                                                                <img class='rounded-circle' src='../BulSU.png' alt='' width=42px; hieght=42px;>
                                                            </div>
                                                        </div>
                                                        <div class='col-lg-8 col-md-8 col-sm-8'>
                                                            <div class='numbers'>
                                                                <p Style='font-size:12px; text-align:left; font-weight: bold;'>#$ticketId</p>  
                                                                <p Style='font-size:12px; text-align:left;'>$ticketname</p>
                                                                <p Style='font-size:10px; text-align:left;'>$message</p>
                                                            </div>
                                                        </div>
                                                        <div class='col-lg-3 col-md-3 col-sm-3'>
                                                            <div class='numbers'>
                                                                <p Style='font-size:10px; text-align:left;'>
                                                                    <span class='status bg-success'></span>$Stat
                                                                </p>  
                                                                <p Style='font-size:10px; text-align:left;'>
                                                                    <span class='status red'></span>$prioLvl
                                                                </p>
                                                                <p Style='font-size:12px; text-align:left;'>
                                                                    <i class='fa fa-calendar'></i>
                                                                    $date
                                                                </p>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </a> 
                                            </div>
                                            <div class='text-center card-footer'>
                                                <hr>
                                               
                                            </div>
                                        
                                        </div>
                                    
                                </div>";
                        }elseif($prioLvl == "High"){
                          echo "
                                <div class='col-lg-12 col-md-12 col-sm-12' >
                                        <div class='card card-stats'>
                                            <div class='card-body'>
                                                <a href='Ticket(conversation)?user_id=$ticketId' style='text-decoration:none; color:#000000;'>
                                                    <div class='row'>
                                                        <div class='col-lg-1 col-md-1 col-sm-1'>
                                                            <div class='icon-small text-center icon-warning'>
                                                                <img class='rounded-circle' src='../BulSU.png' alt='' width=42px; hieght=42px;>
                                                            </div>
                                                        </div>
                                                        <div class='col-lg-8 col-md-8 col-sm-8'>
                                                            <div class='numbers'>
                                                                <p Style='font-size:12px; text-align:left; font-weight: bold;'>#$ticketId</p>  
                                                                <p Style='font-size:12px; text-align:left;'>$ticketname</p>
                                                                <p Style='font-size:10px; text-align:left;'>$message</p>
                                                            </div>
                                                        </div>
                                                        <div class='col-lg-3 col-md-3 col-sm-3'>
                                                            <div class='numbers'>
                                                                <p Style='font-size:10px; text-align:left;'>
                                                                    <span class='status bg-success'></span>$Stat
                                                                </p>  
                                                                <p Style='font-size:10px; text-align:left;'>
                                                                    <span class='status bg-danger'></span>$prioLvl
                                                                </p>
                                                                <p Style='font-size:12px; text-align:left;'>
                                                                    <i class='fa fa-calendar'></i>
                                                                    $date
                                                                </p>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </a> 
                                            </div>
                                            <div class='text-center card-footer'>
                                                <hr>
                                                
                                            </div>
                                        
                                        </div>
                                    
                                </div>";
                        }elseif($prioLvl == "Normal"){
                          echo "
                                <div class='col-lg-12 col-md-12 col-sm-12' >
                                        <div class='card card-stats'>
                                            <div class='card-body'>
                                                <a href='Ticket(conversation)?user_id=$ticketId' style='text-decoration:none; color:#000000;'>
                                                    <div class='row'>
                                                        <div class='col-lg-1 col-md-1 col-sm-1'>
                                                            <div class='icon-small text-center icon-warning'>
                                                                <img class='rounded-circle' src='../BulSU.png' alt='' width=42px; hieght=42px;>
                                                            </div>
                                                        </div>
                                                        <div class='col-lg-8 col-md-8 col-sm-8'>
                                                            <div class='numbers'>
                                                                <p Style='font-size:12px; text-align:left; font-weight: bold;'>#$ticketId</p>  
                                                                <p Style='font-size:12px; text-align:left;'>$ticketname</p>
                                                                <p Style='font-size:10px; text-align:left;'>$message</p>
                                                            </div>
                                                        </div>
                                                        <div class='col-lg-3 col-md-3 col-sm-3'>
                                                            <div class='numbers'>
                                                                <p Style='font-size:10px; text-align:left;'>
                                                                    <span class='status bg-success'></span>$Stat
                                                                </p>  
                                                                <p Style='font-size:10px; text-align:left;'>
                                                                    <span class='status bg-success'></span>$prioLvl
                                                                </p>
                                                                <p Style='font-size:12px; text-align:left;'>
                                                                    <i class='fa fa-calendar'></i>
                                                                    $date
                                                                </p>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </a> 
                                            </div>
                                            <div class='text-center card-footer'>
                                                <hr>
                                                
                                            </div>
                                        
                                        </div>
                                    
                                </div>";
                        }else{
                          echo "
                                <div class='col-lg-12 col-md-12 col-sm-12' >
                                        <div class='card card-stats'>
                                            <div class='card-body'>
                                                <a href='Ticket(conversation)?user_id=$ticketId' style='text-decoration:none; color:#000000;'>
                                                    <div class='row'>
                                                        <div class='col-lg-1 col-md-1 col-sm-1'>
                                                            <div class='icon-small text-center icon-warning'>
                                                                <img class='rounded-circle' src='../BulSU.png' alt='' width=42px; hieght=42px;>
                                                            </div>
                                                        </div>
                                                        <div class='col-lg-8 col-md-8 col-sm-8'>
                                                            <div class='numbers'>
                                                                <p Style='font-size:12px; text-align:left; font-weight: bold;'>#$ticketId</p>  
                                                                <p Style='font-size:12px; text-align:left;'>$ticketname</p>
                                                                <p Style='font-size:10px; text-align:left;'>$message</p>
                                                            </div>
                                                        </div>
                                                        <div class='col-lg-3 col-md-3 col-sm-3'>
                                                            <div class='numbers'>
                                                                <p Style='font-size:10px; text-align:left;'>
                                                                    <span class='status bg-success'></span>$Stat
                                                                </p>  
                                                                <p Style='font-size:10px; text-align:left;'>
                                                                    <span class='status bg-info'></span>$prioLvl
                                                                </p>
                                                                <p Style='font-size:12px; text-align:left;'>
                                                                    <i class='fa fa-calendar'></i>
                                                                    $date
                                                                </p>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </a> 
                                            </div>
                                            <div class='text-center card-footer'>
                                                <hr>
                                            
                                                </a>
                                            </div>
                                        </div>
                                </div>";
                                
                        }
                }
              }
        //echo 'You have chosen: ' . $selected;
    } else {
        echo 'Please select the value.';
    }
    }
?>