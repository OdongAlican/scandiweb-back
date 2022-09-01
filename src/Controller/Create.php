<?php
namespace App;

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, 
    Access-Control-Allow-Methods, Authorization, X-Requested-with');

    use App\Database;
    use App\Product;
    use App\Helper;

    class Create {
        function addProduct(){

            $database = new Database();
            $db = $database->connect();
        
            $product = new Product($db);
            $formData = json_decode(file_get_contents("php://input"));

            $formValidator = new Helper();
            $data = $formValidator->validate($formData);

            if($data['submit']) {
                
                $product->name = $data->name;
                $product->type = $data->type;
                $product->price = $data->price;
                $product->capacity = $data->capacity;
            
                if($product->create()){
                    echo json_encode(array('Message' => 'Post Created'));
                } else {
                    echo json_encode(array('Message' => 'Post Not Created'));
                }
            }else{
                echo json_encode($data['errArray']);
            }

        }
    }
