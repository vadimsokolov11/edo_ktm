<?php

$title = 'Редактировать страницу';
ob_start();
?>

<h1 class="mb-4">
    <?= $title ?>
</h1>
<div class="table-responsive">
    <?php foreach ($plan as $item): ?>
        <table class="table mb-0">
            <thead class="thead-light">
                <tr>
                    <th>Производство готовой продукции</th>
                    <th>Ед. изм.</th>
                    <th>Кол-во</th>
                    <th>Показатели по цеху (шт.)</th>
                    <th>Итого план по цеху</th>
                </tr>
            </thead>
            <tbody style="background-color: bisque;">
                <tr>
                    <td><?= $item['name'] ?></td>
                    <td>кг</td>
                    <td><?= $item['surname'] ?></td>
                    <td>-</td>
                    <td>-</td>
                </tr>

                <tr>
                    <td>План на месяц</td>
                    <td>тн</td>
                    <td><?= $item['patronymic'] ?></td>
                    <td><?= $item['birthyear'] ?></td>
                    <td>720,0</td>
                </tr>
                <tr>
                    <td>количество вагонов </td>
                    <td>ваг</td>
                    <td>11,1</td>
                    <td>-</td>
                    <td>11,1</td>
                </tr>
            </tbody>
        </table>
    <?php endforeach; ?>
</div>

<?php $content = ob_get_clean();
include 'app/views/layout/layout.php';
?>