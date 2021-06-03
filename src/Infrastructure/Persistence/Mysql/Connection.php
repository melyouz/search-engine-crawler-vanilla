<?php

namespace App\Infrastructure\Persistence\Mysql;

use Exception;
use PDO;
use PDOException;

class Connection
{
    private $conn;

    public function __construct(string $mysqlHost, string $mysqlUsername, string $mysqlPassword, string $mysqlDatabase)
    {
        $dsn = sprintf('mysql:host=%s;dbname=%s', $mysqlHost, $mysqlDatabase);
        $this->conn = new PDO($dsn, $mysqlUsername, $mysqlPassword);
    }

    public function insert(string $query, array $params): string
    {
        $st = $this->conn->prepare($query);

        try {
            $this->conn->beginTransaction();
            $st->execute($params);
            $this->conn->commit();
            return $this->conn->lastInsertId();
        } catch (PDOException $e) {
            $this->conn->rollback();
            throw new Exception($e->getMessage());
        }
    }

    public function query(string $query, array $params)
    {
        $st = $this->conn->prepare($query);
        $st->execute($params);
        
        return $st->fetchAll();
    }
}