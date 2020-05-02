<?php

namespace Aurore\Model;
require_once "Manager.php";

class ImageManager extends Manager {

    public function getImages() {
        $db = $this->dbConnect();
        $query = $db->query("select * from image order by id desc");
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getImagesLike($string) {
        $db = $this->dbConnect();
        $query = $db->prepare("select * from image where (description like :q or id like :q) order by id desc");
        $query->execute([':q' => '%'.$string.'%']);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getImageById($id) {
        $db = $this->dbConnect();
        $query = $db->prepare("select * from image where id=?");
        $query->execute([$id]);
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function add($url,$description,$userid) {
        $db = $this->dbConnect();
        $query = $db->prepare("insert into image(url,description,user) VALUES(?,?,?)");
        $query->execute([$url, $description, $userid]);
        return $query;
    }

    public function delete($id) {
        $db = $this->dbConnect();
        $query = $db->prepare("delete from image where id=?");
        $query->execute([$id]);
        return $query;
    }

}