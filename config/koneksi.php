<?php
class Koneksi {
    private $host     = "127.0.0.1"; 
    private $user     = "root";  
    private $password = "";
    private $db_name  = "db_bukutamu"; 
    public $conn;

    public function getConnection() {
        
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->db_name);
        
        if ($this->conn->connect_error) {
            die("Koneksi Database Gagal: " . $this->conn->connect_error);
        }
        
        return $this->conn;
    }
}
?>