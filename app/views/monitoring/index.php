<?php

$title = 'Мониторинг';
ob_start(); 
?>

<h1><?=$title ?></h1>
<?php $content = ob_get_clean(); 

include 'app/views/layout/layout.php';
?>