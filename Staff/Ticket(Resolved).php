<?php
  session_start();
  if(!isset($_SESSION['U_unique_id'])){
    header('refresh: 1, url = ../Login');
  }
?>
<?php
    if(isset($_POST['sort'])){
        if(!empty($_POST['priority'])) {
            $selectedprio = $_POST['priority'];
            if($selectedprio == 'All'){
                $sortingcondition1;
            }else{
                $sortingcondition1= "AND (ticketinfo.priority_lvl = '$selectedprio')";
            }
            
            //echo 'You have chosen: ' . $selected;
        }
    }
?>
<?php
include "Ticket_header.php";
?>
<body>
  <div class="wrapper">
    <?php
    include 'navBars.php';
    ?>
    <div class="content" id="openTickets">
            <div class="Header pb-4">
                <div class="container-fluid rounded"  Style="background-color: #671e1e; ">
                    <h2 class="text-white pt-2">
                        Resolved Tickets
                    </h2>
                    <div class="row justify-content-end">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 pr-1 pt-2">
                                    <div class="form-group">
                                        <input type="text"  class="form-control" placeholder="Search ticket number here..." id="search_param" autocomplete="off">
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn text-white" name="submit" hidden><span class="fa fa-search" style="height:41px; background-color:#671e1e;" ></span></button>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 pl-1"style="position: relative;margin-top: -38px;margin-left: 215px;">
                                    <div class="list-group" id="show-list">
                                        <!-- Here autocomplete list will be display -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <form action="" method="POST">
                                <div class="row">
                                    <div class="col-lg-2 col-md-6"></div>
                                    <div class="col-lg-6 col-md-6 pr-1 pt-2">
                                        <div class="form-group">
                                            <select class="form-control w-7" name="priority">
                                                <option value="" disabled selected>Sort Priority</option>
                                                <option value="Urgent">Urgent</option>
                                                <option value="High">High</option>
                                                <option value="Normal">Normal</option>
                                                <option value="Low">Low</option>
                                                <option value="All">All</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <input class="btn bg-white" type="submit" name="sort" value="Sort tickets"style="height:41px; color: #671e1e;">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-borderless">
                        <tbody id="tbl_body">
                            <?php
                            include 'connect.php';
                            $sql = mysqli_query($con, "SELECT 
                                                    	ticketinfo.ticket_id AS ticket_id,
                                                        ticketinfo.ticket_owner AS ticket_owner,
                                                        ticketinfo.subject AS subject,
                                                    	ticketinfo.status AS status,
                                                        ticketinfo.date_needed AS date_needed,
                                                        ticketinfo.priority_lvl AS priority_lvl,
                                                        ticketinfo.message AS message,
                                                        accountcreation.firstname AS firstname
                                                        ,accountcreation.lastname AS lastname,
                                                        accountcreation.img AS img
                                                    FROM ticketinfo 
                                                    INNER JOIN accountcreation ON accountcreation.unique_id = ticketinfo.ticket_owner WHERE (ticketinfo.ticket_assignee =  {$_SESSION['U_unique_id']}) AND (ticketinfo.status ='Resolved') $sortingcondition1 ORDER BY ticketinfo.date_needed ASC");
                            while ($row = mysqli_fetch_array($sql)) {
                                $ticketnum=$row['ticket_owner'];
                                $ticketId = $row['ticket_id'];
                                $prioLvl = $row['priority_lvl'];
                                $message = $row['message'];
                                $Stat = $row['status'];
                                $date = $row['date_needed'];
                                $subj = $row['subject'];
                                $fullname = $row['firstname'] . ' ' . $row['lastname'];
                                $ticketname = $fullname;
                                $image = $row['img'];
                                if(strlen($subj) > 25){
                                    $sub = substr($subj, 0, 25);
                                    $subj = $sub."".'...';
                                }else{
                                    $subj;
                                }
                                if(strlen($message) > 50){
                                    $mess = substr($message, 0, 50);
                                    $message = $mess."".'...';
                                }else{
                                    $message;
                                }
                                if($prioLvl=='Urgent'){
                                    $color="red";
                                }elseif($prioLvl=='High'){
                                    $color="orange";
                                }elseif($prioLvl=='Normal'){
                                    $color="green";
                                }elseif($prioLvl=='Low'){
                                    $color="blue";
                                }
                                ?>
                                <tr >
                                    <td ><div class="col-lg-12 col-md-12 col-sm-12" style="margin-top:-2%;">
                                        <div class="card card-stats">
                                            <div class="card-body">
                                                <a href="Ticket(conversation)?user_id=<?php echo $row['ticket_id']; ?>" style="text-decoration:none; color:#000000;">
                                                    <div class="row">
                                                        <div class="col-lg-1 col-md-1 col-sm-1">
                                                            <div class="icon-small text-center icon-warning">
                                                                <img class="rounded-circle" src="../BulSU.png" alt="" width=42px; hieght=42px;>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-8 col-md-8 col-sm-8">
                                                            <div class="numbers">
                                                                <p Style="font-size:12px; text-align:left; font-weight: bold;">#<?php echo $row['ticket_id']; ?></p>  
                                                                <p Style="font-size:12px; text-align:left;"><?php echo $fullname; ?></p>
                                                                <p Style="font-size:10px; text-align:left;"><?php echo $row['message']; ?></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                                            <div class="numbers">
                                                                <p Style="font-size:10px; text-align:left;">
                                                                    <span class="status bg-success"></span><?php echo $row['status']; ?>
                                                                </p>  
                                                                <p Style="font-size:10px; text-align:left;">
                                                                    <span class="status <?php echo $color?>"></span><?php echo $row['priority_lvl']; ?>
                                                                </p>
                                                                <p Style="font-size:12px; text-align:left;">
                                                                    <i class="fa fa-calendar"></i>
                                                                    <?php echo $row['date_needed']; ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                </a> 
                                            </div>
                                            <div class="text-center card-footer">
                                                <hr>
                                               
                                            </div>
                                        
                                        </div>
                                    
                                </div></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
      </div>

    </div>
  </div>
 <script>
            $(document).on("keyup", "#search_param", function () {
                var search_param = $("#search_param").val();
                $.ajax({
                    url: 'search/searchResult(resolved).php',
                    type: 'POST',
                    data: {search_param: search_param},
                    success: function (data) {
                        $("#tbl_body").html(data);
                    }
                });
            });
        </script>
</body>
 