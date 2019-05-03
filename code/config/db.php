<?php
class DB {
    private $host;
    private $username;
    private $password;
    private $database;

    public $connection;

    function __construct() {
        $this->host = $_ENV["MYSQL_HOSTNAME"];
        $this->username = $_ENV["MYSQL_ROOT_USERNAME"];
        $this->password = $_ENV["MYSQL_ROOT_PASSWORD"];
        $this->database = $_ENV["MYSQL_DATABASE"];
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