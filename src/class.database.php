<?php

class Database {
    private $host = DB_HOST;  
    private $user = DB_USER;  
    private $pass = DB_PASS;  
    private $dbname = DB_NAME;  

    private $handler;  
    private $error;  

    private $statement;

    public function __construct() {
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;  
        $options = [
            PDO::ATTR_PERSISTENT => true,  
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION  
        ]; 
        
        try {  
            $this->handler = new PDO($dsn, $this->user, $this->pass, $options);  
        } catch (PDOException $e) {  
            $this->error = $e->getMessage();  
        } 
    } 
    
    public function query($query) {  
        $this->statement = $this->handler->prepare($query);  
    }   

    public function bind($param, $value, $type = null) {
        if (is_null($type)) {  
            switch (true) {  
                case is_int($value):  
                    $type = PDO::PARAM_INT;  
                    break;  
                case is_bool($value):  
                    $type = PDO::PARAM_BOOL;  
                    break;  
                case is_null($value):  
                    $type = PDO::PARAM_NULL;  
                    break;  
                default:  
                    $type = PDO::PARAM_STR;  
            }  
        }
        $this->statement->bindValue($param, $value, $type);   
    } 

    public function execute() {  
        try {
            return $this->statement->execute();  
         } catch (PDOException $e) {
            if ($e->errorInfo[1] == 1062) {
                $message = 'Duplicate entry';
                return $message;
            }
        }
    }  

    public function result() {  
        $this->execute(); 
         
        return $this->statement->fetch(PDO::FETCH_ASSOC);  
    } 
    
    public function resultset() {  
        $this->execute();  

        return $this->statement->fetchAll(PDO::FETCH_ASSOC);  
    }

    public function rowCount(){  
        return $this->statement->rowCount();  
    }    

    public function lastInsertId() {  
        return $this->handler->lastInsertId();  
    }  
}