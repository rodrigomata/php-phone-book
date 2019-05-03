<?php 
abstract class Model {
    protected $table;

    abstract public function list();
    abstract public function show();
    abstract public function create();
    abstract public function update($id);
    abstract public function delete($id);
}
?>