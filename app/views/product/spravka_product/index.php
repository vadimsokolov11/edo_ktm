<?php

$title = 'Информация о продукции';
ob_start(); 
?>

  <h1 class="mb-4"><?= $title ?></h1>
  <a href="/<?= APP_BASE_PATH ?>/product/spravka_product/create" class="btn btn-success">Добавить</a>
    <table class="table">
    <thead>
        <tr>
        <th>Наименование продукции</th>
        <th>Норма часов</th>
        <th>Вес 1 шт.</th>
        <th>Действия</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($spravkaProduct as $spravka): ?>
        <tr>
        <td><?= $spravka['title'] ?></td>
        <td><?= $spravka['norm_of_hours'] ?></td>
        <td><?= $spravka['weight'] ?></td>
        <td>
            <a href="/<?= APP_BASE_PATH ?>/product/spravka_product/edit/<?= $spravka['id'] ?>" class="btn btn-sm btn-outline-primary">Редактировать</a>
            <form method="POST" action="/<?= APP_BASE_PATH ?>/product/spravka_product/delete/<?= $spravka['id'] ?>" class="d-inline-block">
            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Вы действительно хотите удалить элемент?')">Удалить</button>
            </form>
        </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    </table>



<?php $content = ob_get_clean(); 

include 'app/views/layout/layout.php';
?>