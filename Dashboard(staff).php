<?php
  session_start();
  if(!isset($_SESSION['U_unique_id'])){
    header('refresh: 1, url = /');
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
  <link href="./CSS Files/bootstrap.min.css" rel="stylesheet" />
  <link href="./CSS Files/Staff_Dashboard.css" rel="stylesheet" />
  <link href="./CSS Files/demo.css" rel="stylesheet" />
  <!-- JS Files -->
  <script src="./JS Files/onClick(staff)/StaffAssigned(onClick).js"></script>
  <script src="./JS Files/onClick(staff)/StaffOpenTicket(onClick).js"></script>
  <script src="./JS Files/onClick(staff)/StaffReopened(onClick).js"></script>
  <script src="./JS Files/onClick(staff)/StaffPending(onClick).js"></script>
  <script src="./JS Files/onClick(staff)/StaffResolved(onClick).js"></script>
  <script src="./JS Files/onClick(staff)/StaffClosed(onClick).js"></script>
  <script src="./JS Files/core/jquery.min.js"></script>
  <script src="./JS Files/core/popper.min.js"></script>
  <script src="./JS Files/core/bootstrap.min.js"></script>
  <script src="./JS Files/core/perfect-scrollbar.jquery.min.js"></script>
  <!-- Chart JS -->
  <script src="./JS Files/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="./JS Files/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="./JS Files/Staff_Dashboard.min.js?v=2.0.1" type="text/javascript"></script>
  <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="./JS Files/demo.js"></script>
  <script src="./JS Files/openTickets.js"></script>
  <!-- PHP Files -->
  
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
                        <img class="icon-simple" src="./Staff/images/blank-profile-picture-973460_1280.png" alt="">
                    </div>
                </a>
                <a class="simple-text logo-normal">
                    <?php echo $row['firstname']. " "  ?>
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="active">
                        <a href="./Dashboard(staff)">
                            <i class="fa fa-bank"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    
                    <li>
                        <a href="./Staff/FAQs">
                            <i class="fa fa-book"></i>
                            <p>Knowledgebase</p>
                        </a>
                    </li>
                    <li>
                        <a href="./Staff/user">
                            <i class="fa fa-user"></i>
                            <p>User Profile</p>
                        </a>
                    </li>
                    <li class="dropdown ">
                        <a class="dropbtn active " >
                            <i class="fa fa-ticket"></i>
                            Tickets &nbsp; &nbsp;
                            <span class="fa fa-caret-down"></span>
                        </a>
                        <div class="dropdown-content" >
                            <a href="./Staff/Ticket(open)">Open</a>
                            <a href="./Staff/Ticket(assigned)">Assigned</a>
                            <a href="./Staff/Ticket(Pending)">Pending</a>
                        </div>
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
                                    <a class="dropdown-item" href="./Staff/ChangeUsername.php">Change Username</a>
                                    <a class="dropdown-item" href="./Staff/ChangePassword.php">Change Password</a>
                                    <a class="dropdown-item" href="./Staff/truncateUser.php">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content" style="margin-top:9%">
                <!-- Stats and Ticket -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4"id="ActiveTicket">
                                <a href="./Staff/Ticket(due_today)" style="text-decoration:none;">
                                    <div class="card card-stats " style="background-color:#ff9933;">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-2 col-sm-2" >
                                                    <div class="icon-big text-center icon-warning">
                                                        <i class="fa fa-calendar-check-o text-white"></i>
                                                    </div>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-10">
                                                    <div class="numbers" id="due_today">
                                                        <?php
                                                            include 'connect.php';
                                                            $stat = "SELECT COUNT(date_needed) AS due_today FROM ticketinfo WHERE date_needed IN (CURRENT_DATE, CURRENT_DATE) AND ticketinfo.ticket_assignee = '{$_SESSION['U_unique_id']}' AND NOT ticketinfo.status = 'Closed'";
                                                            $result = mysqli_query($con, $stat);
                                                            if (mysqli_num_rows($result) > 0) {
                                                                // Return the number of rows in result set
                                                                $row = mysqli_fetch_assoc($result);
                                                                $count = $row['due_today'];
                                                            }
                                                        ?>
                                                        <p class="card-category text-white">Due Today</p>
                                                        <p class="card-title text-white"id="ticket_today" style="font-size:28px;"><?php echo $count; ?><p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer ">
                                            <hr>
                                            <div class="stats">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4"id="ActiveTicket">
                                <a href="./Staff/Ticket(due_tomorrow)" style="text-decoration:none;">
                                    <div class="card card-stats " style="background-color:#ff9999;">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-2 col-sm-2" >
                                                    <div class="icon-big text-center icon-warning">
                                                        <i class="fa fa-calendar-o text-white"></i>
                                                    </div>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-10">
                                                    <div class="numbers" id="due_tomorrow">
                                                        <?php
                                                            include 'connect.php';
                                                            $stat = "SELECT COUNT(date_needed) AS due_tomorrow FROM ticketinfo WHERE date_needed IN (CURRENT_DATE, CURRENT_DATE + INTERVAL 1 DAY) AND ticketinfo.ticket_assignee = '{$_SESSION['U_unique_id']}' AND NOT ticketinfo.status = 'Closed'";
                                                            $result = mysqli_query($con, $stat);
                                                            if (mysqli_num_rows($result) > 0) {
                                                                // Return the number of rows in result set
                                                                $row = mysqli_fetch_assoc($result);
                                                                $count = $row['due_tomorrow'];
                                                            }
                                                        ?>
                                                        <p class="card-category text-white">Due Tomorrow</p>
                                                        <p class="card-title text-white"id="ticket_tomorrow" style="font-size:28px;"><?php echo $count; ?><p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer ">
                                            <hr>
                                            <div class="stats">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4"id="ActiveTicket">
                                <a href="./Staff/Ticket(over_due)" style="text-decoration:none;">
                                    <div class="card card-stats" style="background-color:#800000;">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-2 col-sm-2" >
                                                    <div class="icon-big text-center icon-warning">
                                                        <i class="fa fa-calendar-times-o text-white"></i>
                                                    </div>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-10">
                                                    <div class="numbers" id="refresh">
                                                        <?php
                                                            include 'connect.php';
                                                            $stat = "SELECT COUNT(date_needed) AS due_over FROM ticketinfo WHERE date_needed BETWEEN 2022-01-01 AND (CURRENT_DATE + INTERVAL -1 DAY) AND ticketinfo.ticket_assignee = '{$_SESSION['U_unique_id']}' AND NOT ticketinfo.status = 'Closed'";
                                                            $result = mysqli_query($con, $stat);
                                                            if (mysqli_num_rows($result) > 0) {
                                                                // Return the number of rows in result set
                                                                $row = mysqli_fetch_assoc($result);
                                                                $count = $row['due_over'];
                                                            }
                                                        ?>
                                                        <p class="card-category text-white">Over Due</p>
                                                        <p class="card-title text-white"id="ticket_over" style="font-size:28px;"><?php echo $count; ?><p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer ">
                                            <hr>
                                            <div class="stats">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        
                    </div>
                    <!-- Tickets -->
                    
                </div>
                <div="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            
                            <div class="col-md-3 col-sm-4">
                                <a href="./Staff/Ticket(open)" style="text-decoration:none;">
                                    <div class="card card-stats" style="background-color:#5cb85c;">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-2 col-sm-2" >
                                                    <div class="icon-big text-center icon-warning">
                                                        <i class="fa fa-ticket text-white"></i>
                                                    </div>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-10" >
                                                    <div class="numbers" >
                                                        <?php
                                                            include 'connect.php';
                                                            $stat = "SELECT COUNT(status) FROM ticketinfo WHERE status='Open' ";
                                                            $result = mysqli_query($con, $stat);
                                                            if (mysqli_num_rows($result) > 0) {
                                                                // Return the number of rows in result set
                                                                $row = mysqli_fetch_assoc($result);
                                                                $count = $row['COUNT(status)'];
                                                            }
                                                        ?>
                                                        <p class="card-category text-white">Open</p>
                                                        <p class="card-title text-white"id="ticket_open" style="font-size:28px;"><?php echo $count; ?><p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer ">
                                            <hr>
                                            <div class="stats">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-3 col-sm-4"id="ActiveTicket">
                                <a href="./Staff/Ticket(assigned)" style="text-decoration:none;">
                                    <div class="card card-stats ">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-2 col-sm-2" >
                                                    <div class="icon-big text-center icon-warning">
                                                        <i class="fa fa-user-circle text-warning"></i>
                                                    </div>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-10">
                                                    <div class="numbers" >
                                                        <?php
                                                            include 'connect.php';
                                                            $stat = "SELECT COUNT(status) FROM ticketinfo WHERE status='Assigned' AND ticket_assignee = {$_SESSION['U_unique_id']} ";
                                                            $result = mysqli_query($con, $stat);
                                                            if (mysqli_num_rows($result) > 0) {
                                                                // Return the number of rows in result set
                                                                $row = mysqli_fetch_assoc($result);
                                                                $count = $row['COUNT(status)'];
                                                            }
                                                        ?>
                                                        <p class="card-category">Assigned Tickets</p>
                                                        <p class="card-title" id="refresh"><?php echo $count; ?><p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer ">
                                            <hr>
                                            <div class="stats">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-2 col-sm-4"id="ActiveTicket">
                                <a href="./Staff/Ticket(Pending)" style="text-decoration:none;">
                                    <div class="card card-stats" style="background-color:#d9534f;">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-2 col-sm-2 d-md-none" >
                                                    <div class="icon-big text-center icon-warning">
                                                        <i class="fa fa-ticket text-white"></i>
                                                    </div>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-10">
                                                    <div class="numbers">
                                                        <?php
                                                            include 'connect.php';
                                                            $stat = "SELECT COUNT(status) FROM ticketinfo WHERE status='Pending' AND ticket_assignee = {$_SESSION['U_unique_id']} ";
                                                            $result = mysqli_query($con, $stat);
                                                            if (mysqli_num_rows($result) > 0) {
                                                                // Return the number of rows in result set
                                                                $row = mysqli_fetch_assoc($result);
                                                                $count = $row['COUNT(status)'];
                                                            }
                                                        ?>
                                                        <p class="card-category text-white">Pending</p>
                                                        <p class="card-title text-white"><?php echo $count; ?><p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer ">
                                            <hr>
                                            <div class="stats">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                             </div>
                            <div class="col-md-2 col-sm-5"id="ActiveTicket">
                                <a href="./Staff/Ticket(Resolved)" style="text-decoration:none;">
                                    <div class="card card-stats" style="background-color:#5bc0de;">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-2 col-sm-2 d-md-none" >
                                                    <div class="icon-big text-center icon-warning">
                                                        <i class="fa fa-ticket text-white"></i>
                                                    </div>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-10">
                                                    <div class="numbers" id="refresh">
                                                        <?php
                                                            include 'connect.php';
                                                            $stat = "SELECT COUNT(status) FROM ticketinfo WHERE status='Resolved' AND ticket_assignee = {$_SESSION['U_unique_id']} ";
                                                            $result = mysqli_query($con, $stat);
                                                            if (mysqli_num_rows($result) > 0) {
                                                                // Return the number of rows in result set
                                                                $row = mysqli_fetch_assoc($result);
                                                                $count = $row['COUNT(status)'];
                                                            }
                                                        ?>
                                                        <p class="card-category text-white">Resolved</p>
                                                        <p class="card-title text-white"><?php echo $count; ?><p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer ">
                                            <hr>
                                            <div class="stats">
                                            </div>
                                        </div>
                                    </div>
                                </a>
                             </div>
                            <div class="col-md-2 col-sm-5"id="ActiveTicket">
                                <a href="./Staff/Ticket(Closed)" style="text-decoration:none;">
                                    <div class="card card-stats" style="background-color:#292b2c;">
                                        <div class="card-body ">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-2 col-sm-2 d-md-none" >
                                                    <div class="icon-big text-center icon-warning">
                                                        <i class="fa fa-ticket text-white"></i>
                                                    </div>
                                                </div>
                                                <div class="col-lg-10 col-md-10 col-sm-10">
                                                    <div class="numbers" id="refresh" >
                                                        <?php
                                                            include 'connect.php';
                                                            $stat = "SELECT COUNT(status) FROM ticketinfo WHERE status='Closed' AND ticket_assignee = {$_SESSION['U_unique_id']} ";
                                                            $result = mysqli_query($con, $stat);
                                                            if (mysqli_num_rows($result) > 0) {
                                                                // Return the number of rows in result set
                                                                $row = mysqli_fetch_assoc($result);
                                                                $count = $row['COUNT(status)'];
                                                            }
                                                        ?>
                                                        <p class="card-category text-white">Closed</p>
                                                        <p class="card-title text-white"><?php echo $count; ?><p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer ">
                                            <hr>
                                            <div class="stats">
                                            </div>
                                        </div>
                                    </div>
                                </a>
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                $(document).ready(function () {
                
                    setInterval( function() {
                        $("#ticket_open").load(location.href + " #ticket_open");
                    }, 2000 );
                
                });
            </script>
            <script>
                $(document).ready(function () {
                
                    setInterval( function() {
                        $("#ticket_today").load(location.href + " #ticket_today");
                    }, 2000 );
                
                });
            </script>
            <script>
                $(document).ready(function () {
                
                    setInterval( function() {
                        $("#ticket_tomorrow").load(location.href + " #ticket_tomorrow");
                    }, 2000 );
                
                });
            </script>
            <script>
                $(document).ready(function () {
                
                    setInterval( function() {
                        $("#ticket_over").load(location.href + " #ticket_over");
                    }, 2000 );
                
                });
            </script>
    
  <script>
            $(document).ready(function () {
                showConcernGraph();
            });
    
    
            function showConcernGraph()
            {
                {
                    $.post("getDueTomorrow.php",
                    function (data)
                    {
                        console.log(data);
                        var due_tomorrow = [];
                        var due_label = ["Due Tomorrow"];
                        var  barColors = ["#d9534f", "#5cb85c","#5bc0de"];
                        for (var i in data) {
                            
                            due_tomorrow.push(data[i].due_tomorrow);
                        }
    
                        var chartdata = {
                            labels: ["Due Tomorrow", "Due After Tomorrow","Over Due"],
                            datasets: [
                                {
                                    backgroundColor: barColors,
                                    data: [
                                      <?php
                                        include 'connect.php';
                                        $query_tomorrow = "SELECT COUNT(date_needed) AS due_tomorrow FROM ticketinfo WHERE date_needed IN (CURRENT_DATE, CURRENT_DATE + INTERVAL 1 DAY)";
                                        $result_tomorrow= mysqli_query($con,$query_tomorrow);
                                        $row1 = mysqli_fetch_row($result_tomorrow);
                                        $count1 = $row1[0];
                                        $query_afterTom = "SELECT COUNT(date_needed) AS due_after_tomorrow FROM ticketinfo WHERE date_needed IN (CURRENT_DATE, CURRENT_DATE + INTERVAL 1 DAY)";
                                        $result_afterTom = mysqli_query($con,$query_afterTom);
                                        $row2 = mysqli_fetch_row($result_afterTom);
                                        $count2 = $row2[0];
                                        $query_over = "SELECT COUNT(date_needed) AS due_over FROM ticketinfo WHERE date_needed IN (2022-01-01, CURRENT_DATE + INTERVAL 1 DAY)";
                                        $result_over = mysqli_query($con,$query_over);
                                        $row3 = mysqli_fetch_row($result_over);
                                        $count3 = $row3[0];
                                
                                        echo $count1. ",";
                                        echo $count2 . ",";
                                        echo $count3;
                                
                                      ?>
                                      ]
                                }
                            ]
                        };
    
                        var graphTarget = $("#dueGraph");
    
                        var barGraph = new Chart("dueGraph", {
                            type: 'bar',
                            data: chartdata,
                            options: {
                                indexAxis: 'y',
                                // Elements options apply to all of the options unless overridden in a dataset
                                // In this case, we are setting the border of each horizontal bar to be 2px wide
                                elements: {
                                  bar: {
                                    borderWidth: 2,
                                  }
                                },
                                legend: {display: false},
                                title: {
                                    display: true,
                                    text: "",
                                    fontSize: 9
                                }
                            }
                        });
                    });
                }
            }
        </script>

  
</body>

</html>
