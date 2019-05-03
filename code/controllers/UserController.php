<?php
class UserController extends Controller implements ManageableContract {

    /**
     * index
     * :: Lists users
     * @author rodrigomata
     */
    public function index() {
        $user = new UserModel($this->connection);
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
     * @param Int $id 
     */
    public function show($id) {

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
     * * @param Int $id 
     */
    public function update($id) {

    }

    /**
     * delete
     * :: Erases an existing user from the database
     * * @param Int $id 
     */
    public function destroy($id) {

    }

}
?>