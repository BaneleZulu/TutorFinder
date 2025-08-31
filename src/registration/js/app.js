document
  .getElementById("cancelRegistrationBtn")
  .addEventListener("click", () => {
    document.getElementById("registrationForm").reset();
    localStorage.removeItem("userType");
    localStorage.removeItem("email");
    document.getElementById("registrationOverlay").style.display = "none";
  });

const email = localStorage.getItem("email");
const type = localStorage.getItem("userType");

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
  let stream = null;
  formData.userType = type;
  formData.email = email;

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
      const stepType = step.getAttribute("data-type") || "";
      const stepNum = parseInt(step.getAttribute("data-step"));
      const circle = step.querySelector(".step-circle");
      const line = step.querySelector(".step-line");

      console.log("StepType", stepType);
      console.log("UserType", formData.userType);
      console.log("Email", formData.email);

      // Show steps matching userType or no specific type
      step.style.display =
        !stepType || stepType.toLowerCase() === formData.userType.toLowerCase()
          ? "block"
          : "none";

      // Activate steps up to current step
      if (stepNum <= currentStep && step.style.display !== "none") {
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
      if (!phone) {
        phoneError.textContent = "Phone number is required";
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

      if (learningGoals.length < 100) {
        document.getElementById("learningGoalsError").textContent =
          "Learning goals cannot be less than 100 characters";
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
      const selfieData = document.getElementById("selfieData").value;
      if (!selfieData) {
        document.getElementById("selfieError").textContent =
          "Please capture a selfie before proceeding.";
        document.getElementById("selfieError").classList.remove("hidden");
        isValid = false;
      } else {
        document.getElementById("selfieError").classList.add("hidden");
        formData.selfie = selfieData;
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
      ${formData.userType === "MENTEE" ?
          `
            <p><strong>Education Level:</strong> ${formData.educationLevel}</p>
            <p><strong>Tertiary Education:</strong> ${
              formData.tertiaryEducation || "N/A"
            }</p>
            <p><strong>Learning Goals:</strong> ${formData.learningGoals}</p>
          `
          : `
            <p><strong>Specialities:</strong> ${formData.specialities}</p>
            <p><strong>Experience Years:</strong> ${formData.experienceYears}</p>
            <p><strong>Hourly Rate:</strong> $${formData.hourlyRate}</p>
            <p><strong>Selfie:</strong> Captured</p>
            <p><strong>ID Document:</strong> ${formData.idDocument ? formData.idDocument.name : "N/A"}</p>
            <p><strong>Certificate:</strong> ${formData.certificate ? formData.certificate.name : "N/A"}</p>
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
      video.style.display = "block";
      canvas.style.display = "none";
      document.getElementById("captureSelfie").style.display = "inline-block";
      document.getElementById("retakeSelfie").style.display = "none";
      document.getElementById("selfieData").value = "";
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
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    const imageData = canvas.toDataURL("image/jpeg");
    document.getElementById("selfieData").value = imageData;
    formData.selfie = imageData;
    video.style.display = "none";
    canvas.style.display = "block";
    document.getElementById("captureSelfie").style.display = "none";
    document.getElementById("retakeSelfie").style.display = "inline-block";
    document.getElementById("selfieError").classList.add("hidden");
  });

  // Handle selfie retake
  document.getElementById("retakeSelfie").addEventListener("click", () => {
    const video = document.getElementById("video");
    const canvas = document.getElementById("canvas");
    document.getElementById("selfieData").value = "";
    formData.selfie = null;
    canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);
    video.style.display = "block";
    canvas.style.display = "none";
    document.getElementById("captureSelfie").style.display = "inline-block";
    document.getElementById("retakeSelfie").style.display = "none";
    document.getElementById("selfieError").classList.add("hidden");
  });

  // Handle selfie submission to backend
  document.getElementById("next3Mentor").addEventListener("click", async () => {
    if (validateStep(3)) {
      formData.selfie = document.getElementById("selfieData").value;
      if (stream) {
        stream.getTracks().forEach((track) => track.stop());
        stream = null;
      }
      currentStep = 4;
      showStep(4);
    }
  });

  // Step navigation
  document.getElementById("next1").addEventListener("click", () => {
    if (validateStep(1)) {
      currentStep = 2;
      const loadingSpinner = document.getElementById("loadingSpinnerStep1");
      loadingSpinner.style.display = "inline-block";
      setTimeout(() => {
        showStep(2);
        loadingSpinner.style.display = "none";
      }, 3000);
    } else {
      Toastify({
        text: "Please fill in all required fields.",
        duration: 3000,
        gravity: "top",
        position: "right",
        style: { background: "#ef4444" },
      }).showToast();
    }
  });

  document.getElementById("prev2Mentee").addEventListener("click", () => {
    currentStep = 1;
    showStep(1);
  });

  document.getElementById("submitMentee").addEventListener("click", () => {
    if (validateStep(2)) {
      console.log("Mentee Registration:", formData);
      Toastify({
        text: "Registration submitted successfully!",
        duration: 3000,
        gravity: "top",
        position: "right",
        style: { background: "#22c55e" },
      }).showToast();
      closeOverlayStep("#registrationOverlay");
      localStorage.removeItem("userType");
      localStorage.removeItem("email");
      Object.keys(formData).forEach((key) => (formData[key] = ""));
      currentStep = 1;
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
      stream = null;
    }
    currentStep = 2;
    showStep(2);
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
    Swal.fire({
      title: "Application Submitted",
      text: "Mentor application submitted! It is now pending review.",
      icon: "success",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Continue!",
    }).then(async (result) => {
      if (result.isConfirmed) {
        await handleLogout(event);
        setTimeout(() => {
          window.location.href = "/index.php";
        }, 500);
      }
    });
    closeOverlayStep("#registrationOverlay");
    localStorage.removeItem("userType");
    localStorage.removeItem("email");
    Object.keys(formData).forEach((key) => (formData[key] = ""));
    currentStep = 1;
  });

  // Show signup overlay on page load
  showOverlay("#signupOverlay");

  function validateNumberInputs() {
    const numberInputs = document.querySelectorAll('input[type="number"]');
    numberInputs.forEach((input) => {
      input.addEventListener("input", (event) => {
        const value = event.target.value;
        const isValidNumber = /^-?\d*\.?\d*$/.test(value);
        if (!isValidNumber && value !== "") {
          event.target.value = "";
          Toastify({
            text: "Only numeric values are allowed.",
            duration: 3000,
            gravity: "top",
            position: "right",
            style: { background: "#ef4444" },
          }).showToast();
          console.warn(
            `Invalid input in ${
              input.id || "number input"
            }: Only numeric values are allowed.`
          );
        }
      });

      input.addEventListener("keypress", (event) => {
        const char = String.fromCharCode(event.keyCode || event.which);
        if (!/[0-9.-]/.test(char) && !event.ctrlKey && !event.metaKey) {
          event.preventDefault();
        }
      });
    });
  }

  document.addEventListener("DOMContentLoaded", validateNumberInputs);
});
