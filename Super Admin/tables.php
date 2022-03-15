<?php
  session_start();
  if(!isset($_SESSION['U_unique_id'])){
    header('refresh: 1, url = ../Login.php');
  }
?>
<?php
    include 'main_header.php';
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
              <img class="icon-simple" src="images/1645276916blank-profile-picture-973460_1280.png" alt="">
          </div>
        </a>
        <a class="simple-text logo-normal">
          <?php echo $row['firstname']. " "  ?>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class=" ">
            <a href="../Dashboard(super)">
              <i class="fa fa-bank"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="">
            <a href="./AdminCreation">
              <i class="fa fa-plus"></i>
              <p style="font-size: 10px;">Create Employee Account</p>
            </a>
          </li>
          <li>
            <a href="./user">
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
                    <a class="dropdown-item" href="./ChangeUsername.php">Change Username</a>
                    <a class="dropdown-item" href="./ChangePassword.php">Change Password</a>
                    <a class="dropdown-item" href="./truncateUser.php">Logout</a>
                  </div>
                </li>
                
              </ul>
            </div>
          </div>
      </nav>
      <!-- end nav bar -->
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card vh-100" style="max-height:850px; min-height:300px;">
              <div class="card-header">
                <h4 class="card-title"> Staff Responses </h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                                    <?php
                                        require_once("connect.php");
                                        $sql = "SELECT * FROM ticketinfo INNER JOIN accountcreation ON ticketinfo.ticket_assignee = accountcreation.unique_id GROUP BY ticketinfo.ticket_assignee";
                                        $result = mysqli_query($con, $sql);
                                    ?>
                                        <div class="message"><?php if(isset($message)) { echo $message; } ?></div>
                                        <div class="table-responsive">
                                            <table class="table" id="table">
                                                <thread class="text-primary">
                                                        <th>Staff name</th>
                                                        <th>Ticket assigned</th>
                                                        <th>Ticket resolved</th>
                                                        <th>Ticket Closed</th>
                                                </thread>
                                                
                                                <?php
                                                    $i=0;
                                                    while($row = mysqli_fetch_array($result)) {
                                                        $firstname = $row['firstname'];
                                                        $sql1 = "SELECT accountcreation.firstname , COUNT(ticketinfo.status) AS ticketAssigned FROM ticketinfo INNER JOIN accountcreation ON ticketinfo.ticket_assignee = accountcreation.unique_id WHERE ticketinfo.status IN ('Assigned', 'Pending', 'Reopened')  AND ticketinfo.ticket_assignee = '{$row['ticket_assignee']}'";
                                                
                                                        $sql2 = "SELECT accountcreation.firstname , COUNT(ticketinfo.status) AS ticketResolved FROM ticketinfo INNER JOIN accountcreation ON ticketinfo.ticket_assignee = accountcreation.unique_id WHERE ticketinfo.status = 'Resolved' AND ticketinfo.ticket_assignee = '{$row['ticket_assignee']}'";
                                                            
                                                        $sql3 = "SELECT accountcreation.firstname , COUNT(ticketinfo.status) AS ticketClosed FROM ticketinfo INNER JOIN accountcreation ON ticketinfo.ticket_assignee = accountcreation.unique_id WHERE ticketinfo.status = 'Closed' AND ticketinfo.ticket_assignee = '{$row['ticket_assignee']}'";
                                                        $result1 = mysqli_query($con, $sql1);
                                                        $result2 = mysqli_query($con, $sql2);
                                                        $result3 = mysqli_query($con, $sql3);
                                                        if(mysqli_num_rows($result1)>0){
                                                            $row1 = mysqli_fetch_assoc($result1);
                                                            $assigned = $row1['ticketAssigned'];
                                                        }
                                                        if(mysqli_num_rows($result2)>0){
                                                            $row2 = mysqli_fetch_assoc($result2);
                                                            $resolved = $row2['ticketResolved'];
                                                        }
                                                        if(mysqli_num_rows($result3)>0){
                                                            $row3 = mysqli_fetch_assoc($result3);
                                                            $closed = $row3['ticketClosed'];
                                                        }
                                                        
                                                        
                                                        if($i%2==0){
                                                        $classname="evenRow";
                                                        }
                                                        else{
                                                        $classname="oddRow";
                                                        }
                                                ?>
                                                <tbody>
                                                    <tr class="<?php if(isset($classname)) echo $classname;?>">
                                                        <td><?php echo $firstname ?></td>
                                                        <td><?php echo $assigned; ?></td>
                                                        <td><?php echo $resolved; ?></td>
                                                        <td><?php echo $closed; ?></td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div> 
                                        
                                     </div>
                                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {

            setInterval( function() {
                $("#table").load(location.href + " #table");
             }, 1000 );

        });
    </script>
</body>

</html>