<?php
namespace App;

    use App\Product;
    use App\Helper;

    class Delete extends Product {

        function deleteProduct(){        

            $formData = json_decode(file_get_contents("php://input"));
            var_dump(count($formData));
            if(count($formData) > 0) {
                $this->result = $this->delete($formData);
            }{
                echo json_encode(array('Message' => 'Please Select Elements To Delete'));
            }
            
        }
    }
