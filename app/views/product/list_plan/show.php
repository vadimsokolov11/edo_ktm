<?php

$title = '';
ob_start();
?>

<h1 class="mb-4">
    <?= $title ?>
</h1>
<div class="table-responsive">
    <table class="table mb-0">
        <thead style="background-color: #c2fbff;">
            <tr>
                <th>Дата</th>
                <th>Согласовал</th>
                <th>Утвердил</th>
                <th></th>
                
            </tr>
        </thead>
        <tbody style="background-color: #c2fbff;">
            <tr>
                <td><?= $info['date'] ?></td>
                <td><?= $info['name_agreed'] ?> <?= $info['patronymi_agreedc'] ?> <?= $info['surname_agreed'] ?></td>
                <td><?= $info['name_ratify'] ?> <?= $info['patronymic_ratify'] ?> <?= $info['surname_ratify'] ?></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <table class="table mb-0">
        <thead class="thead-light">
            <tr>
                <th>Производство готовой продукции</th>
                <th>Ед. изм.</th>
                <th>Кол-во</th>
                <th>Показатели по цеху (шт.)</th>
                <th>Итого план по цеху</th>
                <th>Норма ч/ч на тонну</th>
                <th>Требуемое кол-во ч/ч на тонну</th>
                <th>Сумма ч/ч сдельщиков на месяц (с учетом отпусков)</th>
            </tr>
        </thead>
        <?php foreach ($plan as $item): ?>
            <tbody style="background-color: bisque;">
                <tr style="background-color: #fff6eb;">
                    <td>
                        <?= $item['title'] ?>
                    </td>
                    <td>кг</td>
                    <td>
                        <?= $item['weight'] ?>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>План на месяц</td>
                    <td>тн</td>
                    <td>
                        <?= $item['plan_month_tn'] ?>
                    </td>
                    <td>
                        <?= $item['plan_detail'] ?>
                    </td>
                    <td>
                        <?= $item['result_plan_tn'] ?>
                    </td>
                    <td>
                        <?= $item['norm_of_hours'] ?>
                    </td>
                    <td>
                        <?= $item['required_num_hours_ton'] ?>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td>Количество вагонов </td>
                    <td>ваг</td>
                    <td>
                        <?= $item['plan_mont_van'] ?>
                    </td>
                    <td></td>
                    <td>
                        <?= $item['result_plan_van'] ?>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        <?php endforeach; ?>
        <tbody style="background-color: #c2fbff;">
            <tr>
                <td>
                    Итого
                </td>
                <td>шт/тн</td>
                <td></td>
                <td><?= $info['total_plan_month_delail'] ?></td>
                <td><?= $info['total_plan_month_tn'] ?></td>
                <td></td>
                <td><?= $info['total_required_num_hours_ton'] ?></td>
                <td>Итого сумма ч/ч сдельщиков на месяц (с учетом отпусков)</td>
            </tr>
            <tr>
                <td></td>
                <td>ваг</td>
                <td></td>
                <td></td>
                <td><?= $info['total_plan_month_van'] ?></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>


</div>

<?php $content = ob_get_clean();
include 'app/views/layout/layout.php';
?>