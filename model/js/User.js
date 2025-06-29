class User {
  constructor(userType) {
    this.userType = userType; // "mentor" or "mentee"
    this.userData = {};
  }

  validateEmail(email) {
    const pattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return pattern.test(email);
  }

  validatePhone(phone) {
    const pattern = /^\+?\d{7,15}$/;
    return pattern.test(phone);
  }

  validatePassword(password) {
    return password.length === 8 || password > 8;
  }

  validatePassword(password, confirmPassword) {
    return (
      password &&
      confirmPassword &&
      password === confirmPassword &&
      password.length >= 8
    );
  }

  showError(id, message) {
    const el = document.getElementById(id);
    el.textContent = message;
    el.classList.remove("hidden");
  }

  hideError(id) {
    const el = document.getElementById(id);
    el.textContent = "";
    el.classList.add("hidden");
  }

  // 🧩 Set data
  setField(field, value) {
    this.userData[field] = value;
  }

  // 🔁 CRUD-style Methods
  createUser() {
    console.log(`✅ Creating ${this.userType}`, this.userData);
    // Hook to AJAX / fetch logic here
  }

  updateUser(field, value) {
    if (this.userData.hasOwnProperty(field)) {
      this.userData[field] = value;
      console.log(`✏️ Updated field ${field} to`, value);
    }
  }

  deleteUser() {
    console.log(`🗑️ Deleting ${this.userType} user data...`);
    this.userData = {};
  }

  // 🚦 Step 1: Form Handling Utility
  collectBasicInfo() {
    const fullname = document.getElementById("fullname").value.trim();
    const dob = document.getElementById("dob").value;
    const phone = document.getElementById("phone").value.trim();
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;

    // Clear any existing errors
    [
      "fullnameError",
      "dobError",
      "phoneError",
      "passwordError",
      "confirmPasswordError",
    ].forEach((id) => this.hideError(id));

    let valid = true;

    if (!fullname) {
      this.showError("fullnameError", "Full name is required.");
      valid = false;
    }

    if (!dob) {
      this.showError("dobError", "Date of birth is required.");
      valid = false;
    }

    if (!this.validatePhone(phone)) {
      this.showError("phoneError", "Invalid phone number.");
      valid = false;
    }

    if (!this.validatePassword(password, confirmPassword)) {
      this.showError(
        "confirmPasswordError",
        "Passwords do not match or are too short."
      );
      valid = false;
    }

    if (valid) {
      this.setField("fullname", fullname);
      this.setField("dob", dob);
      this.setField("phone", phone);
      this.setField("password", password);
    }

    return valid;
  }
}
