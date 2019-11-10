<?php

include 'models/product.php';

// an helper to handle product issues
class ProductsHelper {

    // get a single product with a valid SKU
    public static function get_product( $sku ) {
        $products = self::get_products();

        $product = NULL;

        foreach( $products as $p ) {
            if( $p->get_sku() == $sku ) {
                $product = $p;
                break;
            }
        }

        return $product;
    }

    // get all products
    public static function get_products( $format = NULL ) {

        $products = self::fetch_products();

        if( $format == 'json' ) {
            $products = array_map( function( $p ) {
                return $p->to_json();
            }, $products );
        }

        return $products;
    }

    // fetch products from a sample XML file
    public function fetch_products() {
        $products_xml   = file_get_contents( 'mocks/products.xml' );

        $xml            = simplexml_load_string( $products_xml );

        return self::parse_products( $xml );
    }

    // fetch products from a sample json file
    public static function fetch_prices() {
        $prices = file_get_contents( 'mocks/prices.json' );

        return json_decode( $prices );
    }

    // parse products XML file to extract data
    public function parse_products( $xml ) {
        $products = [];
        foreach( $xml->children() as $element ) {
            $product = new Product();

            $product->set_id( (String) $element['id'] );
            $product->set_name( (String) $element->Name );
            $product->set_description( (String) $element->Description );
            $product->set_sku( (String) $element->sku );

            $products[] = $product;
        }

        return $products;
    }

}
