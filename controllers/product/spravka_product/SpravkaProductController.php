<?php

namespace controllers\product\spravka_product;

use models\product\spravka_product\SpravkaProductModel;
use models\Check;

class SpravkaProductController{

    private $check;

    public function __construct()
    {
        $userRole = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : null;
        $this->check = new Check($userRole);
    }

    public function index(){
        $this->check->requirePermission();

        $spravkaModel = new SpravkaProductModel();
        $spravkaProduct = $spravkaModel->getAllSpravkaProduct();

        include 'app/views/product/spravka_product/index.php';
    }

    public function create(){
        $this->check->requirePermission();

        include 'app/views/product/spravka_product/create.php';
    }

    public function store(){
        $this->check->requirePermission();
        if(isset($_POST['title']) && isset($_POST['norm_of_hours']) && isset($_POST['weight'])){
            $title = trim($_POST['title']);
            $norm_of_hours = trim($_POST['norm_of_hours']);
            $weight = trim($_POST['weight']);

            if (empty($title)) {
                echo "Role name is required!";
                return;
            }

            $spravkaModel = new SpravkaProductModel();
            $spravkaModel->createSpravkaProduct($title, $norm_of_hours, $weight);
        }
        $path = '/'. APP_BASE_PATH . '/product/spravka_product';
        header("Location: $path");
    }

    public function edit($params){
        $this->check->requirePermission();
        $spravkaModel = new SpravkaProductModel();
        $spravkaProduct = $spravkaModel->getSpravkaProductById($params['id']);

        if(!$spravkaProduct){
            echo "Role not found";
            return;
        }

        include 'app/views/product/spravka_product/edit.php';
    }


    public function update($params){
        $this->check->requirePermission();

        if(isset($params['id']) && isset($_POST['title']) && isset($_POST['norm_of_hours']) && isset($_POST['weight'])){
            $id = trim($params['id']);
            $title = trim($_POST['title']);
            $norm_of_hours = trim($_POST['norm_of_hours']);
            $weight = trim($_POST['weight']);

            if (empty($title)) {
                echo "Требуется название продукта";
                return;
            }

            $spravkaModel = new SpravkaProductModel();
            $spravkaModel->updateSpravkaProduct($id, $title, $norm_of_hours, $weight);
        }
        $path = '/'. APP_BASE_PATH . '/product/spravka_product';
        header("Location: $path");
    }

    public function delete($params){
        $this->check->requirePermission();
        $spravkaModel = new SpravkaProductModel();
        $spravkaModel->deleteSpravkaProduct($params['id']);

        $path = '/'. APP_BASE_PATH . '/product/spravka_product';
        header("Location: $path");
    }

}