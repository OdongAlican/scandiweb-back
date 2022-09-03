<?php
namespace App;

use App\Database;

class Helper {
        
    private $emptyValues = array();
    private $db;

    function validate($product){       

        $output = array('product' => $product, 'errArray' => $this->emptyValues, 'submit' => true );

        foreach( $product as $key => $value ) {
            if(strlen($value) < 1) { array_push($this->emptyValues, $key . " is missing!"); }
        }

        if(count($this->emptyValues) > 0) {
            $output['submit'] = false;
            $output['errArray'] = $this->emptyValues;
        }
        return $output;
    }

    function dbConnection(){
        $database = new Database();
        $this->db = $database->connect();
        return $this->db;
    }

}
