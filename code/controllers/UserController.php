<?php
include_once __DIR__ . '/../config/db.php';

class UserController extends BaseController {
    private $conn;
    private $request;

    function __construct($request = null) {
        $db = new DB();
        $this->conn = $db->getConnection();
        $this->request = $request;
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

    /**
     * show
     * :: Displays a information of a single user
     * @author rodrigomata
     */
    public function show() {

    }

    /**
     * store
     * :: Saves a user into the database
     * @author rodrigomata
     */
    public function store() {

    }

    /**
     * update
     * :: Updates an existing user into the database
     * @author rodrigomata
     */
    public function update() {

    }

    /**
     * delete
     * :: Erases an existing user from the database
     */
    public function delete() {

    }

}
?>