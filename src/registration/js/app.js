document.addEventListener("DOMContentLoaded", () => {
  const formData = {
    email: "",
    fullname: "",
    dob: "",
    phone: "",
    password: "",
    userType: "",
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

  let currentStep = 2;
  const totalMenteeSteps = 3;
  const totalMentorSteps = 6;
  let stream;

  function updateProgressBar() {
    const steps = document.querySelectorAll(".progress-step");
    steps.forEach((step, index) => {
      const stepNum = parseInt(step.getAttribute("data-step"));
      const stepType = step.getAttribute("data-type") || "";
      const circle = step.querySelector(".step-circle");
      const line = step.querySelector(".step-line");
      if (
        (formData.userType === "MENTEE" && stepType === "mentor") ||
        (formData.userType === "MENTOR" && stepType === "mentee")
      ) {
        circle.style.background = "green";
        line.style.background = "green";
        return;
      }
      if (
        stepNum < currentStep ||
        (currentStep === totalMenteeSteps && formData.userType === "MENTEE") ||
        (currentStep === totalMentorSteps && formData.userType === "MENTOR")
      ) {
        circle.classList.add("active");
        line.classList.add("active");
      } else {
        circle.classList.remove("active");
        line.classList.remove("active");
      }
    });
  }

  function showStep(step) {
    document
      .querySelectorAll(".step")
      .forEach((s) => s.classList.add("hidden"));
    if (step === 2) {
      document.getElementById("step2").classList.remove("hidden");
    } else if (step === 3) {
      if (formData.userType === "MENTEE") {
        document.getElementById("menteeStep3").classList.remove("hidden");
      } else if (formData.userType === "MENTOR") {
        document.getElementById("mentorStep3").classList.remove("hidden");
      }
    } else if (step === 4 && formData.userType === "MENTOR") {
      document.getElementById("mentorStep4").classList.remove("hidden");
      initializeCamera();
    } else if (step === 5 && formData.userType === "MENTOR") {
      document.getElementById("mentorStep5").classList.remove("hidden");
    } else if (step === 6 && formData.userType === "MENTOR") {
      document.getElementById("mentorFinal").classList.remove("hidden");
    }
    updateProgressBar();
  }

  function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
  }

  function validatePhone(phone) {
    const re = /^\+?\d{10,15}$/;
    return re.test(phone);
  }

  function validatePassword(password) {
    return password.length >= 8;
  }

  function validateStep(step) {
    let isValid = true;
    if (step === 2) {
      const fullname = document.getElementById("fullname").value;
      const dob = document.getElementById("dob").value;
      const phone = document.getElementById("phone").value;
      const password = document.getElementById("password").value;
      const confirmPassword = document.getElementById("confirmPassword").value;
      const userType = document.querySelector(
        'input[name="userType"]:checked'
      )?.value;

      document.getElementById("fullnameError").classList.add("hidden");
      document.getElementById("dobError").classList.add("hidden");
      document.getElementById("phoneError").classList.add("hidden");
      document.getElementById("passwordError").classList.add("hidden");
      document.getElementById("confirmPasswordError").classList.add("hidden");
      document.getElementById("userTypeError").classList.add("hidden");

      if (!fullname) {
        document.getElementById("fullnameError").textContent =
          "Full name is required";
        document.getElementById("fullnameError").classList.remove("hidden");
        isValid = false;
      }
      if (!dob) {
        document.getElementById("dobError").textContent =
          "Date of birth is required";
        document.getElementById("dobError").classList.remove("hidden");
        isValid = false;
      }
      if (!validatePhone(phone)) {
        document.getElementById("phoneError").textContent =
          "Please enter a valid phone number";
        document.getElementById("phoneError").classList.remove("hidden");
        isValid = false;
      }
      if (!validatePassword(password)) {
        document.getElementById("passwordError").textContent =
          "Password must be at least 8 characters";
        document.getElementById("passwordError").classList.remove("hidden");
        isValid = false;
      }
      if (password !== confirmPassword) {
        document.getElementById("confirmPasswordError").textContent =
          "Passwords do not match";
        document
          .getElementById("confirmPasswordError")
          .classList.remove("hidden");
        isValid = false;
      }
      if (!userType) {
        document.getElementById("userTypeError").textContent =
          "Please select a user type";
        document.getElementById("userTypeError").classList.remove("hidden");
        isValid = false;
      }

      if (isValid) {
        formData.fullname = fullname;
        formData.dob = dob;
        formData.phone = phone;
        formData.password = password;
        formData.userType = userType;
      }
    } else if (step === 3 && formData.userType === "MENTEE") {
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
    } else if (step === 3 && formData.userType === "MENTOR") {
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
    } else if (step === 4 && formData.userType === "MENTOR") {
      if (!formData.selfie) {
        document.getElementById("selfieError").textContent =
          "Please capture a selfie";
        document.getElementById("selfieError").classList.remove("hidden");
        isValid = false;
      } else {
        document.getElementById("selfieError").classList.add("hidden");
      }
    } else if (step === 5 && formData.userType === "MENTOR") {
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
                <p><strong>Education Level:</strong> ${
                  formData.educationLevel
                }</p>
                <p><strong>Tertiary Education:</strong> ${
                  formData.tertiaryEducation || "N/A"
                }</p>
                <p><strong>Learning Goals:</strong> ${
                  formData.learningGoals
                }</p>
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

  async function initializeCamera() {
    const video = document.getElementById("video");
    const canvas = document.getElementById("canvas");
    try {
      stream = await navigator.mediaDevices.getUserMedia({
        video: {
          facingMode: "user",
        }, // Use front camera
      });
      video.srcObject = stream;
    } catch (err) {
      document.getElementById("selfieError").textContent =
        "Unable to access camera: " + err.message;
      document.getElementById("selfieError").classList.remove("hidden");
    }
  }

  document.getElementById("captureSelfie").addEventListener("click", () => {
    const video = document.getElementById("video");
    const canvas = document.getElementById("canvas");
    const context = canvas.getContext("2d");
    context.drawImage(video, 0, 0, 300, 300);
    formData.selfie = canvas.toDataURL("image/png");
    document.getElementById("selfieError").classList.add("hidden");
  });

  document.getElementById("prev2").addEventListener("click", () => {
    currentStep = 1;
    showStep(1);
  });

  document.getElementById("next2").addEventListener("click", () => {
    if (validateStep(2)) {
      currentStep = 3;
      showStep(3);
    }
  });

  document.getElementById("prev3Mentee").addEventListener("click", () => {
    currentStep = 2;
    showStep(2);
  });

  document.getElementById("submitMentee").addEventListener("click", () => {
    if (validateStep(3)) {
      console.log("Mentee Registration:", formData);
      alert("Registration submitted successfully!");
      document.getElementById("registrationOverlay").classList.remove("active");
    }
  });

  document.getElementById("prev3Mentor").addEventListener("click", () => {
    currentStep = 2;
    showStep(2);
  });

  document.getElementById("next3Mentor").addEventListener("click", () => {
    if (validateStep(3)) {
      currentStep = 4;
      showStep(4);
    }
  });

  document.getElementById("prev4Mentor").addEventListener("click", () => {
    if (stream) {
      stream.getTracks().forEach((track) => track.stop());
    }
    currentStep = 3;
    showStep(3);
  });

  document.getElementById("next4Mentor").addEventListener("click", () => {
    if (validateStep(4)) {
      if (stream) {
        stream.getTracks().forEach((track) => track.stop());
      }
      currentStep = 5;
      showStep(5);
    }
  });

  document.getElementById("prev5Mentor").addEventListener("click", () => {
    currentStep = 4;
    showStep(4);
    initializeCamera();
  });

  document.getElementById("submitMentor").addEventListener("click", () => {
    if (validateStep(5)) {
      currentStep = 6;
      displayConfirmation();
      showStep(6);
    }
  });

  document.getElementById("prev6Mentor").addEventListener("click", () => {
    currentStep = 5;
    showStep(5);
  });

  document.getElementById("finishMentor").addEventListener("click", () => {
    console.log("Mentor Registration:", formData);
    alert("Mentor application submitted! It is now pending review.");
    if (stream) {
      stream.getTracks().forEach((track) => track.stop());
    }
    document.getElementById("registrationOverlay").classList.remove("active");
  });

  document.getElementById("registrationOverlay").classList.add("active");
  showStep(2);
});
