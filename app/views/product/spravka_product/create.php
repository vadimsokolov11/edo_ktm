<?php

$title = 'Добавление продукции';
ob_start(); 
?>

  <h1 class="mb-4"><?= $title ?></h1>
    <form method="POST" action="/<?= APP_BASE_PATH ?>/product/spravka_product/store">
    <div class="mb-3">
        <label for="title" class="form-label">Наименование продукции</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="mb-3">
        <label for="norm_of_hours" class="form-label">Норма часов</label>
        <input type="text" class="form-control" id="norm_of_hours" name="norm_of_hours">
    </div>
    <div class="mb-3">
        <label for="weight" class="form-label">Вес 1 шт.</label>
        <input type="text" class="form-control" id="weight" name="weight" required>
    </div>
    <button type="submit" class="btn btn-primary">Добавить</button>
    </form>

<?php $content = ob_get_clean(); 

include 'app/views/layout/layout.php';
?>