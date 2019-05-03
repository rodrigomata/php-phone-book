<?php
class DatabaseService {
    private $host;
    private $username;
    private $password;
    private $database;

    public $connection;

    function __construct() {
        $config = require __DIR__ . '/../config/db.php';
        $this->host = $config['host'];
        $this->username = $config['username'];
        $this->password = $config['password'];
        $this->database = $config['database'];
    }

    /**
     * getConnection
     * :: Get current connection or create one if needed
     * @author rodrigomata
     * @return PDOStatement|PDOException
     */
    public function getConnection() {
        $this->connection = null;

        try{
            $this->connection = new PDO("mysql:host={$this->host};dbname={$this->database};charset=utf8", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        }catch(PDOException $exception){
            echo "Error: " . $exception->getMessage();
        }

        return $this->connection;
    }
}
?>