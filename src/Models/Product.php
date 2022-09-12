<?php
namespace App;

use App\Helper;

class Product {
    private $conn;
    private $table = 'products';

    public $id;
    public $name;
    public $price;
    public $type;
    public $sku;
    public $data;

    public function __construct($db){
        $this->conn = $db;
    }

    public function read() {
        $query = 'SELECT * FROM products';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = 'INSERT INTO products SET 
        type = :type,
        sku = :sku,
        name = :name,
        price = :price,
        data = :data';

        $stmt = $this->conn->prepare($query);
        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->sku = htmlspecialchars(strip_tags($this->sku));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->data = htmlspecialchars(strip_tags($this->data));

        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':sku', $this->sku);
        $stmt->bindParam(':data', $this->data);

        if($stmt->execute()) return true;

        printf("Error: %s. \n", $stmt->error);
        return false;

    }
}