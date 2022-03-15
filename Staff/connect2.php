<?php
class dbConfig {
    protected $serverName;
    protected $userName;
    protected $password;
    protected $dbName;
    function dbConfig() {
        $this -> serverName = 'localhost';
        $this -> userName = 'u106223405_admin';
        $this -> password = "Admin123";
        $this -> dbName = "u106223405_db_admin";
    }
}
?>

