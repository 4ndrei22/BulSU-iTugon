<?php 
  session_start();
  include_once "connect.php";
  if(!isset($_SESSION['U_unique_id'])){
    header("location: ../Login");
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
    $user_id = mysqli_real_escape_string($con, $_SESSION['convo_user_id']); //get ticket owner's unique id
    
    $sql = mysqli_query($con, "SELECT * FROM accountcreation WHERE unique_id = {$user_id}"); 
    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_assoc($sql);
        $image = $row['img'];
            if($image == NULL){
                $image = 'blank-profile-picture-973460_1280.png';
            }
            if($ticketname == NULL){
                $ticketname = 'Unknown user';
            }
      $select = mysqli_query($con, "SELECT * FROM ticketinfo WHERE ticket_owner = {$user_id}");
        if(mysqli_num_rows($select) > 0){
            $row1 = mysqli_fetch_assoc($select);
            //$update = "UPDATE ticketinfo SET status = 'Assigned',ticket_assignee = $staff_id WHERE ticket_owner = $user_id ";
            //mysqli_query($con, $update);
            $message = $row1['message'];
            $status = $row1['status'];
            
        }
        
    }
?>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Chrome, Firefox OS and Opera -->
    <meta name="theme-color" content="#671d1e">
    <!-- Windows Phone -->
    <meta name="msapplication-navbutton-color" content="#671d1e">
    <!-- iOS Safari -->
    <meta name="apple-mobile-web-app-status-bar-style" content="#671d1e">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="../CSS Files/Staff_Dashboard.css" rel="stylesheet" />
    <link href="../CSS Files/demo.css" rel="stylesheet" />
    <link href="../CSS Files/ActiveTickets.css" rel="stylesheet">

    <title>Chats</title>
    <link rel="icon" type="image/png" href="/icons/sims-favicon.png"/>

</head>
<body style="max-height: 100vh;">

    <div class="bg-opacity-10 d-flex flex-row py-2" Style="background-color: #671e1e;">
            <img class="rounded-circle ms-2 align-self-xl-center  my-auto " src="../Super Admin/images/<?php echo $image; ?>" width="38px" height="38px">
            <p class="text-truncate fs-5 m-0 ms-1 mt-2 lh-1 fw-600" style="display:block; color:white;"><?php echo $row['firstname']. " " . $row['lastname'] ?></p>
      </div>
        
        
    </div>
    <div class="chat-box p-3 overflow-auto d-flex flex-column-reverse " style="height: calc(100vh - 133px) !important;">

    </div>
    <div class="p-2 pb-3 border-top bg-secondary bg-opacity-25 rounded-top">
        <form action="#" class="typing-area">
            <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
            <input type="text" name="message" class="input-field form-control col-11" placeholder="Type a message here..." autocomplete="off" <?php echo $hidden;?>>
            <button hidden></button>
        </form>
    </div>

    <script src="../javascript/chat.js"></script>

</body>


</html>