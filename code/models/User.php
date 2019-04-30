<?php
namespace Models\User;

require_once '../config/db.php';
require_once './UserInterface.php';

use Config\DB as DB;
use Interfaces\User as UserInterface;

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
}
?>