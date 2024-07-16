<?php
session_start();
class Database
{
    public $connection;
    public $statement;
    public function __construct(private string $username = "root", private string $password = "2021BSi.t")
    {
        $database = [
            "host" => "localhost",
            "user" => "root",
            "port" => 3306,
            "dbname" => "security_two_db",
            "charset" => "utf8mb4",
        ];
        $dsn = "mysql: " . http_build_query($database, '', ";");
        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);
        return $this;
    }
    public function get()
    {
        return $this->statement->fetchAll();
    }
    public function find()
    {
        return $this->statement->fetch();
    }
}
