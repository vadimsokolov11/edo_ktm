<?php
namespace models\layout;

use models\Database;
use models\roles\Role;

class LayoutModel {
    private $db;

    public function __construct(){
        $this->db = Database::getInstance()->getConnection();

        try{
            $result = $this->db->query("SELECT 1 FROM `menu` LIMIT 1");
        } catch(\PDOException $e){
            $this->createTable();
        }
    }

    public function createTable(){
        $menuTableQuery = "CREATE TABLE IF NOT EXISTS `submenu` (
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `title` VARCHAR(255) NOT NULL,
            `description` TEXT,
            `status` TINYINT(1) NOT NULL DEFAULT 1
        )";

        $subMenuTableQuery = "CREATE TABLE IF NOT EXISTS `menu` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `title` VARCHAR(255) NOT NULL,
            `description` VARCHAR(255) NOT NULL,
            `sub_menu` INT(11) NOT NULL DEFAULT 1,
            `status` TINYINT(1) NOT NULL DEFAULT 1,
            PRIMARY KEY (`id`),
            FOREIGN KEY (`sub_menu`) REFERENCES `submenu`(`id`)
          )";

        try{
            $this->db->exec($menuTableQuery);
            $this->db->exec($subMenuTableQuery);
            return true;
        } catch(\PDOException $e){
            return false;
        }
    }
    public function getAllMenu(){

        try{
            $stmt = $this->db->query("SELECT menu.*, sub_menu.title FROM menu JOIN sub_menu ON menu.sub_menu = sub_menu.id;");
            $pages = [];
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $pages[] = $row;
            }
            return $pages;
        }catch(\PDOException $e){
            return false;
        }
    }

    public function getPageById($id){
        $query = "SELECT * FROM pages WHERE id = ?";

        try{
            $stmt =$this->db->prepare($query);
            $stmt->execute([$id]);
            $page = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $page ? $page : false;
        } catch(\PDOException $e){
            return false;
        }
    }

    public function findBySlug($slug){
        $query = "SELECT * FROM pages WHERE slug = ?";

        try{
            $stmt =$this->db->prepare($query);
            $stmt->execute([$slug]);
            $page = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $page ? $page : false;
        } catch(\PDOException $e){
            return false;
        }
    }

    public function createPage($title, $slug, $roles) {

        $query = "INSERT INTO pages (title, slug, role) VALUES (?, ?, ?)";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$title, $slug, $roles]);
            return true;
        } catch(\PDOException $e) {
            return false;
        }
    }


    public function updatePage($id, $title, $slug, $roles){
        $query = "UPDATE pages SET title = ?, slug = ?, role = ? WHERE id = ?";
        
        try{
            $stmt = $this->db->prepare($query);
            $stmt->execute([$title, $slug, $roles, $id]);
            
            return true;
        } catch(\PDOException $e){
            return false;
        }
    }

    public function deletePage($id){
        $query = "DELETE FROM pages WHERE id = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return true;
        } catch(\PDOException $e) {
            return false;
        }
    }

}
