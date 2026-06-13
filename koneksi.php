<?php

class Koneksi {

private $host     = "127.0.0.1"; 
private $port     = "3306";      
private $db_name   = "db_bukutamu"; 
private $user     = "root";  
private $password = "";
public $conn;

public function getConnection() {
        $this -> conn = null;

       try {            
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->user, $this->password);
            
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Koneksi Database Gagal: " . $e->getMessage();
        }
        
        return $this->conn;
    }

}
?>