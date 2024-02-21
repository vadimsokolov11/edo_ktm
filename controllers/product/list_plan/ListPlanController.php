<?php
namespace controllers\product\list_plan;


use models\Check;
use models\product\list_plan\ListPlanModel;

use models\users\User;
use models\roles\Role;

class ListPlanController
{

    private $check;

    public function __construct()
    {
        $userRole = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : null;
        $this->check = new Check($userRole);
    }

    // Вывод на index информации о том кто согласовал/утвердил, дата создания(выбранная в созданном плане)
    public function index()
    {
        $this->check->requirePermission();

        $sessionData = $_SESSION; // выводит данные из сессии (на данный момент username, user_role, user_id, user_email)

        $planModel = new ListPlanModel();
        $plan = $planModel->getAllPlan();
        // tte($plan);


        include 'app/views/product/list_plan/index.php';
    }

    // Выводит на страницу show отдельно информацию содержащуюся в массиве json из таблицы plan_month 
    // Выводит на страницу show отдельно всю остальную информацию без json массива из таблицы plan_month 
    public function show($params)
    {
        $this->check->requirePermission();

        $planModel = new ListPlanModel();
        $plan = $planModel->getPlanById($params['id']);

        $infoPlan = new ListPlanModel();
        $info = $infoPlan->getPlanInfoById($params['id']);



        if (!$info) {
            echo "Page not found";
            return;
        }

        // tte($plan);

        include 'app/views/product/list_plan/show.php';
    }

    // Выводит данные о пользовтелях из таблицы users и данные справочника по готовой продукции из таблицы spravka_product
    public function create()
    {
        $this->check->requirePermission();

        $userModel = new User();
        $users = $userModel->getUsersByRolename();

        $detailModel = new ListPlanModel();
        $details = $detailModel->getAllDetail();
        include 'app/views/product/list_plan/create.php';
    }

    // Передает введенные данные в модель ListPlanModel, а затем в базу в таблицу plan_month
    // Передает json массив и оставшиеся данные, не находящиеся в нем
    public function store()
    {
        $this->check->requirePermission();

        if (
            isset($_POST["total_plan_month_van"]) && isset($_POST["total_plan_month_delail"]) && isset($_POST["total_plan_month_tn"]) && isset($_POST["total_required_num_hours_ton"]) && isset($_POST["detail"]) && isset($_POST["plan_month_tn"]) && isset($_POST["plan_mont_van"]) && isset($_POST["plan_detail"])
            && isset($_POST["result_plan_tn"]) && isset($_POST["result_plan_van"]) && isset($_POST["required_num_hours_ton"])
        ) {

            $total_plan_month_van = trim($_POST["total_plan_month_van"]);
            $total_plan_month_delail = trim($_POST["total_plan_month_delail"]);
            $total_plan_month_tn = trim($_POST["total_plan_month_tn"]);
            $total_required_num_hours_ton = trim($_POST["total_required_num_hours_ton"]);

            $detail = $_POST["detail"];
            $plan_month_tn = $_POST["plan_month_tn"];
            $plan_mont_van = $_POST["plan_mont_van"];
            $plan_detail = $_POST["plan_detail"];
            $result_plan_tn = $_POST["result_plan_tn"];
            $result_plan_van = $_POST["result_plan_van"];
            $required_num_hours_ton = $_POST["required_num_hours_ton"];

            if (
                !empty($total_plan_month_van) && !empty($total_plan_month_delail) && !empty($total_plan_month_tn) && !empty($total_required_num_hours_ton) && !empty($detail) && !empty($plan_month_tn) && !empty($plan_mont_van) && !empty($plan_detail) &&
                !empty($result_plan_tn) && !empty($result_plan_van) && !empty($required_num_hours_ton)
            ) {


                $data_to_add = array();

                for ($i = 0; $i < count($detail); $i++) {
                    $current_detail = $detail[$i];
                    $current_plan_mont_van = $plan_mont_van[$i];
                    $current_plan_month_tn = $plan_month_tn[$i];

                    $current_plan_detail = $plan_detail[$i];
                    $current_result_plan_tn = $result_plan_tn[$i];
                    $current_result_plan_van = $result_plan_van[$i];

                    $current_required_num_hours_ton = $required_num_hours_ton[$i];

                    $data_to_add[$i] = array(
                        "detail" => $current_detail,
                        "plan_mont_van" => $current_plan_mont_van,
                        "plan_month_tn" => $current_plan_month_tn,
                        "plan_detail" => $current_plan_detail,
                        "result_plan_tn" => $current_result_plan_tn,
                        "result_plan_van" => $current_result_plan_van,
                        "required_num_hours_ton" => $current_required_num_hours_ton,
                    );
                }
                $plansModel = new ListPlanModel();
                $plansModel->createPlan($data_to_add, $total_plan_month_van, $total_plan_month_delail, $total_plan_month_tn, $total_required_num_hours_ton);

            }

            $path = '/' . APP_BASE_PATH . '/product/list_plan';
            header("Location: $path");
        }
    }


