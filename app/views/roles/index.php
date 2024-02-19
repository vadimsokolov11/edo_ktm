<?php

$title = 'Роли';
ob_start(); 
?>

  <h1 class="mb-4"><?= $title ?></h1>
  <a href="/<?= APP_BASE_PATH ?>/roles/create" class="btn btn-success">Добавить</a>
    <table class="table">
    <thead>
        <tr>
        <th>Название</th>
        <th>Описание</th>
        <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($roles as $role): ?>
        <tr>
        <td><?= $role['role_name'] ?></td>
        <td><?= $role['role_description'] ?></td>
        <td>
            <a href="/<?= APP_BASE_PATH ?>/roles/edit/<?= $role['id'] ?>" class="btn btn-sm btn-outline-primary">Редактировать</a>
            <form method="POST" action="/<?= APP_BASE_PATH ?>/roles/delete/<?= $role['id'] ?>" class="d-inline-block">
            <!-- <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button> -->
            </form>
        </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    </table>



<?php $content = ob_get_clean(); 

include 'app/views/layout/layout.php';
?>