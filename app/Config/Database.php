<?php
/**
 * Database Configuration Class
 */

namespace App\Config;

class Database
{
    private static $instance = null;
    private $connection;

    private function __construct()
    {
        $this->connect();
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function connect()
    {
        try {
            $dsn = 'mysql:host=' . getenv('DB_HOST', 'localhost') 
                   . ';port=' . getenv('DB_PORT', 3306)
                   . ';dbname=' . getenv('DB_NAME', 'nturuba_school_db')
                   . ';charset=' . getenv('DB_CHARSET', 'utf8mb4');

            $this->connection = new \PDO(
                $dsn,
                getenv('DB_USER', 'root'),
                getenv('DB_PASSWORD', ''),
                [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                    \PDO::ATTR_EMULATE_PREPARES => false,
                ]
            );
        } catch (\PDOException $e) {
            die('Database Connection Failed: ' . $e->getMessage());
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function query($sql)
    {
        return $this->connection->prepare($sql);
    }
}
