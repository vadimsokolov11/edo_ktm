<?php
namespace models\product\list_plan;

use models\Database;

class ListPlanModel
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        try {
            $result = $this->db->query("SELECT 1 FROM `plan_month` LIMIT 1");
        } catch (\PDOException $e) {
            $this->createTable();
        }
    }

    // Создание таблицы если ее нет в БД
    public function createTable()
    {

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

        try {
            $this->db->exec($planMothTableQuery);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    // Метод для вывода плана производства продукции с датой, фио тем кто соглдасовал и утвердил
    public function getAllPlan()
    {
        try {
            $stmt = $this->db->query("SELECT plan_month.*, date, users_1.surname as agreed, users_2.surname as ratify 
            FROM plan_month 
            JOIN users AS users_1 ON plan_month.agreed = users_1.id 
            JOIN users AS users_2 ON plan_month.ratify = users_2.id 
            ORDER BY `plan_month`.`id` ASC;");

            $plan = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $plan[] = $row;
            }
            return $plan;
        } catch (\PDOException $e) {
            return false;
        }
    }

    // Метод для вывода всех данных из таблицы месячного плана
    public function getAllList()
    {
        try {
            $stmt = $this->db->query("SELECT * FROM `plan_month`; ");

            $listPlan = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $listPlan[] = $row;
            }
            return $listPlan;
        } catch (\PDOException $e) {
            return false;
        }
    }

    // Метод для вывода всех данных о продукции
    public function getAllDetail()
    {
        try {
            $stmt = $this->db->query("SELECT * FROM `spravka_product`; ");

            $listProduct = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $listProduct[] = $row;
            }
            return $listProduct;
        } catch (\PDOException $e) {
            return false;
        }
    }

    // Метод на вывод всей информации месячного плана, кроме json массива
    public function getPlanInfoById($id)
    {
        $query = "SELECT plan_month.id, date, users_1.surname as surname_agreed, 
        CONCAT(LEFT(users_1.name, 1), '.') as name_agreed, 
        CONCAT(LEFT(users_1.patronymic, 1), '.') as patronymi_agreedc, 
        users_2.surname as surname_ratify, 
        CONCAT(LEFT(users_2.name, 1), '.') as name_ratify, 
        CONCAT(LEFT(users_2.patronymic, 1), '.') as patronymic_ratify, 
        total_plan_month_van, total_plan_month_delail, total_plan_month_tn, total_required_num_hours_ton 
        FROM plan_month 
        JOIN users AS users_1 ON plan_month.agreed = users_1.id 
        JOIN users AS users_2 ON plan_month.ratify = users_2.id 
        WHERE plan_month.id = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $info = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $info ? $info : false;
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function getPlanInfoWhollyById($id)
    {
        $query = "SELECT * FROM `plan_month` WHERE id = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $infoWholly = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $infoWholly ? $infoWholly : false;
        } catch (\PDOException $e) {
            return false;
        }
    }
    // Метод для вывода данных из json массива и даты из таблицы месячного плана по id 
    public function getPlanById($id)
    {
        $query = "SELECT id, plan_info, date, agreed, ratify, total_plan_month_van, total_plan_month_delail, total_plan_month_tn, total_required_num_hours_ton FROM plan_month WHERE id = ?;";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $plans = $stmt->fetch(\PDO::FETCH_ASSOC);

            $jsonData = $plans['plan_info'];
            $plan = json_decode($jsonData, true);

            // Разделяет содержимое ключа detail на части по пробелам
            // $modifiedPlan = [];
            foreach ($plan as $item) {
                $detail = isset($item['detail']) ? $item['detail'] : '';
                if ($detail !== '') {
                    $splitDetail = explode(' ', $detail);
                    $weight = $splitDetail[0] ?? '';
                    $norm_of_hours = $splitDetail[1] ?? '';
                    $title = implode(' ', array_slice($splitDetail, 2)); // Извлечение содержимого после второго пробела
                }
                $plan_month_tn = isset($item['plan_month_tn']) ? $item['plan_month_tn'] : '';
                $plan_mont_van = isset($item['plan_mont_van']) ? $item['plan_mont_van'] : '';
                $plan_detail = isset($item['plan_detail']) ? $item['plan_detail'] : '';
                $result_plan_tn = isset($item['result_plan_tn']) ? $item['result_plan_tn'] : '';
                $result_plan_van = isset($item['result_plan_van']) ? $item['result_plan_van'] : '';
                $required_num_hours_ton = isset($item['required_num_hours_ton']) ? $item['required_num_hours_ton'] : '';
                $modifiedPlan[] = [
                    // Данные из ключа detail
                    'weight' => $weight,
                    'norm_of_hours' => $norm_of_hours,
                    'title' => $title,

                    // Остальны данные из других ключей
                    'plan_month_tn' => $plan_month_tn,
                    'plan_mont_van' => $plan_mont_van,
                    'plan_detail' => $plan_detail,
                    'result_plan_tn' => $result_plan_tn,
                    'result_plan_van' => $result_plan_van,
                    'required_num_hours_ton' => $required_num_hours_ton,
                ];
            }


            return $modifiedPlan ? $modifiedPlan : false;
        } catch (\PDOException $e) {
            return false;
        }
    }

    // Метод на создание записи в таблице месячного плана по id 
    public function createPlan($data_to_add, $total_plan_month_van, $total_plan_month_delail, $total_plan_month_tn, $total_required_num_hours_ton)
    {
        $json_data = json_encode($data_to_add, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
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
           // tte($json_data);
            return $this->db->lastInsertId(); // Возвращаем ID только если запрос выполнен успешно
        } catch (\PDOException $e) {
            // Обработка ошибок, например, запись в журнал или вывод сообщения об ошибке
            error_log("Ошибка при создании плана: " . $e->getMessage());
            return false;

        }

    }



    public function updatePlan($id, $data_to_add, $total_plan_month_van, $total_plan_month_delail, $total_plan_month_tn, $total_required_num_hours_ton)
    {
        $json_data = json_encode($data_to_add, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
        $query = "UPDATE plan_month SET plan_info = :plan_info, agreed = :agreed, ratify = :ratify, date = :date, total_plan_month_van = :total_plan_month_van, total_plan_month_delail = :total_plan_month_delail, total_plan_month_tn = :total_plan_month_tn, total_required_num_hours_ton = :total_required_num_hours_ton WHERE id = :id";

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
            $stmt->bindParam(":id", $id);
            $stmt->execute();

           // tte($json_data);
            return true; // Возвращаем true, если запрос выполнен успешно
        } catch (\PDOException $e) {
            // Обработка ошибок, например, запись в журнал или вывод сообщения об ошибке
            error_log("Ошибка при обновлении плана: " . $e->getMessage());
            return false;
        }
    }

    public function deletePage($id)
    {
        $query = "DELETE FROM pages WHERE id = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }


}