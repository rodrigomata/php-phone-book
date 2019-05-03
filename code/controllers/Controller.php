<?php
abstract class Controller {
    public $connection;
    public $request;

    public function __construct($request = null) {
        $db = new DatabaseService();
        $this->connection = $db->getConnection();
        $this->request = $request;
    }
}
?>