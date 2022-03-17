<?php

namespace App\System;

use \PDO;

class Database
{
    /**
     * @var string
     */
    private $host = '127.0.0.1';

    /**
     * @var string
     */
    private $devHost = '127.0.0.1';

    /**
     * @var string
     */
    private $db = 'database';

    /**
     * @var string
     */
    private $devDb = 'dev_database';

    /**
     * @var string
     */
    private $user = 'user';

    /**
     * @var string
     */
    private $devUser = 'dev_user';

    /**
     * @var string
     */
    private $pass = 'password';

    /**
     * @var string
     */
    private $devPass = 'password';

    /**
     * @var string
     */
    private $charset = 'utf8mb4';

    /**
     * PDO
     */
    private $pdo;

    /**
     * Constructor initialises Database
     */
    public function __construct()
    {
        // Development configuration
        if ($_SERVER['REMOTE_ADDR'] == $this->devHost) {
            $this->host = $this->devHost;
            $this->db = $this->devDb;
            $this->user = $this->devUser;
            $this->pass = $this->devPass;
        }

        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (\PDOException $e) {
            // TODO Show a more pretty error page
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

        // Create tables if not exists
        $this->createTables();
    }

    /**
     * Get Single Result
     *
     * @param string $query
     *
     * @return mixed
     */
    public function getSingleResult($query)
    {
        $stmt = $this->pdo->query($query);

        return $stmt->fetchColumn();
    }

    /**
     * Get Array Result
     *
     * @param string $query
     * @param Array $param
     *
     * @return string[]
     */
    public function getArrayResult($query, $params = [])
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    /**
     * Insert into database with a given query
     *
     * @param string $query
     * @param Array $data
     */
    public function modify($query, $data): void
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($data);
    }

    /**
     * Create tables needed for VON WESCH
     */
    private function createTables(): void
    {
        $tables = scandir(__DIR__.'/../Database');

        for ($i = 2; $i < count($tables); $i++) {
            $sql = file_get_contents('../Database/'.$tables[$i]);
            $this->pdo->exec($sql);
        }
    }
}
