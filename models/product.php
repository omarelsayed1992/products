<?php

// a product model to hold all product data
class product {
    private $id;
    private $name;
    private $description;
    private $sku;

    // setter and getter for all model properties
    public function set_id( $id ) {
        $this->id = $id;
    }

    public function set_name( $name ) {
        $this->name = $name;
    }

    public function set_description( $description ) {
        $this->description = $description;
    }
    
    public function set_sku( $sku ) {
        $this->sku = $sku;
    }

    public function get_id() {
        return $this->id;
    }
    
    public function get_name() {
        return $this->name;
    }

    public function get_description() {
        return $this->description;
    }
    
    public function get_sku() {
        return $this->sku;
    }

    // return a product with its prices
    public function with_data_as_json( $unit ) {
        $prices = ProductsHelper::fetch_prices();

        $product = $this->to_json();
        
        foreach( $prices as $price ) {
            $price = (array) $price;
            if( $price['id'] == $this->sku ) {
                if( !in_array( ['package', 'piece'], $unit ) ) {
                    unset( $price['id'] );
                    $product['prices'][] = (array) $price;
                }
                else {
                    if( $price['unit'] == $unit ) {
                        $product['price']['value'] = $price['price']->value;
                        $product['price']['currency'] = $price['price']->currency;
                    }
                }
            }
        }

        return $product;
    }


    // return an array to be converted as a json later
    public function to_json() {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'description'   => $this->description,
            'sku'           => $this->sku
        ];
    }

}