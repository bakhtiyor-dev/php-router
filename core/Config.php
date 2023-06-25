<?php

namespace Core;

class Config
{
    public static function database()
    {
        return require __DIR__ . '/../config/database.php';
    }
}
