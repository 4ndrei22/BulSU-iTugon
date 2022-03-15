<?php
  session_start();
  if(!isset($_SESSION['U_unique_id'])){
    header('refresh: 1, url = ../Login');
  }
?>
<?php
    if(isset($_POST['submit'])){
    if(!empty($_POST['priority'])) {
        $selectedprio = $_POST['priority'];
        if($selectedprio == 'All'){
            $sortingcondition2 ;
        }else{
            $sortingcondition2= "AND ticketinfo.priority_lvl = '$selectedprio'";
        }
        
        //echo 'You have chosen: ' . $selected;
    }
    }
?>
<?php
include "Ticket_header.php";
?>
<body>
  <div class="wrapper">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
          <a class="simple-text logo-mini">
            <div class="logo-image-small">
              <?php 
                include 'connect.php';
                $sql = mysqli_query($con, "SELECT * FROM accountcreation WHERE unique_id = {$_SESSION['U_unique_id']}");
                  if(mysqli_num_rows($sql) > 0){
                  $row = mysqli_fetch_assoc($sql);
                }
                ?>
                <img class="icon-simple" src="images/blank-profile-picture-973460_1280.png" alt="">
            </div>
          </a>
          <a class="simple-text logo-normal">
            <?php echo $row['firstname']. " "  ?>
          </a>
        </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
                    <li class="">
                        <a href="../Dashboard(staff)">
                            <i class="fa fa-bank"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="dropdown ">
                        <a class="dropbtn active " >
                            <i class="fa fa-ticket"></i>
                            Tickets &nbsp; &nbsp;
                            <span class="fa fa-caret-down"></span>
                        </a>
                        <div class="dropdown-content" >
                            <a href="Ticket(open)">Open</a>
                            <a href="Ticket(assigned)">Assigned</a>
                            <a href="Ticket(Pending)">Pending</a>
                        </div>
                    </li>
                    <li>
                        <a href="FAQs">
                            <i class="fa fa-book"></i>
                            <p>Knowledgebase</p>
                        </a>
                    </li>
                    <li>
                        <a href="user">
                            <i class="fa fa-user"></i>
                            <p>User Profile</p>
                        </a>
                    </li>
                </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- nav bar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top" Style="background-color: #671e1e;">
          <div class="container-fluid">
            <div class="navbar-wrapper">
              <div class="navbar-toggle">
                <button type="button" class="navbar-toggler">
                  <span class="navbar-toggler-bar bar1"></span>
                  <span class="navbar-toggler-bar bar2"></span>
                  <span class="navbar-toggler-bar bar3"></span>
                </button>
              </div>
              <a class="" style="font-size:20px;">BulSU iTugon</a>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-bar navbar-kebab"></span>
              <span class="navbar-toggler-bar navbar-kebab"></span>
              <span class="navbar-toggler-bar navbar-kebab"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navigation">
              <ul class="navbar-nav">
                <li class="nav-item btn-rotate dropdown">
                  <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user-circle"></i>
                    <p>
                      <span class="d-lg-none d-md-block">Some Actions</span>
                    </p>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item" href="./ChangeUsername">Change Username</a>
                    <a class="dropdown-item" href="./ChangePassword">Change Password</a>
                    <a class="dropdown-item" href="./truncateUser">Logout</a>
                  </div>
                </li>
                
              </ul>
            </div>
          </div>
      </nav>
      <!-- end nav bar -->
     <div class="content" id="openTickets">
          <div class="Header pb-4">
            <h2>
              Reopened Tickets
            </h2>
            <form action="" method="post">
                <div class="row">
                    <div class="col-lg-2 col-md-2 pr-1 pt-2">
                        <div class="form-group">
                            <select class="form-control " name="priority">
                                <option value="" disabled selected>Sort Priority</option>
                                <option value="Urgent">Urgent</option>
                                <option value="High">High</option>
                                <option value="Normal">Normal</option>
                                <option value="Low">Low</option>
                                <option value="All">All</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 pl-1">
                        <div class="form-group">
                            <input class="btn text-white" type="submit" name="submit" value="Sort tickets"style="height:41px; background-color: #671e1e;">
                        </div>
                    </div>
                </div>
                
                
            </form>
          </div>
          <div class="row" id="ticket-list-div">
            <?php
              include 'connect.php';
              $sql = "SELECT 
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
                    INNER JOIN accountcreation ON accountcreation.unique_id = ticketinfo.ticket_owner WHERE ticketinfo.ticket_assignee =  {$_SESSION['U_unique_id']} $sortingcondition2";
              $result = mysqli_query($con,$sql);
              if(mysqli_num_rows($result) > 0){
                    while ($row = mysqli_fetch_array($result)){
                        
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
                        if($Stat == "Reopened"){
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
                                                                    <span class='status bg-warning'></span>$Stat
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
                                                                    <span class='status bg-warning'></span>$Stat
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
                                                                    <span class='status bg-warning'></span>$Stat
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
                                                                    <span class='status bg-warning'></span>$Stat
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
              }
                                  
            ?>
          </div>
      </div>

    </div>
  </div>
  <!-- <script src="../JS Files/users.js"></script> -->
</body>