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
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
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
            <div class="card vh-100" style="max-height:850px; min-height:300px; overflow:auto;">
              <div class="card-header">
                <h4 class="card-title"> BulSU iTugon Mobile App Feedback</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                                    <?php
                                        require_once("connect.php");
                                        $sqlQuery = "SELECT * FROM app_rating INNER JOIN accountcreation ON app_rating.user_id = accountcreation.unique_id ORDER BY app_rating.id DESC";
                                        $result = mysqli_query($con,$sqlQuery);
                                        if(mysqli_num_rows($result) > 0){
                                           
                                        }
                                    ?>
                                        <div class="message"><?php if(isset($message)) { echo $message; } ?></div>
                                        <div class="table-responsive">
                                            <table class="table" >
                                                <thread class="text-primary">
                                                        <th>Name</th>
                                                        <th>Rating</th>
                                                        <th>Comments and Suggestion</th>
                                                </thread>
                                                
                                                <?php
                                                    $i=0;
                                                    while($row = mysqli_fetch_array($result)) {
                                                        
                                                        
                                                        
                                                        if($i%2==0){
                                                        $classname="evenRow";
                                                        }
                                                        else{
                                                        $classname="oddRow";
                                                        }
                                                ?>
                                                <tbody>
                                                    <tr class="<?php if(isset($classname)) echo $classname;?>">
                                                        <td><?php echo $row['firstname']." ".$row['lastname'] ?></td>
                                                        <td><?php echo $row['rating']; ?></td>
                                                        <td class="text-wrap"style="word-wrap: break-word; "><?php echo $row['suggestions']; ?></td>
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
</body>

</html>