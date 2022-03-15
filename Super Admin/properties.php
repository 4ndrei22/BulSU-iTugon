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
    $select = mysqli_query($con, "SELECT * FROM ticketinfo WHERE ticket_owner = {$user_id}");
    if(mysqli_num_rows($select) > 0){
        $row1 = mysqli_fetch_assoc($select);
        $priolvl = $row1['priority_lvl'];
        $stat = $row1['status'];
    }
?>
<?php
    include 'message_header.php';
?>
<body>
    <header class="pb-3">
        <h2 class="fs-5 text-center">Properties</h2>
    </header>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                <label for="access">Prioritization Level
                </label>
                <select class="form-control" name="priolvl" id="priolvl" >
                    <span class="fa fa-caret-down"></span>
                    <!-- <option value="">Select access level</option> -->
                    <option value="" name="" id=""><?php echo $priolvl;?><i class="fa fa-caret-down"></i></option>
                    <option value="1"name="Low" id="Low">Low</option>
                    <option value="2"name="Normal" id="Normal">Normal</option>
                    <option value="3"name="High" id="High">High</option>
                    <option value="4" name="Urgent" id="Urgent">Urgent</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                <label for="access">Status</label>
                <select class="form-control" name="statuslvl" id="statuslvl" >
                    <option value="" name="" id=""><?php echo $stat;?></option>
                    <option value="1"name="Open" id="Open">Open</option>
                    <option value="2"name="Pending" id="Pending">On Process</option>
                    <option value="3"name="Resolved" id="Resolved">Resolved</option>
                    <option value="4" name="Closed" id="Closed">Closed</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
                <label for="access">Forward to</label>
                <select class="form-control" name="Forward" id="Forward" >
                    <option value="1"name="Open" id="Open"></option>
                    <option value="2"name="Pending" id="Pending"></option>
                    <option value="3"name="Resolved" id="Resolved">Grade Concern</option>
                    <option value="4" name="Closed" id="Closed">Document Concern</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3">
            <button type="button" class="btn btn-light btn-md max-vw-100">Update</button>
        </div>
    </div>
</body>