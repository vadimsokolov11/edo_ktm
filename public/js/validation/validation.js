const inputFields = [
    'plan_month_tn',
    'plan_mont_van',
    'plan_detail',
    'result_plan_tn',
    'result_plan_van',
    'required_num_hours_ton',
  ];
  
  inputFields.forEach((fieldId) => {
    const inputField = document.getElementById(fieldId);
  
    inputField.addEventListener('input', (event) => {
      let inputValue = event.target.value;
      inputValue = inputValue.replace(/\D/g, '');
      inputValue = inputValue.slice(0, 4);
      event.target.value = inputValue;
      if (inputValue.length > 4) {
        event.target.value = inputValue.slice(0, 4);
      }
    });
  });