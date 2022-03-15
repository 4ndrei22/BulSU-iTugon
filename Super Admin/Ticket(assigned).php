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
    $user_id = mysqli_real_escape_string($con, $_SESSION['convo_user_id']); //get ticket owner's unique id
    
    $sql = mysqli_query($con, "SELECT * FROM accountcreation WHERE unique_id = {$user_id}"); 
    if(mysqli_num_rows($sql) > 0){
      $row = mysqli_fetch_assoc($sql);
      $select = mysqli_query($con, "SELECT * FROM ticketinfo WHERE ticket_owner = {$user_id}");
        if(mysqli_num_rows($select) > 0){
            $row1 = mysqli_fetch_assoc($select);
            $message = $row1['message'];
            $select1 = mysqli_query($con, "SELECT * FROM messages WHERE incoming_msg_id = {$user_id}");
            if(mysqli_num_rows($select1) > 0){
                
            }else{
                $insert = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg,ticket_id) VALUES ({$staff_id},{},'$message',{$row1['ticket_id']})";
                mysqli_query($con, $insert);
            }
        }
        
    }
?>
<?php
include 'message_header.php';
?>
 <body class=""> <!--style="overflow:hidden;"> -->
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
              <img class="icon-simple" src="images/<?php echo $row['img']; ?>" alt="">
          </div>
        </a>
        <a class="simple-text logo-normal">
          <?php echo $row['firstname']. " "  ?>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="active">
                <a href="../Dashboard(super)">
                    <i class="fa fa-bank"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="">
                <a href="AdminCreation">
                    <i class="fa fa-plus"></i>
                    <p style="font-size: 10px;">Create Employee Account</p>
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
      <div class="content pt--5" >
        <div class="card card-stats">
          <div class="card-body">
            <div class="row p-0" style="display: flex;">
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
                <div id="convo-div" class="col-lg-6 col-md-6 position-relative d-none d-sm-block">
                    <iframe id="chat-box-div" src="./conversation?user_id=" class="w-100 col-md-6 col-lg-6 d-flex flex-column min-vh-100"></iframe>
                    <div class="position-absolute top-0 start-0 ms-2 d-block d-sm-none">
                        <a class="link-primary"  href="javascript:goBack()" style="font-size: 30px"><i class="fa fa-arrow-left"></i></a>
                    </div>
                </div>
                <div id="property-div" class="col-lg-3 col-md-3 col-sm-3 d-none d-sm-block">
                    <iframe id="chat-properties-div" src="./properties?user_id=" class="w-100 col-md-6 col-lg-6 d-flex flex-column min-vh-100"></iframe>
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
