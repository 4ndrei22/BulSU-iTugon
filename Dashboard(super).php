<?php
  session_start();
  if(!isset($_SESSION['U_unique_id'])){
    header('refresh: 1, url = /');
  }
  include_once'connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
  <link rel="icon" type="image/png" href="BulSU.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    BulSU iTugon
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="./CSS Files/bootstrap.min.css" rel="stylesheet" />
  <link href="./CSS Files/Staff_Dashboard.css" rel="stylesheet" />
  <link href="./CSS Files/Table.css" rel="stylesheet" />
  <link href="./CSS Files/demo.css" rel="stylesheet" />
  <link href="./CSS Files/upload.css" rel="stylesheet" />
  <!--   Core JS Files   -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="./JS Files/Errormsg.js"></script>
  <script src="./JS Files/core/popper.min.js"></script>
  <script src="./JS Files/core/bootstrap.min.js"></script>
  <script src="./JS Files/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!-- Chart JS -->
  <script src="./JS Files/plugins/chartjs.min.js"></script>
  <script src="./JS Files/plugins/bootstrap-notify.js"></script>
  <script src="./JS Files/Staff_Dashboard.min.js" type="text/javascript"></script>
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
                        <img class="icon-simple" src="../Super Admin/images/1645276916blank-profile-picture-973460_1280.png" alt="">
                    </div>
                </a>
                <a class="simple-text logo-normal">
                    <?php echo $row['firstname']. " "  ?>
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="active">
                        <a href="./Dashboard(super)">
                            <i class="fa fa-bank"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="">
                        <a href="Super Admin/AdminCreation">
                            <i class="fa fa-plus"></i>
                            <p style="font-size: 10px;">Create Employee Account</p>
                        </a>
                    </li>
                    <li>
                        <a href="Super Admin/user">
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
                                    <a class="dropdown-item" href="./Super Admin/ChangeUsername">Change Username</a>
                                    <a class="dropdown-item" href="./Super Admin/ChangePassword">Change Password</a>
                                    <a class="dropdown-item" href="./Super Admin/truncateUser">Logout</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content" id="dashboard">
                
                <!-- Ticket Status, Ticket Concern, Satisfation -->
                <div class="row">
                    
                    <!--Ticket status-->
                    <div class="col-md-6">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h5 class="card-title">Ticket Status</h5>
                                <p class="card-category"></p>
                            </div>
                            <div class="card-body"id="ticket_status">
                                <canvas id="graphCanvas" width="350" height="100"></canvas>
                            </div>
                            <div class="card-footer">
                                <div class="chart-legend" style="font-size: 10px;">
                                    <i class="fa fa-circle " style="color: #0d6efd"></i> Assigned
                                    &nbsp;
                                    <i class="fa fa-circle " style="color: #5cb85c"></i> Open 
                                    &nbsp;
                                    <i class="fa fa-circle " style="color: #f0ad4e"></i> Pending
                                    &nbsp;
                                    <i class="fa fa-circle " style="color: #d9534f"></i> Resolved
                                    &nbsp;
                                    <i class="fa fa-circle " style="color: #000000"></i> Closed
                                </div>
                                <hr />
                                <div class="card-stats">
                                </div>  
                            </div>
                        </div>
                    </div>
                    
                    <!--Ticket recieve-->
                    <div class="col-md-6">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h5 class="card-title">Ticket Received per Office</h5>
                                <p class="card-category">Five offices with highest ticket received</p>
                            </div>
                            <div class="card-body" id="ticket_office">
                                <canvas id="concernGraph" width="350" height="100"></canvas>
                            </div>
                            <div class="card-footer">
                                <div class="chart-legend">
                                </div>
                                <hr />
                                <div class="card-stats">
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
                
                <!--user satisfaction-->
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="card card-chart">
                            <div class="card-header">
                                <a class="card-title" href="./Super Admin/satisfaction_rating" style="font-size: 26px; color: #000;">User Feedback</a>
                                <p class="card-category">(Application)</p>
                            </div>
                            <div class="card-body" id="satisfaction">
                                <canvas id="satisfactionGraph" width="350" height="100"></canvas>
                            </div>
                            <div class="card-footer">
                                <div class="chart-legend" style="font-size:12px;">
                                    <i class="fa fa-circle " style="color: #198754"></i> Very Satisfied
                                    <i class="fa fa-circle " style="color: #5cb85c"></i> Satisfied
                                    <i class="fa fa-circle " style="color: #ffc107"></i> Good
                                    <i class="fa fa-circle " style="color: #fd7e14"></i> Unsatisfied
                                    <i class="fa fa-circle " style="color: #dc3545"></i> Very unsatisfied
                                </div>
                                <hr />
                                <div class="card-stats">
                                </div>  
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="card card-chart">
                            <div class="card-header">
                                 <a class="card-title" href="./Super Admin/satisfaction_rating(tickets)" style="font-size: 26px; color: #000;">User Feedback</a>
                                <p class="card-category">(Ticket)</p>
                            </div>
                            <div class="card-body" id="satisfaction">
                                <canvas id="feedbackGraph"  width="350" height="100"></canvas>
                            </div>
                            <div class="card-footer">
                                <div class="chart-legend" style="font-size:12px;">
                                    <i class="fa fa-circle " style="color: #198754"></i> Very Satisfied
                                    <i class="fa fa-circle " style="color: #5cb85c"></i> Satisfied
                                    <i class="fa fa-circle " style="color: #ffc107"></i> Good
                                    <i class="fa fa-circle " style="color: #fd7e14"></i> Unsatisfied
                                    <i class="fa fa-circle " style="color: #dc3545"></i> Very unsatisfied
                                </div>
                                <hr />
                                <div class="card-stats">
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Staff summary -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <a class="card-title" href="./Super Admin/tables" style="font-size: 26px; color: #000;">Staff Ticket Summary </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive" >
                                    <?php
                                        require_once("connect.php");
                                        $sql = "SELECT * FROM ticketinfo INNER JOIN accountcreation ON ticketinfo.ticket_assignee = accountcreation.unique_id GROUP BY ticketinfo.ticket_assignee limit 5";
                                        $result = mysqli_query($con, $sql);
                                    ?>
                                        <div class="max-vh-100" style="overflow-y:auto; overflow-x: hidden; " >
                                        <div class="message"><?php if(isset($message)) { echo $message; } ?></div>
                                            <table class="table" id="staff_summary">
                                                <thread>
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
                <!-- Ticket Report -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h5 class="card-title">Ticket Report:</h5>
                            </div>
                            <div class="card-body" id="ticket_report">
                                <canvas id="Monthly_barGraph" width="400" height="100"></canvas>
                            </div>
                            <div class="card-footer">
                                <div class="chart-legend">
                                </div>
                                <hr />
                                <div class="card-stats">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         <script>
            setTimeout(function(){
              window.location.reload(1);
            }, 60000);
        </script>
        <script>
            //$(document).ready(function () {
                //setInterval( function() {
                //    $("#staff_summary").load(location.href + " #staff_summary");
                //}, 1000 );
                                    
            //});
        </script>
       
        <script>
            //$(document).ready(function() {
              //setInterval( function() {
                    //$("#concernGraph").load(location.href + showConcernGraph()),
                    //$("#satisfactionGraph").load(location.href + "#satisfactionGraph");
                    //$("#concernGraph").load(showConcernGraph());
                    //$("#feedbackGraph").load(location.href + "#feedbackGraph");
                    //$("#Monthly_barGraph").load(showMonthlyGraph());
                //}, 10000 );
            //});
        </script>
        <!-- ticket status -->
        <script>
            $(document).ready(function () {
                showStatusGraph();
            });
    
            function showStatusGraph()
            {
                {
                    $.post("",
                    function (data)
                    {
                        //console.log(data);
                        var ticketstatus = ["Assigned","Open","Pending","Resolved","Closed"];
                        var  barColors = ["#0d6efd", "#5cb85c","#f0ad4e","#d9534f","#000000"];
                        
    
                        var chartdata = {
                            labels: ticketstatus,
                            datasets: [
                                {
                                    backgroundColor: barColors,
                                    data: [
                                      <?php
                                        include 'connect.php';
                                        $assigned = "SELECT COUNT(status) AS status_count FROM ticketinfo WHERE status ='Assigned'";
                                        $Result_Assigned = mysqli_query($con,$assigned);
                                        $row1 = mysqli_fetch_row($Result_Assigned);
                                        $count1 = $row1[0];
                                        
                                        $Open = "SELECT COUNT(status) AS status_count FROM ticketinfo WHERE status ='Open'";
                                        $Result_Open = mysqli_query($con,$Open);
                                        $row2 = mysqli_fetch_row($Result_Open);
                                        $count2 = $row2[0];
                                        
                                        $Pending = "SELECT COUNT(status) AS status_count FROM ticketinfo WHERE status ='Pending'";
                                        $result_Pending=mysqli_query($con,$Pending);
                                        $row3 = mysqli_fetch_row($result_Pending);
                                        $count3 = $row3[0];
                                        
                                        $Resolved = "SELECT COUNT(status) AS status_count FROM ticketinfo WHERE status ='Resolved'";
                                        $result_Resolved = mysqli_query($con,$Resolved);
                                        $row5 = mysqli_fetch_row($result_Resolved);
                                        $count5 = $row5[0];
                                        
                                        $Closed = "SELECT COUNT(status) AS status_count FROM ticketinfo WHERE status ='Closed'";
                                        $result_Closed = mysqli_query($con,$Closed);
                                        $row6 = mysqli_fetch_row($result_Closed);
                                        $count6 = $row6[0];
                                
                                        echo $count1 . ",";
                                        echo $count2 . ",";
                                        echo $count3 . ",";
                                        echo $count5 . ",";
                                        echo $count6;
                                
                                      ?>
                                      ]
                                }
                            ]
                        };
    
                        var graphTarget = $("#graphCanvas");
    
                        var barGraph = new Chart("graphCanvas", {
                            type: 'bar',
                            data: chartdata,
                            options: {
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
                                },scales: {
                                	yAxes: [{
                                    	ticks: {
                                        	beginAtZero: true
                                    	}
                                	}]
                            	}
                            }
                        });
                    });
                }
            }
        </script>
        <!--ticket concern per office -->
        <script>
            $(document).ready(function () {
                showConcernGraph();
                //setInterval( function() {
                   //$("#concernGraph").load(location.href + showConcernGraph());
                //}, 10000 );
            });
    
    
            function showConcernGraph()
            {
                {
                    $.post("getConcernData.php",
                    function (data)
                    {
                        //console.log(data);
                        var office_id = [];
                        var office = [];
                        var  barColors = ["#d9534f", "#5cb85c","#5bc0de","#f0ad4e","#0d6efd"];
                        for (var i in data) {
                            office_id.push(data[i].Office_id);
                            office.push(data[i].Office);
                        }
    
                        var chartdata = {
                            labels: office,
                            datasets: [
                                {   
                                    backgroundColor: barColors,
                                    data: office_id
                                }
                            ]
                        };
                        var graphTarget = $("#concernGraph");
                        var barGraph = new Chart("concernGraph", {
                            type: 'bar',
                            data: chartdata,
                            options: {
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
                                },scales: {
                                	yAxes: [{
                                    	ticks: {
                                        	beginAtZero: true
                                    	}
                                	}]
                            	}
                            }
                        });
                    });
                }
            }
        </script>
        <!-- user satisfaction (application) -->
        <script>
            $(document).ready(function () {
                showSatisfactionGraph();
                //setInterval( function() {
                //    $("#satisfactionGraph").load(location.href + "#satisfactionGraph");
                //}, 10000 );
            });
    
    
            function showSatisfactionGraph()
            {
                {
                    $.post("",
                    function (data)
                    {
                        //console.log(data);
                        var satisfaction = ["Very Satisfied","Satisfied","Good","Unsatisfied","Very Unsatisfied",];
                        var  barColors = ["#198754", "#5cb85c","#ffc107","#fd7e14","#dc3545"];
                        
    
                        var chartdata = {
                            labels: satisfaction,
                            datasets: [
                                {
                                    backgroundColor: barColors,
                                    data: [
                                      <?php
                                        include 'connect.php';
                                        $assigned = "SELECT COUNT(rating) AS satisfactionRate FROM accountcreation WHERE rating = 5";
                                        $Result_Assigned = mysqli_query($con,$assigned);
                                        $row1 = mysqli_fetch_row($Result_Assigned);
                                        $count1 = $row1[0];
                                        
                                        $Open = "SELECT COUNT(rating) AS satisfactionRate FROM accountcreation WHERE rating = 4";
                                        $Result_Open = mysqli_query($con,$Open);
                                        $row2 = mysqli_fetch_row($Result_Open);
                                        $count2 = $row2[0];
                                        
                                        $Pending = "SELECT COUNT(rating) AS satisfactionRate FROM accountcreation WHERE rating = 3";
                                        $result_Pending=mysqli_query($con,$Pending);
                                        $row3 = mysqli_fetch_row($result_Pending);
                                        $count3 = $row3[0];
                                        
                                        $Resolved = "SELECT COUNT(rating) AS satisfactionRate FROM accountcreation WHERE rating = 2";
                                        $result_Resolved = mysqli_query($con,$Resolved);
                                        $row5 = mysqli_fetch_row($result_Resolved);
                                        $count5 = $row5[0];
                                        
                                        $Closed = "SELECT COUNT(rating) AS satisfactionRate FROM accountcreation WHERE rating = 1";
                                        $result_Closed = mysqli_query($con,$Closed);
                                        $row6 = mysqli_fetch_row($result_Closed);
                                        $count6 = $row6[0];
                                
                                        echo $count1 . ",";
                                        echo $count2 . ",";
                                        echo $count3 . ",";
                                        echo $count5 . ",";
                                        echo $count6;
                                
                                      ?>
                                      ]
                                }
                            ]
                        };
    
                        var graphTarget = $("#satisfactionGraph");
    
                        var barGraph = new Chart("satisfactionGraph", {
                            type: 'bar',
                            data: chartdata,
                            options: {
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
                                },scales: {
                                	yAxes: [{
                                    	ticks: {
                                        	beginAtZero: true
                                    	}
                                	}]
                            	}
                            }
                        });
                    });
                }
            }
        </script>
        <!-- user satisfaction (ticket) -->
        <script>
            $(document).ready(function () {
                showFeedbackGraph();
                //setInterval( function() {
                //    $("#feedbackGraph").load(location.href + "#feedbackGraph");
                //},10000);
            });
    
    
            function showFeedbackGraph()
            {
                {
                    $.post("",
                    function (data)
                    {
                        //console.log(data);
                        var satisfaction = ["Very Satisfied","Satisfied","Good","Unsatisfied","Very Unsatisfied",];
                        var  barColors = ["#198754", "#5cb85c","#ffc107","#fd7e14","#dc3545"];
                       
                        var chartdata = {
                            labels: satisfaction,
                            datasets: [
                                {
                                    backgroundColor: barColors,
                                    data: [
                                      <?php
                                        include 'connect.php';
                                        $assigned = "SELECT COUNT(rating) AS satisfactionRate FROM ticketinfo WHERE rating = 5";
                                        $Result_Assigned = mysqli_query($con,$assigned);
                                        $row1 = mysqli_fetch_row($Result_Assigned);
                                        $count1 = $row1[0];
                                        
                                        $Open = "SELECT COUNT(rating) AS satisfactionRate FROM ticketinfo WHERE rating = 4";
                                        $Result_Open = mysqli_query($con,$Open);
                                        $row2 = mysqli_fetch_row($Result_Open);
                                        $count2 = $row2[0];
                                        
                                        $Pending = "SELECT COUNT(rating) AS satisfactionRate FROM ticketinfo WHERE rating = 3";
                                        $result_Pending=mysqli_query($con,$Pending);
                                        $row3 = mysqli_fetch_row($result_Pending);
                                        $count3 = $row3[0];
                                        
                                        $Resolved = "SELECT COUNT(rating) AS satisfactionRate FROM ticketinfo WHERE rating = 2";
                                        $result_Resolved = mysqli_query($con,$Resolved);
                                        $row5 = mysqli_fetch_row($result_Resolved);
                                        $count5 = $row5[0];
                                        
                                        $Closed = "SELECT COUNT(rating) AS satisfactionRate FROM ticketinfo WHERE rating = 1";
                                        $result_Closed = mysqli_query($con,$Closed);
                                        $row6 = mysqli_fetch_row($result_Closed);
                                        $count6 = $row6[0];
                                
                                        echo $count1 . ",";
                                        echo $count2 . ",";
                                        echo $count3 . ",";
                                        echo $count5 . ",";
                                        echo $count6;
                                
                                      ?>
                                      ]
                                }
                            ]
                        };
    
                        var graphTarget = $("#feedbackGraph");
    
                        var barGraph = new Chart("feedbackGraph", {
                            type: 'bar',
                            data: chartdata,
                            options: {
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
                                },scales: {
                                	yAxes: [{
                                    	ticks: {
                                        	beginAtZero: true
                                    	}
                                	}]
                            	}
                            }
                        });
                    });
                }
            }
        </script>
        <!-- ticket status per month -->
        <script>
            $(document).ready(function () {
                showMonthlyGraph();
                //setInterval( function() {
                //    $("#Monthly_barGraph").load(location.href + " #Monthly_barGraph");
                //}, 1000 );
            });
    
    
            function showMonthlyGraph()
            {
                {
                    $.post("getMonthlyTickets.php",
                    function (data)
                    {
                        //console.log(data);
                        var ticketCount = [];
                        var Month = ["January","February","March","April","May","June","July","August","September","October","November ","December",];
                        var  barColors = ["#5bc0de","#5bc0de","#5bc0de","#5bc0de","#5bc0de","#5bc0de","#5bc0de","#5bc0de","#5bc0de","#5bc0de","#5bc0de","#5bc0de"];
                        for (var i in data) {
                            ticketCount.push(data[i].monthCount);
                            
                        }
    
                        var chartdata = {
                            labels: Month,
                            datasets: [
                                {
                                    backgroundColor: barColors,
                                    data: ticketCount
                                }
                            ]
                        };
    
                        var graphTarget = $("#Monthly_barGraph");
                        var barGraph = new Chart("Monthly_barGraph", {
                            type: 'bar',
                            data: chartdata,
                            options: {
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
                                },scales: {
                                	yAxes: [{
                                    	ticks: {
                                        	beginAtZero: true
                                    	}
                                	}]
                            	}
                            }
                        });
                    });
                }
            }
        </script>

    </div>
</body>
</html>