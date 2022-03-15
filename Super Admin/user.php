<?php
  session_start();
  if(!isset($_SESSION['U_unique_id'])){
    header('refresh: 1, url = ../Login.php');
  }
?>
<?php
    $msg = "";
    if (isset($_POST['submit'])) {
      include'connect.php';
      $firstname = $con->real_escape_string($_POST['firstname']);
      $lastname =$con->real_escape_string($_POST['lastname']);
      $email = $con->real_escape_string($_POST['email']);
      $contactnum = $con->real_escape_string($_POST['ContactNumber']);

      //if(!empty($firstname) && !empty($lastname) && !empty($email) && !empty($contactnum)){
        $sql = mysqli_query($con, "SELECT * FROM accountcreation WHERE unique_id = {$_SESSION['U_unique_id']}");
        if(mysqli_num_rows($sql) > 0){
          $row = mysqli_fetch_assoc($sql);
          $db_firstname = $row['firstname'];
          $db_lastname = $row['lastname'];
          $db_email = $row['email'];
          $db_contact = $row['contactNum'];
          if($db_firstname === $firstname || $db_lastname === $lastname || $db_email === $email||$db_contact === $contactnum){
            $sql1 = "UPDATE `accountcreation` SET firstname = '{$firstname}', lastname = '{$lastname}', email = '{$email}', contactnum = '{$contactnum}'
                      WHERE firstname = '{$db_firstname}'";
            mysqli_query($con,$sql1);
            $msg = "update successfully";
            header('refresh: 1, url = user');
          }else{
            $msg = "Incorrect Password";
            header('refresh: 1, url = user');
          }
        }else{
          $msg = "$email - This username already exists";
          header('refresh: 1, url = user');
          
        }
      //}else{
        //$msg = "All input fields are required";
        //header('refresh: 1, url = user');
      //}
    } 
?>
<?php 
  include "main_header.php";
?>
<body class="max-vh-100" style="overflow:auto;">
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
            <ul class="nav">
            <li>
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
            <li class="active">
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
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-user">
              <div class="image"> 
                <!-- <img src="../assets/img/damir-bosnjak.jpg" alt="..." > -->
              </div>
              <div class="card-body">
                <div class="author">
                    <?php 
                      include 'connect.php';
                      $sql = mysqli_query($con, "SELECT * FROM accountcreation WHERE unique_id = {$_SESSION['U_unique_id']}");
                        if(mysqli_num_rows($sql) > 0){
                        $row = mysqli_fetch_assoc($sql);
                      }
                    ?>
                    <img class="avatar border-gray" src="images/1645276916blank-profile-picture-973460_1280.png" alt="">
                
                    <h5 style =  'text-transform: uppercase;'><?php echo $row['firstname']." ".$row['lastname']?></h5>
                    <?php if ($msg != "") echo "<h5 class='errormsg'>$msg </h5> "; ?>
                  <!-- <form action="./ChangeInfo.php" method="post">   -->
                  <form action="./user.php" method="post">                  
                    <div class="row">
                      <div class="col-md-3" style="margin-left: 24%;">
                        <div class="form-group">
                          <label for="fname">First Name</label>
                          <input type="text" class="form-control" placeholder="First Name" value="<?php echo $row['firstname'] ?>" name="firstname" required>
                        </div>
                      </div>
                      <div class="col-md-3" style="margin-left: 2%;">
                        <div class="form-group">
                          <label for="lname">Last Name</label>
                          <input type="text" class="form-control" placeholder="Last Name" value="<?php echo $row['lastname'] ?>" name="lastname" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-3" style="margin-left: 24%;">
                        <div class="form-group">
                          <label for="email">Email</label>
                          <input type="text" class="form-control" placeholder="Email" value="<?php echo $row['email']; ?>" name="email" required>
                        </div>
                      </div>
                      <div class="col-md-3" style="margin-left: 2%;">
                        <div class="form-group">
                          <label for="contactnum">Contact Number</label>
                          <input type="text" class="form-control" placeholder="Contact Number" value="<?php echo $row['contactNum']; ?>" name="ContactNumber" required>
                        </div>
                      </div>
                    </div>
                    
                    <div class="row">
                      <div class="update ml-auto mr-auto">
                        <button type="submit" name="submit" class="btn btn-primary btn-round">Update Profile</button>
                      </div>
                    </div>
                  </form>
                </div>
                <p class="description text-center">
                </p>
              </div>
              <div class="card-footer">
                <hr>
                <div class="button-container">
                </div>
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
