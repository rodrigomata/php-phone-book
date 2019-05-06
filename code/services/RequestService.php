<?php
class RequestService {
    public $method;
    public $paths;
    public $params;

    const ACCEPTED_FORMATS = ['application/json'];
    const ACCEPTED_METHODS = ['GET', 'POST', 'PUT', 'DELETE'];

    function __construct() {
        $this->method = $_SERVER['REQUEST_METHOD'];
        $this->paths = explode('/', $_SERVER['REQUEST_URI']);
        $this->parseRequest();
    }

    /**
     * parseRequest
     * :: Parses incoming request if it contains a body
     * @author rodrigomata
     * @return Void|Error
     */
    private function parseRequest() {
        // :: Get contents in case a POST or PUT method was used
        if($this->method === 'POST' || $this->method === 'PUT') {
            // :: Validates if the request contains a header with the content type accepted
            if(in_array($_SERVER['CONTENT_TYPE'], self::ACCEPTED_FORMATS)) {
                $parameters = array();
                $body = file_get_contents('php://input');
                $body_decoded = json_decode($body);
                foreach($body_decoded as $key => $value) {
                    $parameters[$key] = filter_input(INPUT_POST, $value, FILTER_SANITIZE_SPECIAL_CHARS);
                }
                $this->params = $parameters;
            }
        }
    }

    /**
     * isMethodValid
     * :: Checks if the method used is valid
     * @author rodrigomata
     * @return Boolean
     */
    public function isMethodValid() {
        return in_array($this->method, self::ACCEPTED_METHODS);
    }

    /**
     * getAllParameters
     * :: Returns params saved through the request
     * @author rodrigomata
     * @return Array
     */
    public function getAllParameters() {
        return $this->params ?? [];
    }

    /**
     * getParameter
     * :: Returns a specific parameter 
     * @author rodrigomata
     * @param Mixed $param Parameter to retrieve if able
     * @return Mixed[]
     */
    public function getParameter($param) {
        return $this->params[$param] ?? null;
    }
}
?>