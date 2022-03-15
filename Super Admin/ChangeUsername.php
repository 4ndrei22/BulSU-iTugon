<?php
  session_start();
  if(!isset($_SESSION['U_unique_id'])){
    header('refresh: 1, url = ../Login');
  }
?>
<?php
    $msg = "";
    if (isset($_POST['submit'])) {
      include 'connect.php';
      $username = $con->real_escape_string($_POST['CurUsername']);
      $newUsername =$con->real_escape_string($_POST['NewUsername']);
      $password = $con->real_escape_string($_POST['CUPassword']);
      if(!empty($newUsername) && !empty($password)){
        $sql = mysqli_query($con, "SELECT * FROM accountcreation WHERE username = '{$username}'");
        if(mysqli_num_rows($sql) > 0){
          $row = mysqli_fetch_assoc($sql);
          $user_pass = md5($password);
          $enc_pass = $row['password'];
          if($user_pass === $enc_pass){
            $sql1 = "UPDATE `accountcreation` SET username = '$newUsername' WHERE username = '$username'";
            mysqli_query($con,$sql1);
            $msg = "update successfully";
            header('refresh: 1, url = ChangeUsername');
          }else{
            $msg = "Incorrect Password";
            header('refresh: 1, url = ChangeUsername');
          }
        }else{
          $msg = "$newUsername - This username already exists";
          header('refresh: 1, url = ChangeUsername');
        }
      }else{
        $msg = "All input fields are required";
        header('refresh: 1, url = ChangeUsername');
      }
    }
 
?>
<?php 
  include "main_header.php";
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
            <li class="">
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
                    <a class="dropdown-item" href="./ChangeUsername">Change Username</a>
                    <a class="dropdown-item" href="./ChangePassword">Change Password</a>
                    <a class="dropdown-item" href="./truncateUser">Logout</a>
                  </div>
                </li>
                
              </ul>
            </div>
          </div>
        </nav>
        <!-- End Navbar -->
        <div class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title"> Change Username </h4>
                </div>
                <div class="card-body">
                <?php 
                      include 'connect.php';
                      $sql = mysqli_query($con, "SELECT * FROM accountcreation WHERE unique_id = {$_SESSION['U_unique_id']}");
                        if(mysqli_num_rows($sql) > 0){
                        $row = mysqli_fetch_assoc($sql);
                      }
                    ?>
                  <?php if ($msg != "") echo $msg . "<br><br>"; ?>
                  <form action="ChangeUsername" method = "post">                  
                    <div class="row">
                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label>Current Username</label>
                          <input type="text" class="form-control" placeholder="Current Username" name="CurUsername" value="<?php echo $row['username']; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label>New Username</label>
                          <input type="text" class="form-control" placeholder="New Username" name="NewUsername" value="">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6 pr-1">
                        <div class="form-group">
                          <label>Password</label>
                          <input type="password" class="form-control" placeholder="password" name="CUPassword" value="">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="update ml-auto mr-auto">
                        <button type="submit" name="submit" class="btn btn-primary btn-round">Change Username</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>

</html>