import User from "../../../model/js/User.js";
console.log("user obj", User); // Should log the User class
const user = new User(
  localStorage.getItem("userType")?.toLowerCase() || "mentor"
);
document.addEventListener("DOMContentLoaded", () => {
  const formData = {
    email: "test@mail.com", // Re-added email to store from signupOverlay
    fullname: "",
    dob: "",
    phone: "",
    password: "",
    userType: "mentor",
    educationLevel: "",
    tertiaryEducation: "",
    learningGoals: "",
    specialities: "",
    experienceYears: "",
    hourlyRate: "",
    selfie: null,
    idDocument: null,
    certificate: null,
  };

  let currentStep = 1; // Start at step 1 (Basic Info)
  let stream;

  // Validation helper functions
  function validatePhone(phone) {
    const phoneRegex = /^[\+]?[1-9][\d]{0,15}$/;
    return phoneRegex.test(phone.replace(/\s/g, ""));
  }

  function validatePassword(password) {
    return password && password.length >= 8;
  }

  // Show/hide overlays
  function closeOverlayStep(selector) {
    document.querySelector(selector).classList.remove("active");
  }

  function showOverlay(selector) {
    document.querySelector(selector).classList.add("active");
  }

  // Update progress bar based on user type
  function updateProgressBar() {
    const steps = document.querySelectorAll(".progress-step");
    steps.forEach((step) => {
      const stepType = localStorage.getItem("userType") || "";
      step.style.display =
        stepType === "" || stepType === formData.userType.toLowerCase()
          ? "block"
          : "none";

      const stepNum = parseInt(step.getAttribute("data-step"));
      const circle = step.querySelector(".step-circle");
      const line = step.querySelector(".step-line");

      if (stepNum <= currentStep) {
        circle.classList.add("active");
        line.classList.add("active");
      } else {
        circle.classList.remove("active");
        line.classList.remove("active");
      }
    });
  }

  // Show the appropriate form step
  function showStep(step) {
    document
      .querySelectorAll(".step")
      .forEach((s) => s.classList.add("hidden"));
    if (step === 1) {
      document.getElementById("step1").classList.remove("hidden");
    } else if (step === 2) {
      if (formData.userType === "MENTEE") {
        document.getElementById("menteeStep2").classList.remove("hidden");
      } else if (formData.userType === "MENTOR") {
        document.getElementById("mentorStep2").classList.remove("hidden");
      }
    } else if (step === 3 && formData.userType === "MENTOR") {
      document.getElementById("mentorStep3").classList.remove("hidden");
      initializeCamera();
    } else if (step === 4 && formData.userType === "MENTOR") {
      document.getElementById("mentorStep4").classList.remove("hidden");
    } else if (step === 5 && formData.userType === "MENTOR") {
      document.getElementById("mentorFinal").classList.remove("hidden");
    }
    updateProgressBar();
  }

  function validateStep(step) {
    let isValid = true;

    if (step === 1) {
      const fullname = document.getElementById("fullname").value;
      const dob = document.getElementById("dob").value;
      const phone = document.getElementById("phone").value;
      const password = document.getElementById("password").value;
      const confirmPassword = document.getElementById("confirmPassword").value;

      // Get error elements
      const nameError = document.getElementById("fullnameError");
      const dobError = document.getElementById("dobError");
      const phoneError = document.getElementById("phoneError");
      const passwordError = document.getElementById("passwordError");
      const confirmError = document.getElementById("confirmPasswordError");

      // Get input elements
      const fullnameInput = document.getElementById("fullname");
      const dobInput = document.getElementById("dob");
      const phoneInput = document.getElementById("phone");
      const passwordInput = document.getElementById("password");
      const confirmPasswordInput = document.getElementById("confirmPassword");

      // Clear previous errors
      nameError.classList.add("hidden");
      dobError.classList.add("hidden");
      phoneError.classList.add("hidden");
      passwordError.classList.add("hidden");
      confirmError.classList.add("hidden");

      // Clear previous styling
      [
        fullnameInput,
        dobInput,
        phoneInput,
        passwordInput,
        confirmPasswordInput,
      ].forEach((input) => {
        input.classList.remove("error", "success");
      });

      // Validate fullname
      if (!fullname || fullname.trim() === "") {
        nameError.textContent = "Full name is required";
        nameError.classList.remove("hidden");
        nameError.classList.add("error-message", "show");
        fullnameInput.classList.add("error");
        isValid = false;
      }

      // Validate date of birth
      if (!dob) {
        dobError.textContent = "Date of birth is required";
        dobError.classList.remove("hidden");
        dobError.classList.add("error-message", "show");
        dobInput.classList.add("error");
        isValid = false;
      }

      // Validate phone
      if (!validatePhone(phone)) {
        phoneError.textContent = "Please enter a valid phone number";
        phoneError.classList.remove("hidden");
        phoneError.classList.add("error-message", "show");
        phoneInput.classList.add("error");
        isValid = false;
      }

      // Validate password
      if (!validatePassword(password)) {
        passwordError.textContent = "Password must be at least 8 characters";
        passwordError.classList.remove("hidden");
        passwordError.classList.add("error-message", "show");
        passwordInput.classList.add("error");
        isValid = false;
      }

      // Validate password confirmation
      if (password !== confirmPassword) {
        confirmError.textContent = "Passwords do not match";
        confirmError.classList.remove("hidden");
        confirmError.classList.add("error-message", "show");
        confirmPasswordInput.classList.add("error");
        isValid = false;
      }

      // If valid, add success styling and store data
      if (isValid) {
        [, dobInput, phoneInput, passwordInput, confirmPasswordInput].forEach(
          (input) => {
            input.classList.add("success");
          }
        );

        formData.fullname = fullname;
        formData.dob = dob;
        formData.phone = phone;
        formData.password = password;
      }
    } else if (step === 2 && formData.userType === "MENTEE") {
      const educationLevel = document.getElementById("educationLevel").value;
      const learningGoals = document.getElementById("learningGoals").value;

      document.getElementById("educationLevelError").classList.add("hidden");
      document.getElementById("learningGoalsError").classList.add("hidden");

      if (!educationLevel) {
        document.getElementById("educationLevelError").textContent =
          "Education level is required";
        document
          .getElementById("educationLevelError")
          .classList.remove("hidden");
        isValid = false;
      }
      if (!learningGoals) {
        document.getElementById("learningGoalsError").textContent =
          "Learning goals are required";
        document
          .getElementById("learningGoalsError")
          .classList.remove("hidden");
        isValid = false;
      }

      if (isValid) {
        formData.educationLevel = educationLevel;
        formData.tertiaryEducation =
          document.getElementById("tertiaryEducation").value;
        formData.learningGoals = learningGoals;
      }
    } else if (step === 2 && formData.userType === "MENTOR") {
      const specialities = document.getElementById("specialities").value;
      const experienceYears = document.getElementById("experienceYears").value;
      const hourlyRate = document.getElementById("hourlyRate").value;

      document.getElementById("specialitiesError").classList.add("hidden");
      document.getElementById("experienceYearsError").classList.add("hidden");
      document.getElementById("hourlyRateError").classList.add("hidden");

      if (!specialities) {
        document.getElementById("specialitiesError").textContent =
          "Specialities are required";
        document.getElementById("specialitiesError").classList.remove("hidden");
        isValid = false;
      }
      if (!experienceYears || experienceYears < 0) {
        document.getElementById("experienceYearsError").textContent =
          "Valid years of experience required";
        document
          .getElementById("experienceYearsError")
          .classList.remove("hidden");
        isValid = false;
      }
      if (!hourlyRate || hourlyRate < 0) {
        document.getElementById("hourlyRateError").textContent =
          "Valid hourly rate required";
        document.getElementById("hourlyRateError").classList.remove("hidden");
        isValid = false;
      }

      if (isValid) {
        formData.specialities = specialities;
        formData.experienceYears = experienceYears;
        formData.hourlyRate = hourlyRate;
      }
    } else if (step === 3 && formData.userType === "MENTOR") {
      if (!formData.selfie) {
        document.getElementById("selfieError").textContent =
          "Please capture a selfie";
        document.getElementById("selfieError").classList.remove("hidden");
        isValid = false;
      } else {
        document.getElementById("selfieError").classList.add("hidden");
      }
    } else if (step === 4 && formData.userType === "MENTOR") {
      const idDocument = document.getElementById("idDocument").files[0];
      if (!idDocument) {
        document.getElementById("idDocumentError").textContent =
          "ID document is required";
        document.getElementById("idDocumentError").classList.remove("hidden");
        isValid = false;
      } else {
        document.getElementById("idDocumentError").classList.add("hidden");
        formData.idDocument = idDocument;
        formData.certificate = document.getElementById("certificate").files[0];
      }
    }
    return isValid;
  }

  // Display confirmation details
  function displayConfirmation() {
    const details = `
      <p><strong>Email:</strong> ${formData.email}</p>
      <p><strong>Full Name:</strong> ${formData.fullname}</p>
      <p><strong>Date of Birth:</strong> ${formData.dob}</p>
      <p><strong>Phone:</strong> ${formData.phone}</p>
      <p><strong>User Type:</strong> ${formData.userType}</p>
      ${
        formData.userType === "MENTEE"
          ? `
            <p><strong>Education Level:</strong> ${formData.educationLevel}</p>
            <p><strong>Tertiary Education:</strong> ${
              formData.tertiaryEducation || "N/A"
            }</p>
            <p><strong>Learning Goals:</strong> ${formData.learningGoals}</p>
          `
          : `
            <p><strong>Specialities:</strong> ${formData.specialities}</p>
            <p><strong>Experience Years:</strong> ${
              formData.experienceYears
            }</p>
            <p><strong>Hourly Rate:</strong> $${formData.hourlyRate}</p>
            <p><strong>Selfie:</strong> Captured</p>
            <p><strong>ID Document:</strong> ${
              formData.idDocument ? formData.idDocument.name : "N/A"
            }</p>
            <p><strong>Certificate:</strong> ${
              formData.certificate ? formData.certificate.name : "N/A"
            }</p>
          `
      }
    `;
    document.getElementById("confirmationDetails").innerHTML = details;
  }

  // Initialize camera for selfie step
  async function initializeCamera() {
    const video = document.getElementById("video");
    const canvas = document.getElementById("canvas");
    try {
      stream = await navigator.mediaDevices.getUserMedia({
        video: { facingMode: "user" },
      });
      video.srcObject = stream;
    } catch (err) {
      document.getElementById("selfieError").textContent =
        "Unable to access camera: " + err.message;
      document.getElementById("selfieError").classList.remove("hidden");
    }
  }

  // Handle selfie capture
  document.getElementById("captureSelfie").addEventListener("click", () => {
    const video = document.getElementById("video");
    const canvas = document.getElementById("canvas");
    const context = canvas.getContext("2d");
    context.drawImage(video, 0, 0, 300, 300);
    formData.selfie = canvas.toDataURL("image/png");
    document.getElementById("selfieError").classList.add("hidden");
  });

  // Step navigation
  document.getElementById("next1").addEventListener("click", () => {
    if (validateStep(1)) {
      currentStep = 2;
      const loadingSpinner = document.getElementById("loadingSpinnerStep1");
      // Show loading spinner
      loadingSpinner.style.display = "inline-block";

      // Simulate async operation (e.g., API call or transition delay)
      setTimeout(() => {
        showStep(2);
        loadingSpinner.style.display = "none";
      }, 3000); // Simulate delay for UX
    } else {
      console.log("Validation failed for step 1");
    }
  });

  document.getElementById("prev2Mentee").addEventListener("click", () => {
    currentStep = 1;
    showStep(1);
  });

  document.getElementById("submitMentee").addEventListener("click", () => {
    if (validateStep(2)) {
      console.log("Mentee Registration:", formData);
      alert("Registration submitted successfully!");
      closeOverlayStep("#registrationOverlay");
    }
  });

  document.getElementById("prev2Mentor").addEventListener("click", () => {
    currentStep = 1;
    showStep(1);
  });

  document.getElementById("next2Mentor").addEventListener("click", () => {
    if (validateStep(2)) {
      currentStep = 3;
      showStep(3);
    }
  });

  document.getElementById("prev3Mentor").addEventListener("click", () => {
    if (stream) {
      stream.getTracks().forEach((track) => track.stop());
    }
    currentStep = 2;
    showStep(2);
  });

  document.getElementById("next3Mentor").addEventListener("click", () => {
    if (validateStep(3)) {
      if (stream) {
        stream.getTracks().forEach((track) => track.stop());
      }
      currentStep = 4;
      showStep(4);
    }
  });

  document.getElementById("prev4Mentor").addEventListener("click", () => {
    currentStep = 3;
    showStep(3);
  });

  document.getElementById("submitMentor").addEventListener("click", () => {
    if (validateStep(4)) {
      currentStep = 5;
      displayConfirmation();
      showStep(5);
    }
  });

  document.getElementById("prev5Mentor").addEventListener("click", () => {
    currentStep = 4;
    showStep(4);
  });

  document.getElementById("finishMentor").addEventListener("click", () => {
    console.log("Mentor Registration:", formData);
    alert("Mentor application submitted! It is now pending review.");
    closeOverlayStep("#registrationOverlay");
  });

  // Show signup overlay on page load
  showOverlay("#signupOverlay");
});
