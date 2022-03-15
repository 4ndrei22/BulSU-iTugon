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
  <link rel="icon" type="image/png" href="../Image Files/Logo/BulSU.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    BulSU iTugon
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="../CSS Files/Staff_Dashboard.css" rel="stylesheet" />
  <link href="../CSS Files/demo.css" rel="stylesheet" />
  <link href="../CSS Files/AssignedTicket.css" rel="stylesheet" />

  <script src="../JS Files/goto msg/msg(pending).js"></script>
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
          <li class=" ">
            <a href="../Dashboard(super).php">
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
                <a href="./Ticket(open).php">Open</a>
                <a href="./Ticket(Pending).php">Pending</a>
                <a href="./Ticket(reopened).php">Reopened</a>
              </div>
          </li>
          <li>
            <a href="./FAQs(create).php">
              <i class="fa fa-book"></i>
              <p>Knowledgebase</p>
            </a>
          </li>
          <li class="">
            <a href="./AdminCreation.php">
              <i class="fa fa-plus"></i>
              <p style="font-size: 10px;">Create Employee Account</p>
            </a>
          </li>
          <li>
            <a href="./user.php">
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
      <div class="content" >
        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-9">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                    <div class="col" id="FirstCol">
                        <header>
                            <h2>Pending Tickets</h2>
                            <input type="text" placeholder="search"   class="fa fa-search">
                        </header>
                        <ul>
                          <li onclick="AssignedFunction();">
                              <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/chat_avatar_01.jpg" alt="">
                              <div>
                                <h2>Prénom Nom
                          <span class="status"></span>
                          #00015
                        </h2>
                                <h3>
                                  <span class="status yellow"></span>
                                  Pending &nbsp; &nbsp;
                                  <span class="status orange"></span>
                                  Urgent
                                </h3>
                              </div>
                            </li>
                            <li>
                              <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/chat_avatar_02.jpg" alt="">
                              <div>
                                <h2>Prénom Nom
                          <span class="status"></span>
                          #00014
                        </h2>
                                <h3>
                                  <span class="status yellow"></span>
                                  Pending &nbsp; &nbsp;
                                  <span class="status blue"></span>
                                  Low
                                </h3>
                             </div>
                            </li>
                            <li>
                              <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/chat_avatar_02.jpg" alt="">
                              <div>
                                <h2>Prénom Nom
                          <span class="status"></span>
                          #00013
                        </h2>
                                <h3>
                                  <span class="status yellow"></span>
                                  Pending &nbsp; &nbsp;
                                  <span class="status green"></span>
                                  Normal
                                </h3>
                             </div>
                            </li>
                            <li>
                              <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/chat_avatar_02.jpg" alt="">
                              <div>
                                <h2>Prénom Nom
                          <span class="status"></span>
                          #00012
                        </h2>
                                <h3>
                                  <span class="status yellow"></span>
                                  Pending &nbsp; &nbsp;
                                  <span class="status green"></span>
                                  Normal
                                </h3>
                             </div>
                            </li>
                            
                          </ul>
                    </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <!-- <i class="fa fa-refresh"></i>
                  Update Now -->
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-4 col-sm-1" id="SecondCol1" >
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col" id="SecondCol">
                    <header>
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/1940306/chat_avatar_01.jpg" alt="">
                        <div>
                          <h2>Chat with Prénom Nom</h2>
                          <h3>already 2 messages</h3>
                          <h3 style="color:black; font-weight:bold;">#0001</h3>
                        </div>
                      </header>
                      <ul id="chat">
                        <li class="you">
                          <div class="entete">
                            <span class="status green"></span>
                            <h2>Prénom</h2>
                            <h3>10:12AM, Today</h3>
                          </div>
                          <div class="triangle"></div>
                          <div class="message">
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                          </div>
                        </li>
                        <li class="me">
                          <div class="entete">
                            <h3>10:12AM, Today</h3>
                            <h2>Prénom</h2>
                            <span class="status blue"></span>
                          </div>
                          <div class="triangle"></div>
                          <div class="message" id="me">
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                          </div>
                        </li>
                        <li class="me">
                          <div class="entete">
                            <h3>10:12AM, Today</h3>
                            <h2>Prénom</h2>
                            <span class="status blue"></span>
                          </div>
                          <div class="triangle"></div>
                          <div class="message" id="me">
                            OK
                          </div>
                        </li>
                        <li class="you">
                          <div class="entete">
                            <span class="status green"></span>
                            <h2>Prénom</h2>
                            <h3>10:12AM, Today</h3>
                          </div>
                          <div class="triangle"></div>
                          <div class="message">
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                          </div>
                        </li>
                        <li class="me">
                          <div class="entete">
                            <h3>10:12AM, Today</h3>
                            <h2>Prénom</h2>
                            <span class="status blue"></span>
                          </div>
                          <div class="triangle"></div>
                          <div class="message" id="me">
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                          </div>
                        </li>
                        <li class="me">
                          <div class="entete">
                            <h3>10:12AM, Today</h3>
                            <h2>Prénom</h2>
                            <span class="status blue"></span>
                          </div>
                          <div class="triangle"></div>
                          <div class="message" id="me">
                            OK
                          </div>
                        </li>
                      </ul>
                      <div class="chat-box-tray">
                        <i class="fa fa-smile-o"></i>
                        <input type="text" placeholder="Type your message here...">
                        <i class="fa fa-microphone"></i>
                        <i class="fa fa-send"></i>
                      </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <!-- <i class="fa fa-refresh"></i>
                  Update Now -->
                </div>
              </div>
            </div>
          </div>
          <!-- <div class="col-lg-3 col-md-3 col-sm-9" id="ThirdCol1">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                    <div class="col" id="ThirdCol">
                        <header>
                            <h2>Properties</h2>
                        </header>
                        <ul>
                            <li>
                                <div>
                                  <div class="dropdown" style="width: 330px; padding-left: 10px;">
                                    <h4 style="padding-left: 5px; color: black; font-size:18">Prioritization</h4>
                                    <div class="dropdown">
                                        <button onclick="Prioritization()" class="dropbtn">Low</button>
                                        <div id="myDropdown" class="dropdown-content">
                                          <a href="#home">Low</a>
                                          <a href="#about">Normal</a>
                                          <a href="#contact">Important</a>
                                          <a href="#contact">Urgent</a>
                                        </div>
                                      </div>
                                  </div>
                                </div>
                              </li>
                              <li>
                                <div>
                                  <div class="dropdown" style="width: 330px; padding-left: 10px;">
                                    <h4 style="padding-left: 5px; color: black; font-size:18">Status</h4>
                                    <div class="dropdown">
                                        <button onclick="Status()" class="dropbtn">Low</button>
                                        <div id="myDropdown" class="dropdown-content">
                                          <a href="#home">Open</a>
                                          <a href="#about">On Process</a>
                                          <a href="#contact">Resolved</a>
                                          <a href="#contact">Resolved</a>
                                        </div>
                                      </div>
                                  </div>
                                </div>
                              </li>
                              <li>
                                <div>
                                  <div class="dropdown" style="width: 330px; padding-left: 10px;">
                                    <h4 style="padding-left: 5px; color: black; font-size:18">Forwarded to office concern</h4>
                                    <div class="dropdown">
                                        <button onclick="forwarded()" class="dropbtn">Low</button>
                                        <div id="Forwarded" class="dropdown-content">
                                          <a href="#home">Admission Concern</a>
                                          <a href="#about">Enrollment Concern</a>
                                          <a href="#contact">Grade Concern</a>
                                          <a href="#contact">Document Concern</a>
                                        </div>
                                      </div>
                                  </div>
                                </div>
                              </li>
                              <li>
                                <div>
                                  <button type="button" class="btn btn-light btn-lg"
                                  style="margin-left: 10px; width:320px;">Done</button>
                                </div>
                              </li>
                        </ul> -->
                    </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <!-- <i class="fa fa-ticket"></i>
                  Tickets Unopened -->
                </div>
              </div>
            </div>
          </div> -->
        </div>    
      </div>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
      demo.initChartsPages();
    });
  </script>
  <script>
    var Priovalue = ["Open", "On Process", "Resolved", "Closed"];
    var Priopercent = [55, 49, 44, 24];
    var barColors = [
      "#0275d8",
      "#f0ad4e",
      "#d9534f",
      "#5bc0de",
    ];
    
    new Chart("piechart", {
      type: "pie",
      data: { Priovalue,
        datasets: [{
          backgroundColor: barColors,
          data: Priopercent
        }]
          },
          options: {
            title: {
              display: true,
              text: "",
              fontSize: 16
            }
          }
        });
    </script>
  <script>
    var xValues = ["Admission", "Enrollment", "Grade", "Document"];
    var yValues = [55, 49, 44, 24];
    var barColors = ["red", "green","blue","orange"];

    new Chart("barGraph", {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        legend: {display: false},
        title: {
        display: true,
        text: "",
        fontSize: 16
        }
      }
      });
  </script>
  <script>
    var xValues = ["Jan", "Feb", "Mar", "Apr","May", "Jun", "Jul", "Aug","Sep", "Oct", "Nov", "Dec",];
    var yValues = [20, 39, 44, 24,55, 49, 25, 48,55, 49, 17, 19];
    var barColors = ["skyblue", "skyblue","skyblue","skyblue","skyblue", "skyblue","skyblue","skyblue","skyblue", "skyblue","skyblue","skyblue"];

    new Chart("Monthly barGraph", {
      type: "bar",
      data: {
        labels: xValues,
        datasets: [{
          backgroundColor: barColors,
          data: yValues
        }]
      },
      options: {
        legend: {display: false},
        title: {
        display: true,
        text: "",
        fontSize: 16
        }
      }
      });
  </script>
</body>

</html>
