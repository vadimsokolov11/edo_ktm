<?php

$title = 'Добавление роли';
ob_start(); 
?>

  <h1 class="mb-4"><?= $title ?></h1>
    <form method="POST" action="/<?= APP_BASE_PATH ?>/roles/store">
    <div class="mb-3">
        <label for="role_name" class="form-label">Название</label>
        <input type="text" class="form-control" id="role_name" name="role_name" required>
    </div>
    <div class="mb-3">
        <label for="role_description" class="form-label">Описание</label>
        <textarea class="form-control" id="role_description" name="role_description" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Добавить</button>
    </form>

<?php $content = ob_get_clean(); 

include 'app/views/layout/layout.php';
?>