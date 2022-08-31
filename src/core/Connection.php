<?php
declare(strict_types=1);

namespace Src\Core;

use PDO;
use PDOException;

abstract class Connection
{
    /**
     * @var PDO
     */
    private PDO $connection;

    /**
     * @var string
     */
    private string $host = '127.0.0.1:3306';
    private string $db = 'board_proj';
    private string $user = 'root';
    private string $pass = '';

    /**
     * @return PDO|null
     */
    protected function con(): ?PDO
    {
        try {
            $mysql = 'mysql:host='.$this->host.';dbname='.$this->db;
            $this->connection = new PDO($mysql, $this->user, $this->pass);
            $this->connection->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
            $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            return $this->connection;
        } catch (PDOException $e) {
            return null;
        }
    }

    /**
     * @return string
     */
    public function getDbName(): string
    {
        return $this->db;
    }
}