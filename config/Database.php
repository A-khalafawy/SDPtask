<?php

class Database {
    private static $instance = null; // Static property to hold the single instance
    private $pdo; // Property to hold the PDO connection

    // Private constructor to prevent direct instantiation
    private function __construct() {
        // Database connection details
        $dsn = 'mysql:host=localhost;dbname=non_profit_management';
        $username = 'root'; // Your DB username
        $password = '';     // Your DB password

        try {
            // Create PDO instance for database connection
            $this->pdo = new PDO($dsn, $username, $password);
            // Set error mode to exception for debugging purposes
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // If connection fails, display error message
            die("Connection failed: " . $e->getMessage());
        }
    }

    // Public static method to get the single instance of the class
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self(); // Create a new instance if none exists
        }
        return self::$instance;
    }

    // Query method to select data
    public function query($sql, $params = []) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Ensure associative array fetch
            if (empty($result)) {
                error_log("Query returned no results: " . $sql);
            }
            return $result;
        } catch (PDOException $e) {
            error_log("Database query error: " . $e->getMessage());
            die("Database query error: " . $e->getMessage());
        }
    }
     

    // Execute method for insert, update, delete operations
    public function execute($sql, $params = []) {
        try {
            $stmt = $this->pdo->prepare($sql);
            $result = $stmt->execute($params);
            if (!$result) {
                echo "<pre>";
                print_r($stmt->errorInfo());
                echo "</pre>";
            }
            
            
            return $result;
        } catch (PDOException $e) {
            error_log("PDO Exception: " . $e->getMessage());
            die("Database execute error: " . $e->getMessage());
        }
    }
    
    public function prepare($sql) {
        return $this->pdo->prepare($sql);
    }
    

    public function lastInsertId() {
        return $this->pdo->lastInsertId();
    }

    // Prevent cloning of the instance
    private function __clone() {}

    // Prevent unserializing of the instance
   public function __wakeup() {}
}

?>
