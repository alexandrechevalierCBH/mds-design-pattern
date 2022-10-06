<?php
class DBConnector
{
    private static $instance = null;
    private $conn;
    private $host = 'localhost';
    private $user = 'root';
    private $pass = '';
    private $name = 'trade-bot';

    /**
     * The function is private, so it can only be called from within the class. It creates a new
     * database connection and returns it
     */
    private function __construct()
    {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->name);
        if (mysqli_connect_error()) {
            trigger_error(
                "Failed to conencto to MySQL: " . mysqli_connect_error(),
                E_USER_ERROR
            );
        }
        echo "ok";
    }

    /**
     * > If there is no instance of the class, create one. If there is, return the existing one
     * 
     * @return The instance of the DBConnector class.
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new DBConnector();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
