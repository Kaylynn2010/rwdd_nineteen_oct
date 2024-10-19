<?php

class Database {
    private $conn1;

    public function __construct($servername, $username, $password, $dbname) {
        $this->conn1 = new mysqli($servername, $username, $password, $dbname);
        if ($this->conn1->connect_error) {
            die("Connection failed: " . $this->conn1->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn1;
    }

    public function closeConnection() {
        $this->conn1->close();
    }
}
?>