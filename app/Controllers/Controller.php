<?php

namespace App\Controllers;

class Controller
{
    public function responseJson($payload, int $status)
    {
        http_response_code($status);

        if (is_array($payload))
            return json_encode($payload);

        return $payload;
    }
}
