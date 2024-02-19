<?php
namespace models\users;

use models\Database;

class User
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();

        try {
            $result = $this->db->query("SELECT 1 FROM `users` LIMIT 1");
        } catch (\PDOException $e) {
            $this->createTable();
        }
    }

    public function createTable()
    {
        $roleTableQuery = "CREATE TABLE IF NOT EXISTS `roles` (
            `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `role_name` VARCHAR(255) NOT NULL,
            `role_description` TEXT
        )";

        $userTableQuery = "CREATE TABLE IF NOT EXISTS `users` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(255) NOT NULL,
            `surname` VARCHAR(255) NOT NULL,
            `patronymic` VARCHAR(255) NOT NULL,
            `email` VARCHAR(255) NOT NULL,
            `email_verification` TINYINT(1) NOT NULL DEFAULT 0,
            `password` VARCHAR(255) NOT NULL,
            `is_admin` TINYINT(1) NOT NULL DEFAULT 0,
            `role` INT(11) NOT NULL DEFAULT 0,
            `is_active` TINYINT(1) NOT NULL DEFAULT 1,
            `last_login` TIMESTAMP NULL,
            `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            FOREIGN KEY (`role`) REFERENCES `roles`(`id`)
          )";

        try {
            $this->db->exec($roleTableQuery);
            $this->db->exec($userTableQuery);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    //выводит всех юзеров
    public function getAllUsers()
    {
        try {
            $stmt = $this->db->query("SELECT * FROM users");

            $users = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $users[] = $row;
            }
            return $users;
        } catch (\PDOException $e) {
            return false;
        }
    }

    // Выводит всех юзеров и их роли
    public function readAll()
    {
        try {
            $stmt = $this->db->query("SELECT users.*, roles.role_name 
            FROM users 
            JOIN roles ON users.role = roles.id"); //выводит всех юзеров и их роли

            $users = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $users[] = $row;
            }
            return $users;
        } catch (\PDOException $e) {
            return false;
        }
    }

    // Выодит юзеров только с определенной должностью
    public function getUsersByRolename()
    {
        try {
            $stmt = $this->db->query("SELECT users.*, roles.role_name 
            FROM users 
            JOIN roles ON users.role = roles.id 
            WHERE roles.role_name = 'Начальник' OR roles.role_name = 'Зам начальника';"); //выводит всех юзеров и их роли

            $users = [];
            while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                $users[] = $row;
            }
            return $users;
        } catch (\PDOException $e) {
            return false;
        }
    }

    // Добавляет юзеров
    public function create($data)
    {
        $surname = $data['surname'];
        $name = $data['name'];
        $patronymic = $data['patronymic'];
        $email = $data['email'];
        $password = $data['password'];
        $role = $data['role'];

        $created_at = date('Y-m-d H:i:s');

        $query = "INSERT INTO users (surname, name, patronymic, email, password, role, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$surname, $name, $patronymic, $email, password_hash($password, PASSWORD_DEFAULT), $role, $created_at]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    // Удаляет юзеров
    public function delete($id)
    {
        $query = "DELETE FROM users WHERE id = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    // Выводит юзеров по их id
    public function read($id)
    {
        $query = "SELECT * FROM users WHERE id = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$id]);
            $res = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $res;
        } catch (\PDOException $e) {
            return false;
        }
    }

    // Редактирует данные юзеров
    public function update($id, $data)
    {
        $surname = $data['surname'];
        $name = $data['name'];
        $patronymic = $data['patronymic'];
        $admin = !empty($data['admin']) && $data['admin'] !== 0 ? 1 : 0;
        $email = $data['email'];
        $role = $data['role'];
        $is_active = isset($data['is_active']) ? 1 : 0;

        $query = "UPDATE users SET surname = ?, name = ?, patronymic = ?, email = ?, is_admin = ?, role = ?, is_active = ? WHERE id = ?";

        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute([$surname, $name, $patronymic, $email, $admin, $role, $is_active, $id]);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }


}