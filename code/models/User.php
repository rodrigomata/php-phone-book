<?php
class User extends Model {
    private $connection;

    protected $table = "users";

    public $id;
    public $first_name;
    public $last_name;
    public $phones;
    public $emails;

    function __construct($db) {
        $this->connection = $db;
    }

    /**
     * list
     * :: Prepares query to list users
     * @author rodrigomata
     * @return PDOStatement
     */
    public function list() {
        $query = "SELECT 
            u.id as id, u.first_name as first_name, u.last_name as last_name, u.created as created,
            e.email as emails,
            p.phone as phones
            FROM {$this->table} as u 
            LEFT JOIN emails e ON e.id_user = u.id
            LEFT JOIN phones p ON p.id_user = u.id 
            ORDER BY u.created DESC";

        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    /**
     * show
     * :: Prepares query to show a single user
     * @author rodrigomata
     * @param Integer $id ID of the user to be displayed
     * @return PDOStatement
     */
    public function show($id) {
        $query = "SELECT 
            u.id as id, u.first_name as first_name, u.last_name as last_name, u.created as created,
            e.email as emails,
            p.phone as phones
            FROM {$this->table} as u 
            LEFT JOIN emails e ON e.id_user = u.id
            LEFT JOIN phones p ON p.id_user = u.id 
            WHERE u.id = $id";

        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    /**
     * create
     * :: Prepares query to insert user
     * @author rodrigomata
     * @return Boolean
     */
    public function create() {
        $query = "INSERT INTO {$this->table} 
            SET 
            first_name = :first_name
            last_name = :last_name
            phones = :phones
            emails = :emails";
        $stmt = $this->connection->prepare($query);

        // :: Bind parameters
        $stmt->bindParam(':first_name', $this->first_name);
        $stmt->bindParam(':last_name', $this->last_name);
        // :: Build JSON arrays
        $json_phones = "JSON_OBJECT('phones', JSON_ARRAY($this->phones))";
        $json_emails = "JSON_OBJECT('emails', JSON_ARRAY($this->emails))";
        $stmt->bindParam(':phones', $json_phones);
        $stmt->bindParam(':emails', $json_emails);

        $stmt->execute();
        return $stmt;
    }

    /**
     * createEmails
     * :: Creates the respective emails associated
     * @author rodrigomata
     * @param Integer $id ID of the created user
     * @return Boolean
     */
    private function createEmails($id) {
        $query = 
    }

    /**
     * update
     * :: Prepares query to update existing user
     * @author rodrigomata
     * @return Boolean
     */
    public function update($id) {

    }

    /**
     * delete
     * :: Prepares query to delete existing user
     * @author rodrigomata
     * @return Boolean
     */
    public function delete($id) {

    }
}
?>