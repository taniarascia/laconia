<?php

/** 
 * Database Class
 * 
 * Initiates connection to the database and simplify PDO functions.
 * 
 * The Database class will be initialized with the credentials 
 * of the SQL database, and will create a new PDO instance. The
 * rest of the model classes will access it by extending the Model class,
 * as $this->db.
 */
namespace Laconia;
use \PDO;

class Database 
{
    private $host = DB_HOST;  
    private $user = DB_USER;  
    private $pass = DB_PASS;  
    private $dbname = DB_NAME;  

    private $handler;  
    private $error;  

    private $statement;

    /**
     * Initialize the PDO connection. Set the handler as
     * the new instance to be used throughout each additional
     * function.
     */
    public function __construct() 
    {
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

    /**
     * Prepare a statement.
     */
    public function query($query) 
    {  
        $this->statement = $this->handler->prepare($query);  
    }
    
    /**
     * Bind the variables to the proper type. Allows
     * for integer, string, null, and boolean.
     */
    public function bind($param, $value, $type = null) 
    {
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

    /**
     * Execute a prepared statement.
     */
    public function execute() 
    {  
        try {
            return $this->statement->execute();  
         } catch (PDOException $e) {  
            $this->error = $e->getMessage();  
        } 
    }
    
    /**
     * Fetch a single row as a result of a query.
     */
    public function result() 
    {  
        $this->execute(); 
         
        return $this->statement->fetch(PDO::FETCH_ASSOC);  
    } 

    /**
     * Fetch a set of rows as a result of a query.
     */
    public function resultset() 
    {  
        $this->execute();  

        return $this->statement->fetchAll(PDO::FETCH_ASSOC);  
    }

    /**
     * Get the row count of the statement.
     */
    public function rowCount()
    {  
        return $this->statement->rowCount();  
    } 
    
    /**
     * Get the id of the last inserted item into the database.
     */
    public function lastInsertId() 
    {  
        return $this->handler->lastInsertId();  
    }  
}