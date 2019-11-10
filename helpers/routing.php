<?php

// Routing service to handle all routing issues
class Routing {

    private $uri;
    private $controller;
    private $action;
    private $tokens;

    // existing route rules
    private $available_controllers = [ 'products' => ['index', 'show'], 'index' => ['index'] ];

    public function __construct() {
        $this->expose_uri();
        $this->expose_uri_tokens();
        $this->guess_controller();
        $this->guess_action();
    }

    // get a uri
    private function expose_uri() {
        $uri = trim($_SERVER['REQUEST_URI'], '/');

        $this->uri = $uri;
    }

    // explode uri into tokens
    private function expose_uri_tokens() {
        $this->tokens = explode( '/', $this->uri );
    }

    // try to guess a specified controller
    private function guess_controller() {
        $this->controller = $this->tokens[0] ?? 'index';
        
        if( !isset( $this->available_controllers[ $this->controller ] ) ) {
            $this->controller = 'index';
        }
    }

    // try to guess a specified action
    private function guess_action() {
        $rest = $this->tokens[1] ?? 'index';
        $rest = explode( '?', $rest );
        $this->action = $rest[0];

        if( $this->action != 'index' && !in_array( $this->action, $this->available_controllers[ $this->controller ] ) ) {
            $this->controller = 'index';
            $this->action = 'index';
        }
    }

    // include all controllers
    private function include_controllers() {
        foreach (glob("controllers/*.php") as $filename) {
            include $filename;
        }
    }

    // start to run application
    public function run() {
        $this->include_controllers();

        $controller_name = ucfirst( $this->controller ) . 'Controller';
        
        // creating an instance from a specified controller
        $controller = new $controller_name();

        // calling specified action of that controller
        call_user_func( array( $controller, $this->action ) );

    }
}