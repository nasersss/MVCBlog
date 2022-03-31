<?php

class Category{

public $CategoryId;
public $name;
public $img;

private $db; 

public function __construct() {
    $this->db = new Database; 
}
public function getCategory() {
    $this->db->query(" SELECT * FROM categories");
    return $results = $this->db->resultSet();
}
public function getCatById($id) {
        $this->db->query('SELECT * FROM categories WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
}
public function addCategory($data) {
        $this->db->query('INSERT INTO categories (name,user_id) VALUES (:name,:user_id)');

    // Bind Values 
    $this->db->bind(':name', $data['name']);
    $this->db->bind(':user_id', intval($data['user_id']));

    // Execute 
    if($this->db->execute()){
            return true; 
    }else {
            return false; 
    }
    
}

public function updateCategory($data) {
    $this->db->query('UPDATE categories SET name = :name WHERE id = :id ');
    // Bind Values 
    $this->db->bind(':id', $data['id']);
    $this->db->bind(':name', $data['name']);

    // Execute 
    if($this->db->execute()){
            return true; 
    }else {
            return false; 
    }
}
public function deleteCat($id) {
    $this->db->query('DELETE FROM categories WHERE id = :id ');
    // Bind Values 
    $this->db->bind(':id', $id);

    // Execute 
    if($this->db->execute()){
            return true; 
    }else {
            return false; 
    }
}


}