<?php
namespace App;

    use App\Product;
    use PDO;

    class Read extends Product {
        private $result;
        private $products = array();

        function dataArray() {
            $this->result = $this->read();
            $num = $this->result->rowCount();

            if($num > 0){
            
                while($outPutaData = $this->result->fetch(PDO::FETCH_ASSOC)){
                    array_push($this->products, array(
                        'id' => $outPutaData['id'],
                        'name' => $outPutaData['name'],
                        'type' => $outPutaData['type'],
                        'price' => $outPutaData['price'],
                        'data' => $outPutaData['data'],
                        'sku' => $outPutaData['sku'],
                    ));
                }
                echo json_encode($this->products);
                } else {
                    echo json_encode(array());
                }
        }

    }
