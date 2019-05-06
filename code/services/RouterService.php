<?php
class RouterService {
    private $request;
    private $routes;
    private $route;
    private $path;
    private $path_array;
    private $path_valid;

    function __construct($request) {
        $this->routes = require __DIR__ . '/../config/routes.php';
        $this->request = $request;
    }

    /**
     * dispatch
     * :: Validates requests and if able, dispatches the action
     * @author rodrigomata
     */
    public function dispatch() {
        // :: Assign variables
        $this->path_array = array_slice($this->request->paths, 1);
        $this->path = implode('/', $this->path_array);

        // :: Validations
        $data = array('data' => []);
        if(!$this->validateRequest()) {
            return;
        }
        
        // :: Dispatch 
        $controller_name = $this->route[0];
        $action = $this->route[1];

        $controller = new $controller_name();
        $controller->$action($this->request);
    }

    /**
     * validateRequest
     * :: Performs series of checks to the request
     * @author rodrigomata
     * @return Boolean
     */
    private function validateRequest() {

        if(!$this->request->isMethodValid()) {
            $data['message'] = 'ERROR: Unknown method';
            RenderService::render($data, 405);
            return false;
        }
        if(!$this->request->validateRoute()) {
            $data['message'] = 'ERROR: Unknown route';
            RenderService::render($data, 404);
            return false;
        }
        if(!$this->isControllerValid()) {
            $data['message'] = 'ERROR: Wrong usage of api';
            RenderService::render($data, 404);
            return false;
        }
        return true;
    }

    /**
     * validateRoute
     * :: Checks if the request is a valid mapped route
     * @author rodrigomata
     * @return Boolean
     */
    private function validateRoute() {
        // :: First check if the exact route exists
        if($this->routeExists()) {
            return true;
        }
        // :: The route probably has a wildcard and needs to be replaced
        // :: Transform int parameters to wildcard to compare
        $temp = array_map(array($this, 'transformPaths'), $this->path_array);
        $new_path = implode('/', $temp);
        // :: Check again if the route exists
        if($this->routeExists($new_path)) {
            return true;
        }
        return false;
    }

    /**
     * transformPaths
     * :: Utility to check for wildcards
     * @author rodrigomata
     * @return String
     */
    private function transformPaths($path) {
        return filter_var($path, FILTER_VALIDATE_INT) ? ':id' : $path;
    }

    /**
     * routeExists
     * :: Verifies if the route is valid and assigns to private variable
     * @author rodrigomata
     * @return Boolean
     */
    private function routeExists($path = null) {
        $check_path = $path ?? $this->path;
        if(array_key_exists($check_path, $this->routes[$this->request->method])) {
            $this->path_valid = $check_path;
            return true;
        }
        return false;
    }

    /**
     * isControllerValid
     * :: Verifies if the controller is valid
     * @author rodrigomata
     * @return Boolean
     */
    private function isControllerValid() {
        $temp_route = $this->routes[$this->request->method][$this->path_valid];
        $this->route = explode('@', $temp_route);
        return class_exists($this->route[0]);
    }
}
?>