    // Проверка на одинаковыую выборку в select detail на выборку деталей
    function updateWeight(element) {
        var selectElements = document.getElementsByClassName("form-control mb-2 detail");
        var selectedValues = [];

        // Получаем выбранные значения из всех элементов <select>
        for (var i = 0; i < selectElements.length; i++) {
            var selectedOption = selectElements[i].options[selectElements[i].selectedIndex].value;
            selectedValues.push(selectedOption);
        }
        
        // Проверяем наличие дублирующихся значений
        var hasDuplicates = (new Set(selectedValues)).size !== selectedValues.length;

        // Если есть дублирующиеся значения, сбрасываем выбор текущего элемента
        if (hasDuplicates) {
            element.selectedIndex = 0;
            alert("В плане производства не может быть одинаковых!");
        }
    }

    // Проверка на одинаковых пользователей по огласованию и утверждению плана
    function selectUsers(element) {
        var selectElements = document.getElementsByClassName("form-control users");
        var selectedValues = [];

        // Получаем выбранные значения из всех элементов <select>
        for (var i = 0; i < selectElements.length; i++) {
            var selectedOption = selectElements[i].options[selectElements[i].selectedIndex].value;
            selectedValues.push(selectedOption);
        }

        // Проверяем наличие дублирующихся значений
        var hasDuplicates = (new Set(selectedValues)).size !== selectedValues.length;

        // Если есть дублирующиеся значения, сбрасываем выбор текущего элемента
        if (hasDuplicates) {
            element.selectedIndex = 0;
            alert("Один и тот же пользователь не может согласовать и утвердить план производства!");
        }
    }