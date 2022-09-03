<?php
namespace App;

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, 
    Access-Control-Allow-Methods, Authorization, X-Requested-with');

    use App\Product;
    use App\Helper;

    class Create extends Product {

        function addProduct(){
        
            $formData = json_decode(file_get_contents("php://input"));
            
            $formValidator = new Helper();
            $data = $formValidator->validate($formData);
            
            if($data['submit']) {
                
                $this->name = $data['product']->name;
                $this->type = $data['product']->type;
                $this->price = $data['product']->price;
                $this->capacity = $data['product']->capacity;
            
                if($this->create()){
                    header('HTTP/1.1 201 Created', true, 201);
                    echo json_encode(array('Message' => 'Post Created'));
                } else {                    
                    header('HTTP/1.1 500 Internal Server Error', true, 500);
                    echo json_encode(array('Message' => 'Post Not Created'));
                }
            } else{
                header('HTTP/1.1 400 Bad Request', true, 400);
                echo json_encode($data['errArray']);
            }

        }
    }
