<?php
    class Database
    {
    private $conn;

    public function __construct()
    {
    $this->conn = new PDO(
    "mysql:host=localhost;dbname=autos;charset=utf8",
    "root",
    ""
    );
    }

    public function getConnection()
    {
    return $this->conn;
    }
    }