// Method 1: Check if any radio in the group is selected
function validateUserType() {
  const userTypeRadios = document.getElementsByName("userType_radio");
  let isSelected = false;

  for (let radio of userTypeRadios) {
    if (radio.checked) {
      isSelected = true;
      break;
    }
  }

  if (!isSelected) {
    alert("Please select user type");
    return false;
  }
  return true;
}

// Method 2: Get the selected value directly
function getSelectedUserType() {
  const selected = document.querySelector(
    'input[name="userType_radio"]:checked'
  );
  return selected ? selected.value : null;
}

// Method 3: Using form data
function validateForm() {
  const formData = new FormData(document.getElementById("myForm"));
  const userType = formData.get("userType_radio");

  if (!userType) {
    alert("Please select user type");
    return false;
  }
  return true;
}
