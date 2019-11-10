<?php
use PHPUnit\Framework\TestCase;

include 'helpers/products.php';

class ProductTest extends TestCase
{
    // Here we check that get_product method return a valid product
    public function testGetProductFound() {   
        $product = ProductsHelper::get_product( 'BA-01' );
        $this->assertEquals('Banana', $product->get_name());
        $this->assertEquals('BA-01', $product->get_sku());
    }

    // Here we check that get_product with not existing SKU will return NULL
    public function testGetProductEmpty() {   
        $product = ProductsHelper::get_product( 'Not-Found' );
        $this->assertEquals(NULL, $product);
    }
    
    // Check that get products return a valid count
    public function testGetProducts() {
        $products = ProductsHelper::get_products();
        $this->assertEquals(2, count($products));
    }
}
?>