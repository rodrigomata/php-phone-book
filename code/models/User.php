<?php
namespace Models\User;

require_once __DIR__ . '/interfaces/UserInterface.php';

use Interfaces\User\UserInterface as UserInterface;

class User implements UserInterface {
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
        $query = "SELECT u.id as id, u.first_name as first_name, u.last_name as last_name,
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
    public function create() {

    }
    public function update($id) {

    }
    public function delete($id) {

    }
}
?>