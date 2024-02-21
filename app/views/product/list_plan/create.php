<?php

$title = 'Добавление плана';
ob_start();
?>

<h1 class="mb-4">
    <?= $title ?>
</h1>

<style>
    .plan_month_tn,
    .plan_mont_van,
    .plan_detail,
    .result_plan_tn,
    .result_plan_van,
    .required_num_hours_ton,
    .total_plan_detail,
    .total_plan_tn,
    .total_plan_van {
        width: 180px;
        height: 35px;
    }

    .detail {
        width: 367px;
        height: 35px;
    }
</style>
<form method="POST" action="/<?= APP_BASE_PATH ?>/product/list_plan/store" id="inputForm">
    <button type="submit" class="btn btn-primary" onclick="return confirm('Сохранить созданый план?')">Сохранить
        план</button>
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
            <input type="text" class="form-control" data-provide="datepicker" id="date" name="date" required>
        </div>
    </div>
    <div class="row">
        <div class=" form-group col-md-2 mb-3">
            <label for="total_plan_month_van" class="form-label">Всего вагонов за месяц</label>
            <input type="text" class="form-control total_plan_month_van mb-2 mr-2" id="total_plan_month_van"
                name="total_plan_month_van" placeholder="Всего по плану вагонов" readonly>
        </div>
        <div class=" form-group col-md-2 mb-3">
            <label for="total_plan_month_delail" class="form-label">Всего деталей за месяц (шт.)</label>
            <input type="text" class="form-control total_plan_month_delail mb-2 mr-2" id="total_plan_month_delail"
                name="total_plan_month_delail" placeholder="Всего деталей за месяц (шт.)" readonly>
        </div>
        <div class=" form-group col-md-2 mb-3">
            <label for="total_plan_month_tn" class="form-label">Всего тонн за месяц</label>
            <input type="text" class="form-control total_plan_month_tn mb-2 mr-2" id="total_plan_month_tn"
                name="total_plan_month_tn" placeholder="Всего тонн за месяц" readonly>
        </div>
    </div>

    <div class="row">
        <div class=" form-group col-md-2 mb-3">
            <label for="total_required_num_hours_ton" class="form-label">Требуемое кол-во ч/ч на тонну на месяц</label>
            <input type="text" class="form-control total_required_num_hours_ton mb-2 mr-2"
                id="total_required_num_hours_ton" name="total_required_num_hours_ton"
                placeholder="Требуемое кол-во ч/ч на тонну на месяц" readonly>
        </div>
    </div>

    <!-- кнопка на генерацию полей -->
    <div id="container"><a type="button" class="btn btn-primary mb-2" style="color: white;"
            onclick="addElements()">Добавить элемент</a></div>


    <!-- селект на выбор детали -->
    <div class="row col-md-4 mb-2">
        <select class="form-control mb-2 detail" id="detail" name="detail[]" onchange="updateWeight(this)">
            <?php foreach ($details as $detail): ?>
                <option
                    value="<?php echo $detail['weight']; ?> <?php echo $detail['norm_of_hours']; ?> <?php echo $detail['title']; ?>">
                    <?php echo $detail['title'] . ' ' . $detail['weight'] . ' кг'; ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- input на ввод месячного плана производства в тоннах -->
        <input type="text" class="plan_month_tn form-control mb-2 mr-2" id="plan_month_tn" name="plan_month_tn[]"
            placeholder="Введите месячный план в тоннах" oninput="calculateAndDisplay(this)" required>

        <input type="text" class="form-control plan_mont_van mb-2 mr-2" id="plan_mont_van" name="plan_mont_van[]"
            placeholder="Вагонов за месяц" readonly>
        <input type="text" class="form-control plan_detail mb-2 mr-2" id="plan_detail" name="plan_detail[]"
            placeholder="Деталей за месяц" readonly>
        <input type="text" class="form-control result_plan_tn mb-2 mr-2" id="result_plan_tn" name="result_plan_tn[]"
            placeholder="Итого тонн за месяц" readonly>
        <input type="text" class="form-control result_plan_van mb-2 mr-2" id="result_plan_van" name="result_plan_van[]"
            placeholder="Итого вагонов за месяц" readonly>

        <input type="text" class="form-control required_num_hours_ton mb-2 mr-2" id="required_num_hours_ton"
            name="required_num_hours_ton[]" placeholder="Кол-во ч/ч на тонну" readonly>
    </div>
