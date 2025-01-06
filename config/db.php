<?php

class DataBase {
    public $host = "localhost";
    public $port = "3307"; // Añadir el puerto
    public $dbname = "alojamientos_db";
    public $username = "root";
    public $password = "alfaomega";
    public $conn;

    public function getConnection() {
        try {
            $this->conn = new PDO("mysql:host={$this->host};port={$this->port};dbname={$this->dbname}", $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo $exception->getMessage();
        }
        return $this->conn;
    }
}


?>