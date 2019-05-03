<?php
class UserModel extends Model {
    private $conn;

    protected $table = "users";

    public $id;
    public $first_name;
    public $last_name;
    public $phones;
    public $emails;

    function __construct($db) {
        $this->conn = $db;
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

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    /**
     * show
     * :: Prepares query to show a single user
     * @author rodrigomata
     * @return PDOStatement
     */
    public function show() {

    }

    /**
     * create
     * :: Prepares query to insert user
     * @author rodrigomata
     * @return Boolean
     */
    public function create() {
        // $query = "INSERT INTO {$this->table} SET "
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