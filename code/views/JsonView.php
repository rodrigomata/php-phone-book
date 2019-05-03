<?php
include_once __DIR__ . '/../models/View.php';

use Base\View\View as View;

class JsonView extends View {
    /**
     * render
     * :: Displays data encoded in json
     * @author rodrigomata
     * @param Array $content Content to be encoded
     * @return Boolean
     */
    public static function render($content) {
        header('Content-Type: application/json; charset=utf8');
        echo json_encode($content);
        return true;
    }
}
?>