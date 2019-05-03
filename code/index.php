<?php
// :: Autoloader functionality to include all necessary files
spl_autoload_register('autoloader');
function autoloader($classname) {
    // :: Controllers
    if (preg_match('/[a-zA-Z]+Controller$/', $classname)) {
        include __DIR__ . '/controllers/' . $classname . '.php';
        return true;
    } 
    // :: Views
    else if (preg_match('/[a-zA-Z]+View$/', $classname)) {
        include __DIR__ . '/views/' . $classname . '.php';
        return true;
    }
    // :: Services
    else if (preg_match('/[a-zA-Z]+Service$/', $classname)) {
        include __DIR__ . '/services/' . $classname . '.php';
        return true;
    }
    return false;
}

// :: Instantiate request to know the resources
$request = new RequestService();
// :: Validate 
if($request->isMethodValid()) {
    $data = array('data' => []);
    if($request->paths[1] !== 'api' || count($request->paths) <= 2) {
        $data['message'] = 'ERROR: Wrong usage of api';
        JsonView::render($data);
        return;
    }
    // :: Checks if the controller exists
    $controller_name = ucfirst($request->paths[2]) . 'Controller';
    if(class_exists($controller_name)) {
        $action = strtolower($request->method) . 'Action';
        try {
            $controller = new $controller_name();
            $result = $controller->$action($request);
            $data['data'] = $result;
            $data['message'] = 'OK';
        } catch (Exception $e) {
            $data['message'] = $e->getMessage();
        } finally {
            JsonView::render($data);
        }
    }
}

?>