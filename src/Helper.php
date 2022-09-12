<?php
namespace App;

use App\Database;

class Helper {
        
    private $emptyValues = array();
    private $db;

    function validate($product){       

        $output = array('product' => $product, 'errArray' => $this->emptyValues, 'submit' => true );

        foreach( $product as $key => $value ) {
            if(strlen($value) < 1) { array_push($this->emptyValues, $key . " is required!"); }
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

    function setHeaders(){
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            header('Access-Control-Allow-Origin: *');
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 1000');
        }
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'])) {
                header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
            }

            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS'])) {
                header("Access-Control-Allow-Headers: Accept, Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token, Authorization");
            }
            exit(0);
        }
    }

}
