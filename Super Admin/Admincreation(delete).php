<?php
  session_start();
  if(!isset($_SESSION['U_unique_id'])){
    header('refresh: 1, url = ../Login.php');
  }
?>
<?php
require_once("connect.php");
// Process delete operation after confirmation
if(isset($_POST["id"]) && !empty($_POST["id"]) ){
    $enable = $_POST["enable"];
    $disable = $_POST["disable"];
    if($disable=="Disable"){
        $sql = "UPDATE accountcreation SET status = 'Disable' WHERE unique_id='" . $_POST["id"] . "'";
        $delete = mysqli_query($con,$sql);
        if($delete){
            $msg = "Account successfully disable";
            header('refresh: 1, url = AdminCreation');
        }else{
            $msg = "unable to delete";
            header('refresh: 1, url = AdminCreation');
        }
    }elseif($enable=="Enable"){
        $sql = "UPDATE accountcreation SET status = 'Enable' WHERE unique_id='" . $_POST["id"] . "'";
        $delete = mysqli_query($con,$sql);
        if($delete){
            $msg = "Account successfully enable";
            header('refresh: 1, url = AdminCreation');
        }else{
            $msg = "unable to delete";
            header('refresh: 1, url = AdminCreation');
        }
    }else{
        $msg = "unable to change {$_POST["enable"]}{$_POST["disable"]}";
        header('refresh: 1, url = AdminCreation');
    }
}else{
    // Check existence of id parameter
    if(empty(trim($_GET["userId"]))){
        // URL doesn't contain id parameter. Redirect to error page
        //header("location: Admincreation(delete)");
        exit();
    }
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
  <link href="../CSS Files/Staff_Dashboard.css" rel="stylesheet" />
  <link href="../CSS Files/demo.css" rel="stylesheet" />
  <link href="../CSS Files/AssignedTicket.css" rel="stylesheet" />
  <!-- JS Files -->
  <script src="../JS Files/core/jquery.min.js"></script>
  <script src="../JS Files/core/popper.min.js"></script>
  <script src="../JS Files/core/bootstrap.min.js"></script>
  <script src="../JS Files/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../JS Files/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../JS Files/Staff_Dashboard.min.js?v=2.0.1" type="text/javascript"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
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
              <img class="icon-simple" src="images/1645276916blank-profile-picture-973460_1280.png" alt="">
          </div>
        </a>
        <a class="simple-text logo-normal">
          <?php echo $row['firstname']. " "  ?>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
                    <li>
                        <a href="../Dashboard(super)">
                            <i class="fa fa-bank"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li  class="active">
                        <a href="AdminCreation">
                            <i class="fa fa-book"></i>
                            <p>Account Creation</p>
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
      <!-- End Navbar -->
      <div class="content" style="margin-top:9%;">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card card-user">
              <div class="card-header ">
                <h5 class=" card-title">
                  Delete account &nbsp; &nbsp;
                </h5>
                <?php if ($msg != "") echo "<h5 class='errormsg'>$msg </h5> "; ?>
              </div>
              <div class="card-body">
                    <form action="Admincreation(delete)" method="post">
                        <div class="alert "Style="background-color: #671e1e;">
                            <input type="hidden" name="id" value="<?php echo $_GET["userId"]; ?>"/>
                            <input type="hidden" name="btnClick" value="submit"/>
                            <p>Do you want to enable/disable this account?</p>
                            <p>
                                <input type="submit" value="Enable" name="enable" class="btn btn-danger">
                                <input type="submit" value="Disable" name="disable" class="btn btn-danger">
                                <a href="AdminCreation" class="btn btn-secondary">Cancel</a>
                            </p>
                        </div>
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
