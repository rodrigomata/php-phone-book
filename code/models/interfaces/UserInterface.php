<?php
namespace Interfaces\User;

interface UserInterface {
    public function list();
    public function create();
    public function update($id);
    public function delete($id);
}
?>