<?php
namespace App;

class Product {
    private $conn;
    private $table = 'products';

    public $id;
    public $name;
    public $price;
    public $type;
    public $capacity;

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
        name = :name,
        price = :price,
        capacity = :capacity';

        $stmt = $this->conn->prepare($query);
        $this->type = htmlspecialchars(strip_tags($this->type));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->capacity = htmlspecialchars(strip_tags($this->capacity));

        $stmt->bindParam(':type', $this->type);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':capacity', $this->capacity);

        if($stmt->execute()) return true;

        printf("Error: %s. \n", $stmt->error);
        return false;

    }
}