<?php
  session_start();
  include_once 'connect.php';
  if(!isset($_SESSION['U_unique_id'])){
    header('refresh: 1, url = ../Login.php');
  }
?>
<?php 
    if($_GET['user_id']==''){
      if(!(isset($_SESSION['convo_user_id']))){
        header("Location: ./no-chats");
      }
      $_GET['user_id'] = $_SESSION['convo_user_id'];
    }
    $_SESSION['convo_user_id'] = $_GET['user_id'];
    $staff_id = $_SESSION['U_unique_id'];
    $ticket_id = mysqli_real_escape_string($con, $_SESSION['convo_user_id']); //get ticket owner's unique id
    
    $sql = mysqli_query($con, "SELECT * FROM ticketinfo WHERE ticket_id = '{$ticket_id}'"); 
    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_assoc($sql);
        $message = $row['message'];
    }
    $select = mysqli_query($con, "SELECT * FROM accountcreation WHERE unique_id = {$row['ticket_owner']}");
    if(mysqli_num_rows($select) > 0){
        $row1 = mysqli_fetch_assoc($select);
        $_SESSION['ticket_owner'] = $row1['unique_id'];
        $select1 = mysqli_query($con, "SELECT * FROM messages WHERE outgoing_msg_id = {$ticket_id}");
        if(mysqli_num_rows($select1) > 0){
            
        }else{
            $ticket_owner = $_SESSION['ticket_owner'];
            $insert = "UPDATE messages SET incoming_msg_id = {$staff_id} WHERE outgoing_msg_id = {$ticket_owner}";
            mysqli_query($con, $insert);
        }
    }
?>
<?php
include 'message_header.php';
?>
 <body class="">
    <?php include 'navBars.php'; ?>
        <div class="content">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row vh-100" style="display: flex; max-height:850px; min-height:400px;">
                        <div id="convo-div" class="col-lg-9 col-md-9 col-sm-9 d-none d-sm-block vh-100">
                            <div class="row">
                                <iframe id="chat-box-div" src="./conversation?user_id=" class="w-100 col-md-6 col-lg-6 d-flex flex-column vh-100"style="max-height:850px; min-height:400px;"></iframe>
                            </div>
                        </div>
                        <div id="property-div" class="col-lg-3 col-md-3 col-sm-3 d-none d-sm-block min-vh-100">
                            <div class="row">
                                <iframe id="chat-properties-div" src="./properties?user_id=" class="w-100 col-md-6 col-lg-6 d-flex flex-column vh-100"style="max-height:850px; min-height:400px;"></iframe>
                            </div>
                        </div>
                    </div>
                
                    <script src="../javascript/users.js"></script>
                    <script>
                        function showConversation(userid) {
                            document.getElementById('chat-box-div').src = "./conversation?user_id=" + userid;
                            document.getElementById('input-search').value = '';
                            document.getElementById('input-search').dispatchEvent(new KeyboardEvent('keydown',  {'keycode':13}));
                            document.getElementById('convo-div').classList.remove("d-none");
                            document.getElementById('convo-div').classList.remove("d-sm-block");
                            document.getElementById('convo-list-div').classList.add("d-none");
                            document.getElementById('convo-list-div').classList.add("d-sm-block");
                            
                            document.getElementById('chat-properties-div').src = "./properties?user_id=" + userid;
                            document.getElementById('property-div').classList.remove("d-none");
                            document.getElementById('property-div').classList.remove("d-sm-block");
                        
                        }
                        function goBack() {
                            document.getElementById('convo-div').classList.add("d-none");
                            document.getElementById('convo-div').classList.add("d-sm-block");
                            document.getElementById('convo-list-div').classList.remove("d-none");
                            document.getElementById('convo-list-div').classList.remove("d-sm-block");
                         }
                    </script>
                </div>
            </div>
        </div>
    </div>
  </div>
</body>

</html>
