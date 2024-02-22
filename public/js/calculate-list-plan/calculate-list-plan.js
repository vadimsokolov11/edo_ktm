// Функция для расчета данных
function calculateAndDisplay(inputElement) {
    // Функции для расчет всех значений 
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