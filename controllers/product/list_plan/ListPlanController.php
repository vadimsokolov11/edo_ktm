<?php
namespace controllers\product\list_plan;


use models\Check;
use models\product\list_plan\ListPlanModel;

use models\users\User;
use models\roles\Role;

class ListPlanController{

    private $check;

    public function __construct()
    {
        $userRole = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : null;
        $this->check = new Check($userRole);
    }

    public function index(){
        $this->check->requirePermission();

        $sessionData = $_SESSION; // выводит данные из сессии (на данный момент username, user_role, user_id, user_email)

        $plans = new ListPlanModel();
        $plan = $plans->getAllPlan();
 
        include 'app/views/product/list_plan/index.php';
    }

    public function show($params){
        $this->check->requirePermission();

        $planModel = new ListPlanModel();
        $plan = $planModel->getPlanById($params['id']);
        
        if(!$plan){
            echo "Page not found";
            return;
        }

        include 'app/views/product/list_plan/show.php';
    }

    public function create(){
        $this->check->requirePermission();

        $userModel = new User();
        $users = $userModel->getUsersByRolename();

        $roleModel = new Role();
        $roles = $roleModel->getAllRoles();

        $plansModel = new ListPlanModel();
        $plan = $plansModel->getAllList();

        $detailModel = new ListPlanModel();
        $details = $detailModel->getAllDetail();

    // tte( $plan);
        include 'app/views/product/list_plan/create.php';
    }

    public function store(){
        $this->check->requirePermission();

        if (isset($_POST["name"]) && isset($_POST["age"]) && isset($_POST["email"]) && isset($_POST["detail"])) {
            $name = $_POST["name"];
            $age = $_POST["age"];
            $email = $_POST["email"];
            $detail = $_POST["detail"];
            if (!empty($name) && !empty($age) && !empty($email) && !empty($detail)) {

                $data_to_add = array(
                    "detail" => $detail,
                    "name" => $name,
                    "age" => $age,
                    "email" => $email,
                    
                
                );
            $plansModel = new ListPlanModel();
            $plansModel->createPlan($data_to_add);

        }

        $path = '/'. APP_BASE_PATH . '/product/list_plan';
        header("Location: $path");
    }
}

    public function edit($params){
        $this->check->requirePermission();

        $planModel = new ListPlanModel();
        $plan = $planModel->getPageById($params['id']);
tte($plan);
        if(!$plan){
            echo "Page not found";
            return;
        }

        include 'app/views/product/list_plan/edit.php';
    }

    public function update($params){
        $this->check->requirePermission();

        if(isset($params['id']) && isset($_POST['title']) && isset($_POST['slug']) && isset($_POST['roles'])){
            $id = trim($params['id']);
            $title = trim($_POST['title']);
            $slug = trim($_POST['slug']);
            $roles = implode(",", $_POST['roles']);

            if (empty($title) || empty($slug) || empty($roles)) {
                echo "Title and Slug or Role fields are required!";
                return;
            }

            $pageModel = new PageModel();
            $pageModel->updatePage($id, $title, $slug, $roles);
        }
        $path = '/'. APP_BASE_PATH . '/product/list_plan';
        header("Location: $path");
    }

}