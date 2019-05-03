<?php
include_once __DIR__ . '/../config/db.php';
include_once __DIR__  . '/../models/User.php';

use Models\User\User as User;

class UserController {
    private $conn;

    function __construct() {
        $db = new DB();
        $this->conn = $db->getConnection();
    }

    /**
     * getAction
     * :: Lists users
     * @author rodrigomata
     * @return Array $items Users fetched
     */
    public function getAction() {
        $user = new User($this->conn);
        $stmt = $user->list();

        $num = $stmt->rowCount();

        $items = array();
        if($num > 0) {
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $item = array(
                    'id' => $id,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'emails' => $emails,
                    'phones' => $phones,
                    'created' => $created
                );
                array_push($items, $item);
            }
        }
        return $items;
    }
    public function postAction() {

    }
    public function putAction() {

    }
    public function deleteAction() {

    }

}
?>