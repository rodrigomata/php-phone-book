<?php 
abstract class BaseModel {
    abstract public function list();
    abstract public function show();
    abstract public function create();
    abstract public function update($id);
    abstract public function delete($id);
}
?>