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
    // :: Models
    else if (preg_match('/[a-zA-Z]$/', $classname)) {
        include __DIR__ . '/models/' . $classname . '.php';
        return true;
    }
    return false;
}

// :: Instantiate request to know the resources
$request = new RequestService();
// :: Dispatch the route
$router = new RouterService($request);
$router->dispatch();

?>