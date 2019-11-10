<?php

include 'helpers/products.php';

// A controller to handle all products requests
class ProductsController {

    public function index() {
        // get all products with a json format
        $products = ProductsHelper::get_products( 'json' );

        // prepare a json response
        $return = [ 'status' => 200, 'data' => $products ];

        //print a json response
        die( json_encode( $return ) );  
    }

    public function show() {
        // get all params
        $sku    = $_REQUEST[ 'sku' ] ?? NULL;
        $unit   = $_REQUEST[ 'unit' ] ?? NULL;

        // get a product with SKU
        $product = ProductsHelper::get_product( $sku );

        // prepare a json response
        if( $product ) {
            $return = [ 'status' => 200, 'data' => $product->with_data_as_json( $unit ) ];
        }
        else {
            $return = [ 'status' => 404, 'message' => 'Product not found' ];
        }

        //print a json response
        die( json_encode( $return ) );
    }
}