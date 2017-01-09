<?php

class LoginApiController extends Controller {
    private $service;
    
    function __construct(AuthService $service = NULL) {
        if ($service) {
            $this->service = $service;
        } else {
            $this->service = new AuthService(Db::getInstance());
        }
    }

    function post($username, $password) {
        $result = $this->service->login($username, $password);
        if ($result->success) {
            return $this->ok($result);
        } else {
            return $this->badRequest($result);
        }
    }
}