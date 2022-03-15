<?php
  session_start();
  include_once 'connect.php';
  if(!isset($_SESSION['U_unique_id'])){
    header('refresh: 1, url = ../Login.php');
  }
?>
<?php 
    if($_GET['user_id']==''){
      if(!(isset($_SESSION['convo_user_id']))){
        header("Location: ./no-chats");
      }
      $_GET['user_id'] = $_SESSION['convo_user_id'];
    }
    $_SESSION['convo_user_id'] = $_GET['user_id'];
    $staff_id = $_SESSION['U_unique_id'];
    $ticket_id = mysqli_real_escape_string($con, $_SESSION['convo_user_id']); //get ticket owner's unique id
    
    $sql = mysqli_query($con, "SELECT * FROM ticketinfo WHERE ticket_id = '{$ticket_id}'"); 
    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_assoc($sql);
        $message = $row['message'];
    }
    $select = mysqli_query($con, "SELECT * FROM accountcreation WHERE unique_id = {$row['ticket_owner']}");
    if(mysqli_num_rows($select) > 0){
        $row1 = mysqli_fetch_assoc($select);
        $_SESSION['ticket_owner'] = $row1['unique_id'];
        $select1 = mysqli_query($con, "SELECT * FROM messages WHERE outgoing_msg_id = {$ticket_id}");
        if(mysqli_num_rows($select1) > 0){
            
        }else{
            $ticket_owner = $_SESSION['ticket_owner'];
            $insert = "UPDATE messages SET incoming_msg_id = {$staff_id} WHERE outgoing_msg_id = {$ticket_owner}";
            mysqli_query($con, $insert);
        }
    }
?>
<?php
include 'message_header.php';
?>
 <body class="">
  <div class="wrapper ">
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
                            <a href="icket(reopened)">Reopened</a>
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
              <a class="navbar-brand" href="javascript:;">BulSU iTugon</a>
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
        <div class="content" style="overflow:hidden;">
            <div class="card card-stats">
                <div class="card-body vh-100"style="max-height:800px; min-height:400px;">
                    <div class="row p-3" style="display: flex;">
                        <div id="convo-list-div" class="col-lg-3 col-md-2 col-sm-2 bg-opacity-25 " style="height: calc(100vh - 42px) !important;">
                            <div class="search col p-4">
                                <input id="input-search" type="text" placeholder="Search name" class="col form-control mx-0 border-secondary">
                                <button hidden><i class="fas fa-search"></i></button>
                            </div>
                            <input type="text" value="" id="convoIncomingId" hidden>
                            <div class="p-2 overflow-auto" style="height: calc(100vh - 128px) !important;">
        
                                <div class="users-list" id="uList">
                        
                                </div>
        
                          </div>
        
                        </div>
                        <div id="convo-div" class="col-lg-6 col-md-6 d-none d-sm-block vh-100"style="max-height:650px; min-height:400px;">
                            <div class="row">
                                <iframe id="chat-box-div" src="./conversation?user_id=" class="w-100 col-md-6 col-lg-6 d-flex flex-column vh-100"style="max-height:750px; min-height:400px;"></iframe>
                            </div>
                            
                        </div>
                        <div id="property-div" class="col-lg-3 col-md-3 col-sm-3 d-none d-sm-block min-vh-100"style="max-height:650; min-height:400px;" >
                            <div class="row">
                                <iframe id="chat-properties-div" src="./properties?user_id=" class="w-100 col-md-6 col-lg-6 d-flex flex-column vh-100"style="max-height:750px; min-height:400px;"></iframe>
                            </div>
                            
                        </div>
                    </div>
                
                    <script src="../javascript/users.js"></script>
                    <script>
                        function showConversation(userid) {
                            document.getElementById('chat-box-div').src = "./conversation?user_id=" + userid;
                            document.getElementById('input-search').value = '';
                            document.getElementById('input-search').dispatchEvent(new KeyboardEvent('keydown',  {'keycode':13}));
                            document.getElementById('convo-div').classList.remove("d-none");
                            document.getElementById('convo-div').classList.remove("d-sm-block");
                            document.getElementById('convo-list-div').classList.add("d-none");
                            document.getElementById('convo-list-div').classList.add("d-sm-block");
                            
                            document.getElementById('chat-properties-div').src = "./properties?user_id=" + userid;
                            document.getElementById('property-div').classList.remove("d-none");
                            document.getElementById('property-div').classList.remove("d-sm-block");
                        
                        }
                        function goBack() {
                            document.getElementById('convo-div').classList.add("d-none");
                            document.getElementById('convo-div').classList.add("d-sm-block");
                            document.getElementById('convo-list-div').classList.remove("d-none");
                            document.getElementById('convo-list-div').classList.remove("d-sm-block");
                         }
                    </script>
                </div>
            </div>
        </div>
    </div>
  </div>
</body>

</html>
