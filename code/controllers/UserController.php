<?php
include_once __DIR__ . '/../config/db.php';

class UserController extends BaseController {
    private $conn;

    function __construct() {
        $db = new DB();
        $this->conn = $db->getConnection();
    }

    /**
     * list
     * :: Lists users
     * @author rodrigomata
     */
    public function list() {
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
        
        $data = array(
            'data' => $items,
            'message' => 'OK'
        );
        JsonView::render($data);
    }
    public function show() {

    }
    public function store() {

    }
    public function update() {

    }
    public function delete() {

    }

}
?>