<?php

namespace Core\Database;

use Opis\Database\Connection;

interface DatabaseConnectionInterface
{
    public function connection(): Connection;

    public function driver();
}
