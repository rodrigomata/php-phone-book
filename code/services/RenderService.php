<?php
class RenderService {

    /**
     * json
     * :: Displays data encoded in json
     * @author rodrigomata
     * @param Array $content Content to be encoded
     * @param Integer $code HTTP response code
     * @return Boolean
     */
    public static function json($content, $code = 200) {
        header('Content-Type: application/json; charset=utf8');
        http_response_code($code);
        echo json_encode($content);
        return true;
    }
}
?>