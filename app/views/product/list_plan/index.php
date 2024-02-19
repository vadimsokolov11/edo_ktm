<?php

$title = 'План производства готовой продукции на месяц';
ob_start(); 
?>

  <h1 class="mb-4"><?= $title ?></h1>
  <a href="/<?= APP_BASE_PATH ?>/product/list_plan/create" class="btn btn-success">Добавить</a>
    <table class="table">
    <thead>
        <tr>
        <th>Дата</th>
        <th>Согласовал</th>
        <th>Утвердил</th>
        <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($plan as $item): ?>
        <tr>
        <td><?= $item['date'] ?></td>
        <td><?= $item['agreed'] ?></td>
        <td><?= $item['ratify'] ?></td>
        <td>
            <a href="/<?= APP_BASE_PATH ?>/product/list_plan/edit/<?= $item['id'] ?>" class="btn btn-sm btn-outline-primary">Редактировать</a>
            <a href="/<?= APP_BASE_PATH ?>/product/list_plan/show/<?= $item['id'] ?>" class="btn btn-sm btn-outline-primary">Открыть</a>
            </form>
        </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    </table>



<?php $content = ob_get_clean(); 

include 'app/views/layout/layout.php';
?>