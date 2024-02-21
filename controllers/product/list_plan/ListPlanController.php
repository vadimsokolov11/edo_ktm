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
       // tte($plan);

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

        if (isset($_POST["total_plan_month_van"]) && isset($_POST["total_plan_month_delail"]) && isset($_POST["total_plan_month_tn"]) && isset($_POST["total_required_num_hours_ton"]) && isset($_POST["detail"]) && isset($_POST["plan_month_tn"]) && isset($_POST["plan_mont_van"]) && isset($_POST["plan_detail"]) 
        && isset($_POST["result_plan_tn"]) && isset($_POST["result_plan_van"]) && isset($_POST["required_num_hours_ton"])) {
            
            $total_plan_month_van = $_POST["total_plan_month_van"];
            $total_plan_month_delail = $_POST["total_plan_month_delail"];
            $total_plan_month_tn = $_POST["total_plan_month_tn"];
            $total_required_num_hours_ton = $_POST["total_required_num_hours_ton"];
            
            $detail = $_POST["detail"];
            $plan_month_tn = $_POST["plan_month_tn"];
            $plan_mont_van = $_POST["plan_mont_van"];
            $plan_detail = $_POST["plan_detail"];
            $result_plan_tn = $_POST["result_plan_tn"];
            $result_plan_van = $_POST["result_plan_van"];
            $required_num_hours_ton = $_POST["required_num_hours_ton"];
            
            if (!empty($total_plan_month_van) && !empty($total_plan_month_delail) && !empty($total_plan_month_tn) && !empty($total_required_num_hours_ton) && !empty($detail) && !empty($plan_month_tn) && !empty($plan_mont_van) && !empty($plan_detail) && 
            !empty($result_plan_tn) && !empty($result_plan_van) && !empty($required_num_hours_ton)) {

                $data_to_add = array(
                    "detail" => $detail,
                    "plan_mont_van" => $plan_mont_van,
                    "plan_month_tn" => $plan_month_tn,
                    "plan_detail" => $plan_detail,
                    "result_plan_tn" => $result_plan_tn,
                    "result_plan_van" => $result_plan_van,
                    "required_num_hours_ton" => $required_num_hours_ton,
                );
            $plansModel = new ListPlanModel();
            $plansModel->createPlan($data_to_add, $total_plan_month_van, $total_plan_month_delail, $total_plan_month_tn, $total_required_num_hours_ton);
         //  tte( $plansModel);

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