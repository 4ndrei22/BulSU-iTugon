<?php
  session_start();
  if(!isset($_SESSION['U_unique_id'])){
   
  }

  require_once 'config.php';

  if (isset($_POST['query'])) {
    $inpText = $_POST['query'];
    $sql = "SELECT ticketinfo.ticket_id AS ticket_id,
                    ticketinfo.ticket_owner AS ticket_owner,
                    ticketinfo.subject AS subject,
                    ticketinfo.status AS status,
                    ticketinfo.date_needed AS date_needed,
                    ticketinfo.priority_lvl AS priority_lvl,
                    ticketinfo.message AS message,
                    accountcreation.firstname AS firstname,
                    accountcreation.lastname AS lastname
                    FROM ticketinfo 
                    INNER JOIN accountcreation ON accountcreation.unique_id = ticketinfo.ticket_owner WHERE ticketinfo.ticket_assignee =  {$_SESSION['U_unique_id']} AND ticketinfo.ticket_id LIKE :ticketID ORDER BY ticketinfo.date_needed ASC";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['ticketID' => '%' . $inpText . '%']);
    $result = $stmt->fetchAll();

    if ($result) {
      foreach ($result as $row) {
        echo '<a href="#" class="list-group-item list-group-item-action border-1">' . $row['ticket_id'] . '</a>';
      }
    } else {
      echo '<p class="list-group-item border-1">No Record</p>';
    }
  }
?>