<?php
class DB {
    private $host = getenv('MYSQL_HOSTNAME');
    private $username = getenv('MYSQL_ROOT_USERNAME');
    private $password = getenv('MYSQL_ROOT_PASSWORD');
    private $database = getenv('MYSQL_DATABASE');

    public $connection;

    /**
     * getConnection
     * :: Singleton to get current connection or create one if needed
     */
    public function getConnection() {
        $this->connection = null;

        try{
            $this->connection = new PDO("mysql:host={$this->host};dbname={$this->database}", $this->username, $this->password);
            $this->connection->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Error: " . $exception->getMessage();
        }

        return $this->connection;
    }
}
?>