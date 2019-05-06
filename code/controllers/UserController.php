<?php
class UserController extends Controller implements ManageableContract {

    /**
     * index
     * :: Lists users
     * @author rodrigomata
     */
    public function index() {
        $user = new User($this->connection);
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
        RenderService::json($data);
    }

    /**
     * show
     * :: Displays a information of a single user
     * @author rodrigomata
     * @param Int $id 
     */
    public function show($id) {
        $user = new User($this->connection);
        $stmt = $user->show();

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
        RenderService::json($data);
    }

    /**
     * store
     * :: Saves a user into the database
     * @author rodrigomata
     */
    public function store() {
        $user = new User($this->connection);

        // :: Set properties for the user depending on Params
        $user->first_name = $this->request->getParameter('first_name');
        $user->last_name = $this->request->getParameter('last_name');
        $user->phones = $this->request->getParameter('phones');
        $user->emails = $this->request->getParameter('emails');

        $data = array('data' => []);
        if(!$stmt = $user->create()) {
            $data['message'] = 'Unable to create user. Try again later.';
            RenderService::json($data, 503);
            return;
        }
        $data['message'] = 'User created successfully';
        RenderService::json($data);
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