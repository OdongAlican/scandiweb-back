<?php

// namespace App;
namespace App;

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    use App\Database;
    use App\Product;
    use PDO;

    class Read {
        function dataArray() {

        $database = new Database();
        $db = $database->connect();
    
        $product = new Product($db);
        $result = $product->read();
    
        $num = $result->rowCount();
        $products = array();

        if($num > 0){
        
            while($outPutaData = $result->fetch(PDO::FETCH_ASSOC)){
                array_push($products, array(
                    'id' => $outPutaData['id'],
                    'name' => $outPutaData['name'],
                    'type' => $outPutaData['type'],
                    'price' => $outPutaData['price'],
                    'capacity' => $outPutaData['capacity'],
                ));
            }
            echo json_encode($products);
            } else {
                echo json_encode(array('Message' => 'No Products'));
            }
        }

    }
