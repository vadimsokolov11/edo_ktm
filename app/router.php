<?php
namespace app;

use controllers\home\HomeController;
use controllers\users\UsersController;
use controllers\roles\RoleController;
use controllers\pages\PageController;
use controllers\auth\AuthController;
use controllers\main\MainController;
use controllers\monitoring\MonitoringController;
use controllers\product\ProductController;
use controllers\product\list_plan\ListPlanController;
use controllers\product\spravka_product\SpravkaProductController;

class Router {

    private $routes = [
        // Стартовая страница
        '/^\/' . APP_BASE_PATH . '\/?$/' => ['controller' => 'home\\HomeController', 'action' => 'index'], 


        // Меню
        '/^\/' . APP_BASE_PATH . '\/users(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'users\\UsersController'], // Пользователи
        '/^\/' . APP_BASE_PATH . '\/roles(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'roles\\RoleController'], // Роли
        '/^\/' . APP_BASE_PATH . '\/pages(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'pages\\PageController'], // Страницы
        '/^\/' . APP_BASE_PATH . '\/main(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'main\\MainController'], // Главная
        '/^\/' . APP_BASE_PATH . '\/monitoring(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'monitoring\\MonitoringController'], // Мониторинг

        // Продукция
        '/^\/' . APP_BASE_PATH . '\/product(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'product\\ProductController'], 
        '/^\/' . APP_BASE_PATH . '\/product\/list_plan(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'product\list_plan\\ListPlanController'], // Список планов производства готовой продукции на месяц
        '/^\/' . APP_BASE_PATH . '\/product\/spravka_product(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'product\spravka_product\\SpravkaProductController'], // План производства готовой продукции на месяц
        

        
        // авторизация
        '/^\/' . APP_BASE_PATH . '\/auth(\/(?P<action>[a-z]+)(\/(?P<id>\d+))?)?$/' => ['controller' => 'auth\\AuthController'],
        '/^\/' . APP_BASE_PATH . '\/(register|login|authenticate|logout)(\/(?P<action>[a-z]+))?$/' => ['controller' => 'users\\AuthController']
    ];

    public function run() {
        $uri = $_SERVER['REQUEST_URI'];
        $controller = null;
        $action = null;
        $params = null;

        foreach ($this->routes as $pattern => $route) {
            if (preg_match($pattern, $uri, $matches)) {
                $controller = "controllers\\" . $route['controller'];
                $action = $route['action'] ?? $matches['action'] ?? 'index';
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);
                break;
            }
        }

        if (!$controller) {
            http_response_code(404);
            include_once 'app/views/errors/404.html';
            return;
        }

        $controllerInstance = new $controller();
        if (!method_exists($controllerInstance, $action)) {
            http_response_code(404);
            echo "Action not found!";
            return;
        }
        call_user_func_array([$controllerInstance, $action], [$params]);
    }
}
