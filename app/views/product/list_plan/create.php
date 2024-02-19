<?php

$title = 'Добавление плана';
ob_start();
?>

<h1 class="mb-4">
    <?= $title ?>
</h1>

<form method="POST" action="/<?= APP_BASE_PATH ?>/product/list_plan/store" id="inputForm">
<button type="submit" class="btn btn-primary">Добавить</button>
    <div class="row">

        <!-- селект на выбор человека, который согласовал план -->
        <div class="col-md-2 mb-3">
            <label for="agreed" class="form-label">Согласовал</label>
            <select class="form-control" id="agreed" name="agreed">
                <?php foreach ($users as $user): ?>
                    <option value="<?php echo $user['id']; ?>">
                        <?php echo $user['surname']; ?>
                        <?php echo $user['name']; ?>
                        <?php echo $user['patronymic']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- селект на выбор человека, который утвердил план -->
        <div class="col-md-2 mb-3">
            <label for="ratify" class="form-label">Утвердил</label>
            <select class="form-control" id="ratify" name="ratify">
                <?php foreach ($users as $user): ?>
                    <option value="<?php echo $user['id']; ?>">
                        <?php echo $user['surname']; ?>
                        <?php echo $user['name']; ?>
                        <?php echo $user['patronymic']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- дата составления -->
        <div class="form-group col-md-2 mb-3">
            <label for="date">Дата</label>
            <input type="text" class="form-control" data-provide="datepicker" id="date" name="date">
        </div>
    </div>

    <!-- кнопка на генерацию полей -->
    <a type="button" class="btn btn-primary mb-2" onclick="addElements()">Добавить элемент</a>

    <!-- селект на выбор детали -->
    <div class="row col-md-4 mb-2">
        <select class="form-control mb-2 detail" id="detail" name="detail[]" onchange="updateWeight(this)">
            <?php foreach ($details as $detail): ?>
                <option value="<?php echo $detail['weight']; ?> <?php echo $detail['title']; ?>" data-weight="<?php echo $detail['weight']; ?>">
                    <?php echo $detail['title'] . ' ' . $detail['weight'] . ' кг'; ?>
                </option>
            <?php endforeach; ?>
        </select>


        <div class="mb-3">
            <label for="age" class="form-label">Вагонов за месяц:</label>
            <input type="text" class="form-control" id="age" name="age[]" required>
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">Вагонов за месяц:</label>
            <input type="text" class="form-control" id="name" name="name[]" required>
        </div>

        <div class="mb-3">
            <label for="age" class="form-label">Вагонов за месяц:</label>
            <input type="text" class="form-control" id="email" name="email[]" required>
        </div>
        <!-- <div class="mb-3">
        <label for="name" class="form-label">Название</label>
        <input type="text" class="form-control" id="name" name="name[]" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Название</label>
        <input type="text" class="form-control" id="email" name="email[]" required>
    </div> -->

        <!-- input на ввод месячного плана производства в тоннах -->
        <input type="text" class="plan_month_tn form-control mb-2" id="plan_month_tn" name="plan_month_tn"
            placeholder="Введите месячный план в тоннах" oninput="calculateAndDisplay(this)">

        <!-- вывод расчитаных данных -->
        <h4 class="plan_mont_van" id="name" name="name[]">Вагонов за месяц: </h4>
        <h4 class="plan_detail" id="age" name="age[]">Деталей за месяц: </h4>
        <h4 class="result_plan_tn" id="email" name="email[]">Итого тонн за месяц: </h4>
        <h4 class="result_plan_van">Итого вагонов за месяц: </h4>
    </div>

</form>


