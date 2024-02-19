<?php
namespace controllers\monitoring;


use models\users\User;
use models\Check;

class MonitoringController{

    private $check;

    public function __construct()
    {
        $userRole = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : null;
        $this->check = new Check($userRole);
    }

    public function index(){
        $this->check->requirePermission();

        // tte($_SESSION);
        $sessionData = $_SESSION; // выводит данные из сессии (на данный момент username, user_role, user_id, user_email)

        // tte($_SESSION); // отладчик (что выводит любая переменная)
        include 'app/views/monitoring/index.php';
    }

    

}