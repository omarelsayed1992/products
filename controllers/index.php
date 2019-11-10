<?php

// This controller is to handle bad requests
class IndexController {
    // a default action
    public function index() {
        // 400 (Bad Request)
        $return = [ 'code' => '400' ];
        die( json_encode( $return ) );
    }
}
