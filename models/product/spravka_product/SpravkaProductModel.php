<?php
namespace models\product\spravka_product;

use models\Database;

class SpravkaProductModel {
    private $db;

    public function __construct(){
        $this->db = Database::getInstance()->getConnection();

        try{
            $result = $this->db->query("SELECT 1 FROM `spravka_product` LIMIT 1");
        } catch(\PDOException $e){
            $this->createTable();
        }
    }

    public function createTable(){
        $spravkaProductTableQuery = "CREATE TABLE IF NOT EXISTS `spravka_product` (
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `title` VARCHAR(255) NOT NULL,
            `description` TEXT,
            `norm_of_hours` VARCHAR(10),
            `weight` VARCHAR(10)
        )";

        try{
            $this->db->exec($spravkaProductTableQuery);
            return true;
        } catch(\PDOException $e){
            return false;
        }
    }

    public function getAllSpravkaProduct(){

        try{
            $stmt = $this->db->query("SELECT * FROM spravka_product");
            $spravka_product = [];
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $spravka_product[] = $row;
            }
            return $spravka_product;
        }catch(\PDOException $e){
            return false;
        }
    }

    public function getSpravkaProductById($id){
        $query = "SELECT * FROM spravka_product WHERE id = ?";

        try{
            $stmt =$this->db->prepare($query);
            $stmt->execute([$id]);
            $spravka_product = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $spravka_product ? $spravka_product : false;
        } catch(\PDOException $e){
            return false;
        }
    }

    public function createSpravkaProduct($title, $norm_of_hours, $weight) {

        $query = "INSERT INTO spravka_product (title, norm_of_hours, weight) VALUES (?, ?, ?)";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$title, $norm_of_hours, $weight]);
            return true;
        } catch(\PDOException $e) {
            return false;
        }
    }

    public function updateSpravkaProduct($id, $title, $norm_of_hours, $weight){
        $query = "UPDATE spravka_product SET title = ?, norm_of_hours = ?, weight = ? WHERE id = ?";
        
        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$title, $norm_of_hours, $weight, $id]);
            
            return true;
        } catch(\PDOException $e){
            return false;
        }
    }

    public function deleteSpravkaProduct($id){
        $query = "DELETE FROM spravka_product WHERE id = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return true;
        } catch(\PDOException $e) {
            return false;
        }
    }

}
