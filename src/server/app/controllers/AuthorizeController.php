<?php

class AuthorizeController extends Controller {
    private $service;

    function __construct() {
        $this->service = new UsersService();
    }

    function index($data) {
        $response_type = $data['response_type'];
        $client_id = $data['client_id'];
        $redirect_uri = $data['redirect_uri'];
        return $this->ok($data);
    }

    function post($data) {
        $response_type = $data['response_type'];
        $client_id = $data['client_id'];
        $redirect_uri = $data['redirect_uri'];
        return $this->ok();
    }
}