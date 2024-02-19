<?php

$title = 'Главная';
ob_start(); 
?>

<h1><?=$title ?></h1>

<h3>Добро пожаловать, <?php echo $sessionData['name'] . ' ' . $sessionData['patronymic']; ?>!</h3>
<?php $content = ob_get_clean(); 

include 'app/views/layout/layout.php';
?>