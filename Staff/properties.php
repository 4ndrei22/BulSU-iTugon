<?php 
  session_start();
  include_once "connect.php";
  if(!isset($_SESSION['U_unique_id'])){
    header("location: ../Login");
  }
?>

<?php 
    include 'connect.php';
    if($_GET['user_id']==''){
        if(!(isset($_SESSION['convo_user_id']))){
            //header("Location: ./no-chats");
        }
        $_GET['user_id'] = $_SESSION['convo_user_id'];
    }
    $_SESSION['convo_user_id'] = $_GET['user_id'];
    $staff_id = $_SESSION['U_unique_id'];
    $user_id = mysqli_real_escape_string($con, $_SESSION['convo_user_id']);
    $select = mysqli_query($con, "SELECT ticketinfo.status AS ticket_status, ticketinfo.priority_lvl, accountcreation.email, accountcreation.contactNum FROM ticketinfo INNER JOIN accountcreation on ticketinfo.ticket_owner = accountcreation.unique_id WHERE ticketinfo.ticket_id = '{$user_id}'");
    if(mysqli_num_rows($select) > 0){
        $row1 = mysqli_fetch_assoc($select);
        $priolvl = $row1['priority_lvl'];
        $stat = $row1['ticket_status'];
        if($stat == 'Closed'){
            $disabled = "disabled";
        }
    }
?>
<?php
    if(isset($_POST['submit']))
    {
        $prio_lvl = $_POST['priolvl'];
        $stat_lvl = $_POST['statuslvl'];
                        
        $query = "UPDATE ticketinfo SET priority_lvl='{$prio_lvl}', status='{$stat_lvl}' WHERE ticket_id ='{$user_id}'";
        $query_run = mysqli_query($con, $query);
                        
        if($query_run)
            {
                $insert = mysqli_query($con,"INSERT INTO ticket_history (ticket_id,updates) VALUES ('{$user_id}','{$stat_lvl}')");
                //$message = "create successfully";
                //$color="success";
                //header("Refresh:0");
                echo "<meta http-equiv='refresh' content='0'>";
            }
    }
?>
<?php
    include 'message_header.php';
?>
<body style="overflow-x:hidden">
    <header class="pb-3">
        <h2 class="fs-5 text-center">Properties</h2>
        <div class="message"><?php if(isset($message)) { echo "<h5 class='errormsg text-$color'>$message </h5> "; } ?></div>
    </header>
    <form action="properties" id="form" method="POST" autocomplete="off">
        <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                <label for="access">Prioritization Level</label>
                <select class="form-control" name="priolvl" id="priolvl" <?php echo $disabled ?>>
                    <span class="fa fa-caret-down"></span>
                    <!-- <option value="">Select access level</option> -->
                    <option value="<?php echo $priolvl;?>" name="<?php echo $priolvl;?>" id=""><?php echo $priolvl;?></option>
                    <option value="Low"name="Low" id="Normal">Low</option>
                    <option value="Normal"name="Normal" id="Normal">Normal</option>
                    <option value="High"name="High" id="High">High</option>
                    <option value="Urgent" name="Urgent" id="Urgent">Urgent</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group" id="ticket_status">
                <label for="access">Status</label>
                <select class="form-control" name="statuslvl" id="statuslvl" <?php echo $disabled ?>>
                    <span class="fa fa-caret-down"></span>
                    <option value="<?php echo $stat;?>" name="" id=""><?php echo $stat;?></option>
                    <option value="Open"name="Open" id="Open">Open</option>
                    <option value="Pending"name="Pending" id="Pending">Pending</option></option>
                    <option value="Resolved"name="Resolved" id="Resolved">Resolved</option>
                    <option value="Closed" name="Closed" id="Closed">Closed</option>
                </select>
            </div>
        </div>
    </div>
        <div class="row">
            <button type="submit" name = "submit" id="submit" class="btn btn-secondary btn-round ml-5 mr-auto" <?php echo $disabled ?>>Update</button>
        </div>
    </form>
    
    <header class="pb-3 pt-4">
        <h2 class="fs-5 text-center">Contact Information</h2>
    </header>
    <div class="row">
        <div class="col-md-6 pr-1">
            <div class="form-group">
                <label>Contact Number</label>
                <p class="form-control text-decoration-none"><?php echo $row1['contactNum'];?></p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 pr-1">
            <div class="form-group">
                <label>Email</label>
                <p class="form-control text-decoration-none"><?php echo $row1['email'];?></p>
            </div>
        </div>
    </div>
    <header class="pb-3 pt-4">
        <h2 class="fs-5 text-center">Ticket History</h2>
    </header>
    <div class="row">
        <div class="col-md-6 pr-1">
            <div class="form-group" id="ticket_history">
                    <?php 
                $select = mysqli_query($con,"SELECT * FROM ticket_history WHERE ticket_id = '{$user_id}'");
                if(mysqli_num_rows($select) > 0){
                    while ($row_selected = mysqli_fetch_assoc($select)){
                        echo "<p class='form-control text-decoration-none'>".$row_selected['updates']." &nbsp; @ &nbsp;".$row_selected['timestamp']."</p>";
                    }
                    
                }
                ?>
                
            </div>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {

            setInterval( function() {
                $("#ticket_history").load(location.href + " #ticket_history");
             }, 1000 );

        });
    </script>
    <script>
        $(document).ready(function () {

            setInterval( function() {
                $("#ticket_status").load(location.href + " #ticket_status");
             }, 5000 );

        });
    </script>
    
</body>