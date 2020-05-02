<?php


namespace Aurore\Model;
require_once "Manager.php";

class UserManager extends Manager
{
    public function connectUser($username,$password) {
        $db = $this->dbConnect();
        $query = $db->prepare("select * from user where username=? and password=?");
        $query->execute([$username,$password]);
        //return ($query->rowCount()==1)?true:false;
        return $query->fetchAll(\PDO::FETCH_ASSOC)[0];
    }

    public function getUserById($id) {
        $db = $this->dbConnect();
        $query = $db->prepare("select * from user where id=?");
        $query->execute([$id]);
        return $query->fetchAll(\PDO::FETCH_ASSOC)[0];
    }
}