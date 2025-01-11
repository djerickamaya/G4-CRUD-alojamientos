<?php
// Verificar si la clase DataBase ya está declarada

    class DataBase {
        public $host = "localhost";
        public $port = "3306"; // Añadir el puerto
        public $dbname = "alojamientos_db";
        public $username = "root";
        public $password = "";
        public $pdo_conn;
        public $mysqli_conn;

        public function getConnection() {
            try {
                $this->pdo_conn = new PDO("mysql:host={$this->host};port={$this->port};dbname={$this->dbname}", $this->username, $this->password);
                $this->pdo_conn->exec("set names utf8");
            } catch(PDOException $exception) {
                echo "PDO Connection error: " . $exception->getMessage();
            }
            return $this->pdo_conn;
        }

        public function getMysqliConnection() {
            $this->mysqli_conn = new mysqli($this->host, $this->username, $this->password, $this->dbname, $this->port);
            if ($this->mysqli_conn->connect_error) {
                die("MySQLi Connection failed: " . $this->mysqli_conn->connect_error);
            }
            return $this->mysqli_conn;
        }
    }

?>