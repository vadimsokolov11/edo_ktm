<?php
namespace models\product\list_plan;

use models\Database;

class ListPlanModel{
    private $db;

    public function __construct(){
        $this->db = Database::getInstance()->getConnection();

        try{
            $result = $this->db->query("SELECT 1 FROM `plan_month` LIMIT 1");
        } catch(\PDOException $e){
            $this->createTable();
        }
    }

    // Создание таблицы если ее нет в БД
    public function createTable(){

        $planMothTableQuery = "CREATE TABLE IF NOT EXISTS `plan_month` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `date` DATA
            `agreed` INT(11),
            `ratify` INT(11),
            `plan_info` LONGTEXT,
            `status` TINYINT(1) NOT NULL DEFAULT 1,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            FOREIGN KEY (`agreed`) REFERENCES `users`(`id`),
            FOREIGN KEY (`ratify`) REFERENCES `users`(`id`)
        )";

        try{
            $this->db->exec($planMothTableQuery);
            return true;
        } catch(\PDOException $e){
            return false;
        }
    }

    // Метод для вывода плана производства продукции с датой, фио тем кто соглдасовал и утвердил
    public function getAllPlan(){
        try{
            $stmt = $this->db->query("SELECT plan_month.*, date, users_1.surname as agreed, users_2.surname as ratify 
            FROM plan_month 
            JOIN users AS users_1 ON plan_month.agreed = users_1.id 
            JOIN users AS users_2 ON plan_month.ratify = users_2.id 
            ORDER BY `plan_month`.`id` ASC;"); 

            $plan = [];
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $plan[] = $row;
            }
            return $plan;
        } catch(\PDOException $e){
            return false;
        }
    }

    // Метод для вывода всех данных из таблицы месячного плана
    public function getAllList(){
        try{
            $stmt = $this->db->query("SELECT * FROM `plan_month`; "); 

            $listPlan = [];
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $listPlan[] = $row;
            }
            return $listPlan;
        } catch(\PDOException $e){
            return false;
        }
    }

    // Метод для вывода всех данных о продукции
    public function getAllDetail(){
        try{
            $stmt = $this->db->query("SELECT * FROM `spravka_product`; "); 

            $listProduct = [];
            while($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
                $listProduct[] = $row;
            }
            return $listProduct;
        } catch(\PDOException $e){
            return false;
        }
    }


    // Метод для вывода данных из json массива и даты из таблицы месячного плана 
    public function getPlanById($id){
        $query = "SELECT plan_info, date FROM plan_month WHERE id = ?;";

        try{
            $stmt =$this->db->prepare($query);
            $stmt->execute([$id]);
            $plans = $stmt->fetch(\PDO::FETCH_ASSOC);

            $jsonData = $plans['plan_info'];
            $plan = json_decode($jsonData, true);

            return $plan ? $plan : false;
        } catch(\PDOException $e){
            return false;
        }
    }


    public function createPlan($data, $total_plan_month_van, $total_plan_month_delail, $total_plan_month_tn, $total_required_num_hours_ton) {
        $json_data = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
        $query = "INSERT INTO plan_month (plan_info, agreed, ratify, date, total_plan_month_van, total_plan_month_delail, total_plan_month_tn, total_required_num_hours_ton) 
        VALUES (:plan_info, :agreed, :ratify, :date, :total_plan_month_van, :total_plan_month_delail, :total_plan_month_tn, :total_required_num_hours_ton)";
    
        try {
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(":plan_info", $json_data);
            $stmt->bindParam(":agreed", $_POST["agreed"]);
            $stmt->bindParam(":ratify", $_POST["ratify"]);
            $stmt->bindParam(":date", $_POST["date"]);
            $stmt->bindParam(":total_plan_month_van", $_POST["total_plan_month_van"]);
            $stmt->bindParam(":total_plan_month_delail", $_POST["total_plan_month_delail"]);
            $stmt->bindParam(":total_plan_month_tn", $_POST["total_plan_month_tn"]);
            $stmt->bindParam(":total_required_num_hours_ton", $_POST["total_required_num_hours_ton"]);
            $stmt->execute();
    
            return $this->db->lastInsertId(); // Возвращаем ID только если запрос выполнен успешно
        } catch (\PDOException $e) {
            // Обработка ошибок, например, запись в журнал или вывод сообщения об ошибке
            error_log("Ошибка при создании плана: " . $e->getMessage());
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