<?php
namespace App;

    use App\Product;
    use App\Helper;

    class Create extends Product {

        function addProduct(){        

            $formData = json_decode(file_get_contents("php://input"));
            
            $formValidator = new Helper();
            $data = $formValidator->validate($formData);
            
            if($data['submit']) {
                
                $this->name = $data['product']->name;
                $this->sku = $data['product']->sku;
                $this->type = $data['product']->type;
                $this->price = $data['product']->price;
                $this->data = $data['product']->data;
            
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