<script>
    function calculateAndDisplay(inputElement) {
        var parentDiv = inputElement.parentElement;
        var plan_month_tn = parseFloat(parentDiv.querySelector(".plan_month_tn").value); // ввод месячного плана в тоннах
        var weight = parseFloat(parentDiv.querySelector(".detail").value); // ввод массы детали

        var selectedRole = parentDiv.querySelector("#detail").value; // селект на детали 

        var plan_mont_van = plan_month_tn / 65; // расчет плана в вагонах
document.getElementById("age").value = plan_mont_van.toFixed(2);

        var plan_detail = plan_month_tn * 1000 / weight; // расчет количества деталей в штуках
        parentDiv.querySelector(".plan_detail").innerHTML = plan_detail.toFixed(2) + " деталей";

        var result_plan_tn = plan_month_tn; // расчет общего кол-ва тонн на месяц
        parentDiv.querySelector(".result_plan_tn").innerHTML = result_plan_tn.toFixed(2) + " тонн за месяц";

        var result_plan_van = plan_mont_van; // расчет общего кол-ва вагонов на месяц
        parentDiv.querySelector(".result_plan_van").innerHTML = result_plan_van.toFixed(2) + " вагонов за месяц";
    }

    function addElements() {

        // создание формы
        var form = document.getElementById("inputForm");
        var newDiv = document.createElement("div");
        newDiv.className = "row col-md-4 mb-2";


        // описываем input для ввода месячного плата в тоннах
        var newNum1 = document.createElement("input");
        newNum1.type = "text";
        newNum1.className = "plan_month_tn form-control mb-2";
        newNum1.id = "plan_month_tn";
        newNum1.name = "plan_month_tn";
        newNum1.placeholder = "Введите месячный план в тоннах";
        newNum1.oninput = function () { calculateAndDisplay(this); };

        // описываем input для вывода массы детали
        // var newNum2 = document.createElement("input");
        // newNum2.type = "text";
        // newNum2.className = "weight form-control mb-2";
        // newNum2.id = "weight";
        // newNum2.name = "weight";
        // newNum2.placeholder = "Масса детали";
        // newNum2.oninput = function () { calculateAndDisplay(this); };


        // описываем селект на выборку деталей с базы
        var newSelect = document.createElement("select");
        newSelect.className = "form-control mb-2 detail";
        newSelect.id = "detail";
        newSelect.name = "detail";
        newSelect.onchange = function () {
            updateWeight(this);
        };

        var details = <?php echo json_encode($details); ?>;
        details.forEach(function (detail) {
            var option = document.createElement("option");
            option.value = detail.weight;
            option.setAttribute("data-weight", detail.weight);

            var optionText = document.createTextNode(detail.title + ' ' + detail.weight + ' кг');
            option.appendChild(optionText);

            newSelect.appendChild(option);
        });



        // описываем элементы для вывода данных
        var plan_mont_van = document.createElement("h4");
        plan_mont_van.className = "plan_mont_van";
        plan_mont_van.innerHTML = "Вагонов за месяц: ";
        plan_mont_van.id = "age[]";
        plan_mont_van.name = "age[]"

        // описываем элементы для вывода данных
        var plan_detail = document.createElement("h4");
        plan_detail.className = "plan_detail";
        plan_detail.innerHTML = "Деталей за месяц: ";
        plan_detail.id = "age[]";
        plan_detail.name = "age[]"

        // описываем элементы для вывода данных
        var result_plan_tn = document.createElement("h4");
        result_plan_tn.className = "result_plan_tn";
        result_plan_tn.innerHTML = "Итого тонн за месяц: ";
        result_plan_tn.id = "age[]";
        result_plan_tn.name = "age[]"

        // описываем элементы для вывода данных
        var result_plan_van = document.createElement("h4");
        result_plan_van.className = "result_plan_van";
        result_plan_van.innerHTML = "Итого вагонов за месяц: ";
        result_plan_van.id = "age[]";
        result_plan_van.name = "age[]"


        // создаем все описаные элементы
        newDiv.appendChild(newSelect);
        // newDiv.appendChild(newNum2);
        newDiv.appendChild(newNum1);
        newDiv.appendChild(plan_mont_van);
        newDiv.appendChild(plan_detail);
        newDiv.appendChild(result_plan_tn);
        newDiv.appendChild(result_plan_van);

        form.appendChild(newDiv);
    }

    // функция для передачи атрибута weight из селекта
    // function updateWeight(select) {
    //     var weightInput = document.getElementById("weight");
    //     var selectedOption = select.options[select.selectedIndex];
    //     var weight = selectedOption.getAttribute("data-weight");
    //     weightInput.value = weight;
    // }
</script>

<?php $content = ob_get_clean();

include 'app/views/layout/layout.php';
?>