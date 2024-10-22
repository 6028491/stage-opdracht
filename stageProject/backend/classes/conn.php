<?php

abstract class Database
{    
    public $conn;
    public function __construct($username = 'root', $password = '', $dbname = 'freshPortalOpdracht', $servername = 'localhost')
    {
        try{
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            die($e->getMessage());
        }
    }
}