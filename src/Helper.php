<?php
namespace App;

class Helper {

    function validate($product){       

        $emptyValues = array();
        $output = array('product' => $product, 'errArray' => $emptyValues, 'submit' => true );

        foreach( $product as $key => $value ) {
            if(strlen($value) < 1) { array_push($emptyValues, $key . " is missing!"); }
        }

        if(count($emptyValues) > 0) {
            $output['submit'] = false;
            $output['errArray'] = $emptyValues;
        }
        return $output;
    }

}