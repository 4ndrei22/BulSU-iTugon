<?php
  session_start();
  if(!isset($_SESSION['U_unique_id'])){
    header('refresh: 1, url = ../Login.php');
  }
?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8" />
    <link rel="icon" type="image/png" href="../BulSU.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
      BulSU iTugon
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="../CSS Files/bootstrap.min.css" rel="stylesheet" />
    <link href="../CSS Files/Staff_Dashboard.css?v=2.0.1" rel="stylesheet" /> 
    <link href="../CSS Files/demo.css" rel="stylesheet" />
    <!-- JS Files -->
    <script src="../JS Files/Autocomplete.js"></script>
    <script src="../JS Files/core/jquery.min.js"></script>
    <script src="../JS Files/core/popper.min.js"></script>
    <script src="../JS Files/core/bootstrap.min.js"></script>
    <script src="../JS Files/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="../JS Files/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../JS Files/Staff_Dashboard.min.js?v=2.0.1" type="text/javascript"></script>
    <script src="js/get_question_data.js"></script>	
  </head>

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
              <img class="icon-simple" src="images/<?php echo $row['img']; ?>" alt="">
          </div>
        </a>
        <a class="simple-text logo-normal">
          <?php echo $row['firstname']. " "  ?>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
                    <li >
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
                            <a href="Ticket(Pending)">Pending</a>
                            <a href="icket(reopened)">Reopened</a>
                        </div>
                    </li>
                    <li class="active">
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
      <!-- Navbar -->
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
                  <a class="dropdown-item" href="./ChangeUsername.php">Change Username</a>
                  <a class="dropdown-item" href="./ChangePassword.php">Change Password</a>
                  <a class="dropdown-item" href="./truncateUser.php">Logout</a>
                </div>
              </li>
              
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
        <div class="content" style="margin-top:9%;">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card card-user" >
                        <div class="card-header">
                            <h5 class="card-title">
                              FAQs &nbsp; &nbsp;
                            </h5>
                            <p>Please edit the input values and submit to update the employee record.</p>
                            <span><?php echo $errormsg ?></span>
                         </div>
                         <div class="card-body">
                             <?php
                            require_once("connect.php");
                            $sql = "SELECT * FROM knowledgebase ORDER BY id DESC";
                            $result = mysqli_query($con,$sql);
                        ?>
                        <form name="frmUser" method="post" action="">
                            <div class="max-vw-100"Style="overflow-y: scroll;>
                            <div class="message"><?php if(isset($message)) { echo $message; } ?></div>
                            <div align="right" style="padding-bottom:5px;"><a href="FAQs(create).php" class="link"><img alt='Add' title='Add' src='images/add.png' width='15px' height='15px'/> Add User</a></div>
                            <table class="tblListForm table" ">
                                <thread>
                                    <tr>
                                        <td>Id</td>
                                        <td>Question</td>
                                        <td>Answer</td>
                                        <td>CRUD Actions</td>
                                    </tr>
                                </thread>
                                
                                <?php
                                    $i=0;
                                    while($row = mysqli_fetch_array($result)) {
                                    if($i%2==0)
                                    $classname="evenRow";
                                    else
                                    $classname="oddRow";
                                ?>
                                <tbody>
                                    <tr class="<?php if(isset($classname)) echo $classname;?>">
                                        <td><?php echo $row["id"]; ?></td>
                                        <td><?php echo $row["question"]; ?></td>
                                        <td><?php echo $row["answer"]; ?></td>
                                        <td><a href="FAQs(update)?userId=<?php echo $row["id"]; ?>" class="link"><img alt='Edit' title='Edit' src='images/edit.png' width='15px' height='15px' hspace='10' /></a>  <a href="FAQs(Delete)?userId=<?php echo $row["id"]; ?>"  class="link"><img alt='Delete' title='Delete' src='images/delete.png' width='15px' height='15px'hspace='10' /></a></td>
                                    </tr>
                                    <?php
                                    $i++;
                                    }
                                    ?>
                                </tbody>
                            
                            </table>
                        </form>
                         </div>
                         
                			
                
                    </div>
                </div>
            </div>
        </div>
      <footer class="footer footer-black  footer-white ">
        <div class="container-fluid">
          <div class="row">
            <nav class="footer-nav">

            </nav>
            <div class="credits ml-auto">

            </div>
          </div>
        </div>
      </footer>
    </div>
      </div>
 
</body>

</html>