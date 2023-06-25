<?php

namespace Core\Database\MySql;

use Core\Config;
use Core\Database\DatabaseConnectionInterface;
use Opis\Database\Connection;
use PDO;

class MySqlDatabaseConnection implements DatabaseConnectionInterface
{
    protected Connection $connection;

    protected static ?MySqlDatabaseConnection $instance = null;

    public function __construct(string $host, string $dbName, string $userName, string $password)
    {
        $this->connection = new Connection("{$this->driver()}:host={$host};dbname={$dbName}", $userName, $password);
    }

    public function connection(): Connection
    {
        return $this->connection;
    }

    public function driver(): string
    {
        return 'mysql';
    }

    public static function instance(): MySqlDatabaseConnection
    {
        if (is_null(static::$instance)) {
            $config = Config::database()['drivers']['mysql'];

            static::$instance = new static(
                $config['host'],
                $config['db_name'],
                $config['username'],
                $config['password']
            );
        }

        return static::$instance;
    }
}
