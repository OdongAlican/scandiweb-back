<?php
namespace App;

use PDO;
use PDOException;

class Database {
    /*
    private $host = '127.0.0.1';
    private $db_name = 'api';
    private $user_name = 'root';
    private $password = '123456';
    private $table = 'products';
    private $conn;
    */

    private $host = 'sql.freedb.tech';
    private $db_name = 'freedb_scandiweb-test';
    private $user_name = 'freedb_odong';
    private $password = '72PHFc6&HsMa$G4';
    private $table = 'products';
    private $conn;

    public function connect(){

        // $this->createDBTable();

        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->user_name, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo 'Connection Error ' . $e->getMessage();
        }
        return $this->conn;
    }

    private function createDBTable(){

        $link = mysqli_connect($this->host, $this->user_name, $this->password, $this->db_name);
        
        if($link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }

        $sql = "CREATE TABLE products (
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            name VARCHAR(30) NOT NULL,
            sku VARCHAR(30) NOT NULL UNIQUE,
            type VARCHAR(30) NOT NULL,
            price VARCHAR(30) NOT NULL,
            data VARCHAR(100) NOT NULL
        )";

        if ($result = mysqli_query("SHOW TABLES LIKE '".$this->table."'")) {
            if($result->num_colunms == 1) {
                header('HTTP/1.1 403 Forbidden', true, 403);
                echo "Table exists";
            }
        }
        else {
            if(mysqli_query($link, $sql)) {
                header('HTTP/1.1 201 DB Table Created', true, 201);
            }
        }

        mysqli_close($link);
    } 
}