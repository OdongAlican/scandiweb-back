<?php
namespace App;

use PDO;
use PDOException;

class Database {
    private $host = 'sql.freedb.tech';
    private $db_name = 'freedb_scandiweb-app';
    private $user_name = 'freedb_amulla';
    private $password = 'w63q8!x*6dh%Txj';
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