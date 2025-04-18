<?php

namespace App\Services;

class UserService extends ApiService
{
    public function __construct()
    {
        $this->endpoint = 'http://microservice_user_php:8000/api';
    }
}