</form>


<script>

    // Прокрутка кнопки при создании элементов
    window.addEventListener("scroll", function () {
        var button = document.querySelector(".btn.btn-primary.mb-2");
        var container = document.getElementById("container");

        if (button && container) {
            var containerHeight = container.offsetHeight;
            var containerTop = container.getBoundingClientRect().top;

            if (containerTop < 0) {
                button.style.position = "fixed";
                button.style.bottom = "30px";
                button.style.left = "275px";
            } else {
                button.style.position = "static";
                button.style.bottom = "0";
                button.style.left = "0";
            }
        }
    });

    function calculateAndDisplay(inputElement) {
        calculateTotalVanMonth();
        calculateTotalTnMonth();
        calculateTotalDetailMonth();
        calculateTotalNumHoursMonth();
        var parentDiv = inputElement.parentElement;
        var plan_month_tn = parseFloat(parentDiv.querySelector(".plan_month_tn").value); // ввод месячного плана в тоннах
        var weight = parseFloat(parentDiv.querySelector(".detail").value); // ввод массы детали
        var normOfHours = parseFloat(document.querySelector(".detail").value.split(" ")[1]);

        var selectedRole = parentDiv.querySelector(".detail").value; // селект на детали 

        var plan_mont_van = plan_month_tn / 65; // расчет плана в вагонах
        if (isNaN(plan_mont_van)) {
            plan_mont_van = 0;
        }
        parentDiv.querySelector(".plan_mont_van").value = plan_mont_van.toFixed(2);

        var plan_detail = plan_month_tn * 1000 / weight; // расчет количества деталей в штуках
        if (isNaN(plan_detail)) {
            plan_detail = 0;
        }
        parentDiv.querySelector(".plan_detail").value = plan_detail.toFixed(2);

        var result_plan_tn = plan_month_tn; // расчет общего кол-ва тонн на месяц
        if (isNaN(result_plan_tn)) {
            result_plan_tn = 0;
        }
        parentDiv.querySelector(".result_plan_tn").value = result_plan_tn.toFixed(2);

        var result_plan_van = plan_mont_van; // расчет общего кол-ва вагонов на месяц
        if (isNaN(result_plan_van)) {
            result_plan_van = 0;
        }
        parentDiv.querySelector(".result_plan_van").value = result_plan_van.toFixed(2);

        var required_num_hours_ton = normOfHours * plan_month_tn; // расчет общего кол-ва вагонов на месяц
        if (isNaN(required_num_hours_ton)) {
            required_num_hours_ton = 0;
        }
        parentDiv.querySelector(".required_num_hours_ton").value = required_num_hours_ton.toFixed(2);

    }

    function addElements() {

        // Кнопка удаления
        var deleteButton = document.createElement("button");
        deleteButton.textContent = "Удалить";
        deleteButton.className = "delete-button btn btn-danger mb-2";
        deleteButton.onclick = function () {
            // Перечисляем элементы которые нужно удалить
            newDiv.remove();
            newNum1.remove();
            plan_mont_van.remove();
            plan_detail.remove();
            result_plan_tn.remove();
            result_plan_van.remove();
            result_plan_van.remove();
            required_num_hours_ton.remove();
            newSelect.remove();
            deleteButton.remove();

            // Проверяем, остались ли еще элементы для расчета
            var remainingInputs = document.querySelectorAll(".newDiv", ".newNum1", ".plan_detail", ".plan_mont_van", ".result_plan_tn", ".result_plan_van", ".required_num_hours_ton", ".newSelect");
            if (remainingInputs.length === 0) {
                // Скрываем кнопку после удаления всех элементов
                addButton.style.display = "none";
            }
        };

        // создание формы
        var form = document.getElementById("inputForm");
        var newDiv = document.createElement("div");
        newDiv.className = "row col-md-4 mb-2";


        // описываем input для ввода месячного плата в тоннах
        var newNum1 = document.createElement("input");
        newNum1.type = "text";
        newNum1.className = "plan_month_tn form-control mb-2 mr-2";
        newNum1.id = "plan_month_tn";
        newNum1.name = "plan_month_tn[]";
        newNum1.placeholder = "Введите месячный план в тоннах";
        newNum1.oninput = function () { calculateAndDisplay(this); };
        newNum1.required = true;

        // описываем input для Вагонов за месяц
        var plan_mont_van = document.createElement("input");
        plan_mont_van.type = "text";
        plan_mont_van.className = "plan_mont_van form-control mb-2 mr-2";
        plan_mont_van.id = "plan_mont_van";
        plan_mont_van.name = "plan_mont_van[]";
        plan_mont_van.placeholder = "Вагонов за месяц";
        plan_mont_van.oninput = function () { calculateAndDisplay(this); };
        plan_mont_van.readOnly = true;

        // описываем input для Количество деталей
        var plan_detail = document.createElement("input");
        plan_detail.type = "text";
        plan_detail.className = "plan_detail form-control mb-2 mr-2";
        plan_detail.id = "plan_detail";
        plan_detail.name = "plan_detail[]";
        plan_detail.placeholder = "Количество деталей";
        plan_detail.oninput = function () { calculateAndDisplay(this); };
        plan_detail.readOnly = true;

        // описываем input для Итого тонн за месяц
        var result_plan_tn = document.createElement("input");
        result_plan_tn.type = "text";
        result_plan_tn.className = "result_plan_tn form-control mb-2 mr-2";
        result_plan_tn.id = "result_plan_tn";
        result_plan_tn.name = "result_plan_tn[]";
        result_plan_tn.placeholder = "Итого тонн за месяц";
        result_plan_tn.oninput = function () { calculateAndDisplay(this); };
        result_plan_tn.readOnly = true;

        // описываем input для Итого вагонов за месяц
        var result_plan_van = document.createElement("input");
        result_plan_van.type = "text";
        result_plan_van.className = "result_plan_van form-control mb-2 mr-2";
        result_plan_van.id = "result_plan_van";
        result_plan_van.name = "result_plan_van[]";
        result_plan_van.placeholder = "Итого вагонов за месяц";
        result_plan_van.oninput = function () { calculateAndDisplay(this); };
        result_plan_van.readOnly = true;


        // описываем input для Итого вагонов за месяц
        var required_num_hours_ton = document.createElement("input");
        required_num_hours_ton.type = "text";
        required_num_hours_ton.className = "required_num_hours_ton form-control mb-2 mr-2";
        required_num_hours_ton.id = "required_num_hours_ton";
        required_num_hours_ton.name = "required_num_hours_ton[]";
        required_num_hours_ton.placeholder = "Кол-во ч/ч на тонну";
        required_num_hours_ton.oninput = function () { calculateAndDisplay(this); };
        required_num_hours_ton.readOnly = true;


        // описываем селект на выборку деталей с базы
        var newSelect = document.createElement("select");
        newSelect.className = "form-control mb-2 detail";
        newSelect.id = "detail";
        newSelect.name = "detail[]";
        newSelect.onchange = function () {
            updateWeight(this);
        };

        var details = <?php echo json_encode($details); ?>;
        details.forEach(function (detail) {
            var option = document.createElement("option");
            option.value = detail.weight + ' ' + detail.norm_of_hours + ' ' + detail.title; // передаем данные через option(нужно что бы в базу записывалось все)
            option.setAttribute("data-weight", detail.weight);

            var optionText = document.createTextNode(detail.title + detail.weight + 'кг'); // вывод в селект составляющих
            option.appendChild(optionText);

            newSelect.appendChild(option);
        });

        // создаем все описаные элементы
        newDiv.appendChild(newSelect); // Селект на выбор деталей
        newDiv.appendChild(newNum1); // Ввод месячного плана в тоннах
        newDiv.appendChild(plan_mont_van); // Вывод вагонов за месяц
        newDiv.appendChild(plan_detail); // Вывод деталей за месяц
        newDiv.appendChild(result_plan_tn); // Вывод плана в тоннах за месяц
        newDiv.appendChild(result_plan_van); // Вывод плана в вагонах за месяц
        newDiv.appendChild(required_num_hours_ton); // Вывод плана в вагонах за месяц
        newDiv.appendChild(deleteButton);

        form.appendChild(newDiv); // выводим элементы в форму
    }

    // функция для передачи атрибута weight из селекта
    // function updateWeight(selectElement) {
    //     var selectedOption = selectElement.options[selectElement.selectedIndex];
    //     var normOfHours = selectedOption.getAttribute("title");
    //     var inputElement = document.getElementById("norm_of_hours");
    //     inputElement.value = normOfHours;
    // }


    // Расчет общей суммы вагонов по плану за месяц
    function calculateTotalVanMonth() {
        var inputs = document.getElementsByClassName("plan_month_tn");
        var total_plan_month_van = 0;

        for (var i = 0; i < inputs.length; i++) {
            var value = parseFloat(inputs[i].value);
            if (!isNaN(value)) {
                total_plan_month_van += value;
            }
        }

        total_plan_month_van = (total_plan_month_van / 65).toFixed(2);
        document.getElementById("total_plan_month_van").value = total_plan_month_van;
    }


    // Расчет общей суммы тонн по плану за месяц
    function calculateTotalTnMonth() {
        var inputs = document.getElementsByClassName("plan_month_tn");
        var total_plan_month_tn = 0;

        for (var i = 0; i < inputs.length; i++) {
            var value = parseFloat(inputs[i].value);
            if (!isNaN(value)) {
                total_plan_month_tn += value;
            }
        }

        total_plan_month_tn = (total_plan_month_tn).toFixed(2);
        document.getElementById("total_plan_month_tn").value = total_plan_month_tn;
    }

    // Расчет общей суммы деталей по плану за месяц
    function calculateTotalDetailMonth() {
        var weight = parseFloat(document.querySelector(".detail").value);
        var inputs = document.getElementsByClassName("plan_month_tn");
        var total_plan_month_delail = 0;

        for (var i = 0; i < inputs.length; i++) {
            var value = parseFloat(inputs[i].value);
            if (!isNaN(value)) {
                total_plan_month_delail += value;
            }
        }

        total_plan_month_delail = (total_plan_month_delail * 1000 / weight).toFixed(2);
        document.getElementById("total_plan_month_delail").value = total_plan_month_delail;

    }


    // Расчет общего количества челокеко-часов на тонну по плану за месяц
    function calculateTotalNumHoursMonth() {
        var normOfHours = parseFloat(document.querySelector(".detail").value.split(" ")[1]);
        var inputs = document.getElementsByClassName("plan_month_tn");
        var total_required_num_hours_ton = 0;

        for (var i = 0; i < inputs.length; i++) {
            var value = parseFloat(inputs[i].value);
            if (!isNaN(value)) {
                total_required_num_hours_ton += value;
            }
        }

        total_required_num_hours_ton = (total_required_num_hours_ton * normOfHours).toFixed(2);
        document.getElementById("total_required_num_hours_ton").value = total_required_num_hours_ton;

    }
</script>

<?php $content = ob_get_clean();

include 'app/views/layout/layout.php';
?>