<?php
abstract class BaseController {
    abstract public function list();
    abstract public function show();
    abstract public function store();
    abstract public function update();
    abstract public function delete();
}
?>