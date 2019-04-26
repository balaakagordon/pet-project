<?php

namespace App\core;

class BaseController
{
    public function __construct()
    {
        $this->prepareResponse();
    }

    public function prepareResponse($message = '', $status = '', $data = [])
    {
        return [
            "message" => $message,
            "status" => $status,
            "data" => $data
        ];
    }
}