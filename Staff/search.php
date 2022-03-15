<?php
require_once "connect.php";
if (isset($_GET['term'])) {
     
   $query = "SELECT * FROM ticketinfo WHERE ticket_id LIKE '{$_GET['term']}%' LIMIT 25";
    $result = mysqli_query($con, $query);
 
    if (mysqli_num_rows($result) > 0) {
     while ($user = mysqli_fetch_array($result)) {
      $res[] = $user['ticket_id'];
     }
    } else {
      $res = array();
    }
    //return json res
    echo json_encode($res);
}
?>