    // Передает в edit данные о месячном плане отдельно в json массиве и отдельно без него из таблицы plan_month
    public function edit($params)
    {
        $this->check->requirePermission();

        $userModel = new User();
        $users = $userModel->getUsersByRolename();

        $detailModel = new ListPlanModel();
        $details = $detailModel->getAllDetail();

        $infoPlan = new ListPlanModel();
        $info = $infoPlan->getPlanInfoWhollyById($params['id']);

        $planModel = new ListPlanModel();
        $plan = $planModel->getPlanById($params['id']);
        if (!$info) {
            echo "plan not found";
            return;
        }
        
        //var_dump($info);
    //  tte($plan);
        include 'app/views/product/list_plan/edit.php';
    }

    // Отправляет данные в модель ListPlanModel, а затем в базу в таблицу plan_month
    // Передает json массив и оставшиеся данные, не находящиеся в нем
    public function update($params)
    {
        $this->check->requirePermission();

        if (
            isset($params['id']) && isset($_POST["total_plan_month_van"]) && isset($_POST["total_plan_month_delail"]) && isset($_POST["total_plan_month_tn"]) && isset($_POST["total_required_num_hours_ton"]) && isset($_POST["detail"]) && isset($_POST["plan_month_tn"]) && isset($_POST["plan_mont_van"]) && isset($_POST["plan_detail"])
            && isset($_POST["result_plan_tn"]) && isset($_POST["result_plan_van"]) && isset($_POST["required_num_hours_ton"])
        ) {
            $id = trim($params['id']);
            $total_plan_month_van = trim($_POST["total_plan_month_van"]);
            $total_plan_month_delail = trim($_POST["total_plan_month_delail"]);
            $total_plan_month_tn = trim($_POST["total_plan_month_tn"]);
            $total_required_num_hours_ton = trim($_POST["total_required_num_hours_ton"]);

            $detail = $_POST["detail"];
            $plan_month_tn = $_POST["plan_month_tn"];
            $plan_mont_van = $_POST["plan_mont_van"];
            $plan_detail = $_POST["plan_detail"];
            $result_plan_tn = $_POST["result_plan_tn"];
            $result_plan_van = $_POST["result_plan_van"];
            $required_num_hours_ton = $_POST["required_num_hours_ton"];

            if (
                !empty($total_plan_month_van) && !empty($total_plan_month_delail) && !empty($total_plan_month_tn) && !empty($total_required_num_hours_ton) && !empty($detail) && !empty($plan_month_tn) && !empty($plan_mont_van) && !empty($plan_detail) &&
                !empty($result_plan_tn) && !empty($result_plan_van) && !empty($required_num_hours_ton)
            ) {


                $data_to_add = array();

                for ($i = 0; $i < count($detail); $i++) {
                    $current_detail = $detail[$i];
                    $current_plan_mont_van = $plan_mont_van[$i];
                    $current_plan_month_tn = $plan_month_tn[$i];

                    $current_plan_detail = $plan_detail[$i];
                    $current_result_plan_tn = $result_plan_tn[$i];
                    $current_result_plan_van = $result_plan_van[$i];

                    $current_required_num_hours_ton = $required_num_hours_ton[$i];

                    $data_to_add[$i] = array(
                        "detail" => $current_detail,
                        "plan_mont_van" => $current_plan_mont_van,
                        "plan_month_tn" => $current_plan_month_tn,
                        "plan_detail" => $current_plan_detail,
                        "result_plan_tn" => $current_result_plan_tn,
                        "result_plan_van" => $current_result_plan_van,
                        "required_num_hours_ton" => $current_required_num_hours_ton,
                    );
                }
                $plansModel = new ListPlanModel();
                $plansModel->updatePlan($id, $data_to_add, $total_plan_month_van, $total_plan_month_delail, $total_plan_month_tn, $total_required_num_hours_ton);

            }

            $path = '/' . APP_BASE_PATH . '/product/list_plan';
            header("Location: $path");
        }
    }
}
