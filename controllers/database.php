<?php

class database{
    private $host = 'localhost';
    private $username = 'matheus';
    private $password = 'root';
    private $db_name = 'hospital';
    private $conn;

    public function connect(){
        $this->conn = null;

        try {
            $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->db_name);
        } catch(PDOException $e) {
            echo 'Erro na conexão: ' . $e->getMessage();
        }

        return $this->conn;
    }
}

?>