<?php
class DB_Controller {
	private $conn = "";
	private $host = "localhost";
	private $user = "u106223405_admin";
	private $password = "Admin123";
	private $database = "u106223405_db_admin";

	function __construct() {
		$conn = $this->connectDB();
		if(!empty($conn)) {
			$this->conn = $conn;
			$this->selectDB($conn);
		}
	}

	function connectDB() {
		$conn = mysql_connect($this->host,$this->user,$this->password);
		return $conn;
	}

	function selectDB($conn) {
		mysql_select_db($this->database,$conn);
	}

	function runSelectQuery($query) {
		$result = mysql_query($query);
		while($row=mysql_fetch_assoc($result)) {
			$resultset[] = $row;
		}
		if(!empty($resultset))
			return $resultset;
	}
	
	function executeInsert($query) {
        $result = mysql_query($query);
        $insert_id = mysql_insert_id();
		return $insert_id;
		
    }
	
	function executeQuery($sql) {
		$result = mysql_query($sql);
		return $result;
		
    }

	function numRows($query) {
		$result  = mysql_query($query);
		$rowcount = mysql_num_rows($result);
		return $rowcount;
	}
}
?>
