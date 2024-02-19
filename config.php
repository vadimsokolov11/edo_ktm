<?php

function tt($str){
    echo "<pre>";
        print_r($str);
    echo "</pre>";
}
function tte($str){
    echo "<pre>";
        print_r($str);
    echo "</pre>";
    exit();
}
// config.php

define('APP_BASE_PATH', 'edo_kuzbasstransmet');

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'kuzbasstransmet');

define('START_ROLE', 1);

