<?php
namespace Interfaces\User;

interface UserInterface {
    public function create();
    public function update();
    public function delete();
    public function get($id);
    public function list();
}
?>