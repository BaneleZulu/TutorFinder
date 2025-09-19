document.addEventListener("DOMContentLoaded", async () => {
  const email = localStorage.getItem("email");
  const type = localStorage.getItem("userType")?.toUpperCase(); // Normalize to uppercase

  const forms = [
    document.getElementById("menteeRegistrationForm"),
    document.getElementById("mentorRegistrationForm"),
  ];
  forms.forEach((form) => {
    form.addEventListener("submit", (event) => {
      event.preventDefault(); // Prevent form submission
    });
  });

  const formData = {
    email: email || "test@mail.com",
    fullname: "",
    dob: "",
    phone: "",
    password: "",
    userType: type || "MENTOR", // Default to MENTOR if undefined
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

  let currentStep = 1;
  let stream = null;

  formData.email = email;
  formData.userType = type;

  // Show the correct overlay based on userType
  if (formData.userType === "MENTEE") {
    showOverlay("#menteeRegistrationOverlay");
  } else if (formData.userType === "MENTOR") {
    showOverlay("#mentorRegistrationOverlay");
  }

  // Add event listener for the confirmation close button
  document.addEventListener("click", (event) => {
    if (event.target.closest("#confirmationCloseBtn")) {
      closeConfirmation(event);
    }
  });

  function validatePassword(password) {
    return password && password.length >= 8;
  }

  function closeOverlayStep() {
    const overlayId =
      formData.userType === "MENTEE"
        ? "#menteeRegistrationOverlay"
        : "#mentorRegistrationOverlay";
    document.querySelector(overlayId).classList.remove("active");
  }

  function showOverlay(selector) {
    document.querySelector(selector).classList.add("active");
  }

  function updateProgressBar() {
    const steps = document.querySelectorAll(".progress-step");
    steps.forEach((step) => {
      const stepType = step.getAttribute("data-type")?.toLowerCase() || "";
      const stepNum = parseInt(step.getAttribute("data-step"));
      const circle = step.querySelector(".step-circle");
      const line = step.querySelector(".step-line");

      if (stepType && stepType !== formData.userType.toLowerCase()) {
        step.style.display = "none";
        return;
      } else {
        step.style.display = "flex";
      }

      if (stepNum <= currentStep) {
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
    if (step === 1) {
      document.getElementById("step1").classList.remove("hidden");
    } else if (step === 2) {
      if (formData.userType === "MENTEE") {
        document.getElementById("menteeStep2").classList.remove("hidden");
      } else if (formData.userType === "MENTOR") {
        document.getElementById("mentorStep2").classList.remove("hidden");
      }
    } else if (step === 3 && formData.userType === "MENTEE") {
      document.getElementById("menteeFinal").classList.remove("hidden");
      displayConfirmation();
    } else if (step === 3 && formData.userType === "MENTOR") {
      document.getElementById("mentorStep3").classList.remove("hidden");
      initializeCamera();
    } else if (step === 4 && formData.userType === "MENTOR") {
      document.getElementById("mentorStep4").classList.remove("hidden");
    } else if (step === 5 && formData.userType === "MENTOR") {
      document.getElementById("mentorFinal").classList.remove("hidden");
      displayConfirmation();
    }
    updateProgressBar();
  }

  function validateStep(step) {
    let isValid = true;
    console.log(`Validating Step ${step} for userType: ${formData.userType}`);

    if (step === 1) {
      const prefix = formData.userType === "MENTEE" ? "mentee-" : "mentor-";
      const formId =
        formData.userType === "MENTEE"
          ? "menteeRegistrationForm"
          : "mentorRegistrationForm";
      const form = document.getElementById(formId);
      const fullname = form.querySelector(`#${prefix}fullname`).value.trim();
      const dob = form.querySelector(`#${prefix}dob`).value;
      const phone = form.querySelector(`#${prefix}phone`).value.trim();
      const password = form.querySelector(`#${prefix}password`).value;
      const confirmPassword = form.querySelector(
        `#${prefix}confirmPassword`
      ).value;

      const nameError = form.querySelector(`#${prefix}fullnameError`);
      const dobError = form.querySelector(`#${prefix}dobError`);
      const phoneError = form.querySelector(`#${prefix}phoneError`);
      const passwordError = form.querySelector(`#${prefix}passwordError`);
      const confirmError = form.querySelector(`#${prefix}confirmPasswordError`);

      const fullnameInput = form.querySelector(`#${prefix}fullname`);
      const dobInput = form.querySelector(`#${prefix}dob`);
      const phoneInput = form.querySelector(`#${prefix}phone`);
      const passwordInput = form.querySelector(`#${prefix}password`);
      const confirmPasswordInput = form.querySelector(
        `#${prefix}confirmPassword`
      );

      // Clear previous errors
      nameError.classList.add("hidden");
      dobError.classList.add("hidden");
      phoneError.classList.add("hidden");
      passwordError.classList.add("hidden");
      confirmError.classList.add("hidden");

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
      if (!fullname) {
        nameError.textContent = "Full name is required";
        nameError.classList.remove("hidden");
        nameError.classList.add("error-message", "show");
        fullnameInput.classList.add("error");
        isValid = false;
      }

      // Validate date of birth and age
      if (!dob) {
        dobError.textContent = "Date of birth is required";
        dobError.classList.remove("hidden");
        dobError.classList.add("error-message", "show");
        dobInput.classList.add("error");
        isValid = false;
      } else {
        const age = new Date().getFullYear() - new Date(dob).getFullYear();
        if (age < 13 || (formData.userType === "MENTOR" && age < 18)) {
          dobError.textContent = `Must be at least ${
            formData.userType === "MENTOR" ? 18 : 13
          } years old`;
          dobError.classList.remove("hidden");
          dobError.classList.add("error-message", "show");
          dobInput.classList.add("error");
          isValid = false;
        }
      }

      // Validate phone
      if (!phone || !/^\d{10}$/.test(phone)) {
        phoneError.textContent = "Phone must be 10 digits";
        phoneError.classList.remove("hidden");
        phoneError.classList.add("error-message", "show");
        phoneInput.classList.add("error");
        isValid = false;
      }

      // Validate password
      const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*]).{8,}$/;
      if (!passwordRegex.test(password)) {
        passwordError.textContent =
          "Password must be 8+ characters with uppercase, number, special character";
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

      if (isValid) {
        [
          fullnameInput,
          dobInput,
          phoneInput,
          passwordInput,
          confirmPasswordInput,
        ].forEach((input) => {
          input.classList.add("success");
        });
        formData.fullname = fullname;
        formData.dob = dob;
        formData.phone = phone;
        formData.password = password;
      } else {
        console.log("Step 1 validation failed:", {
          fullname,
          dob,
          phone,
          password,
          confirmPassword,
          userType: formData.userType,
        });
      }
    } else if (step === 2 && formData.userType === "MENTEE") {
      const prefix = "mentee-";
      const educationLevel = document.getElementById(
        `${prefix}educationLevel`
      ).value;
      const learningGoals = document
        .getElementById(`${prefix}learningGoals`)
        .value.trim();

      document
        .getElementById(`${prefix}educationLevelError`)
        .classList.add("hidden");
      document
        .getElementById(`${prefix}learningGoalsError`)
        .classList.add("hidden");

      if (!educationLevel) {
        document.getElementById(`${prefix}educationLevelError`).textContent =
          "Education level is required";
        document
          .getElementById(`${prefix}educationLevelError`)
          .classList.remove("hidden");
        isValid = false;
      }
      if (!learningGoals || learningGoals.length < 100) {
        document.getElementById(`${prefix}learningGoalsError`).textContent =
          "Learning goals must be at least 100 characters";
        document
          .getElementById(`${prefix}learningGoalsError`)
          .classList.remove("hidden");
        isValid = false;
      }

      if (isValid) {
        formData.educationLevel = educationLevel;
        formData.tertiaryEducation = document
          .getElementById(`${prefix}tertiaryEducation`)
          .value.trim();
        formData.learningGoals = learningGoals;
      } else {
        console.log("Step 2 (Mentee) validation failed:", {
          educationLevel,
          learningGoals,
        });
      }
    } else if (step === 2 && formData.userType === "MENTOR") {
      const prefix = "mentor-";
      const specialities = document.getElementById(
        `${prefix}specialities`
      ).value;
      const experienceYears = document.getElementById(
        `${prefix}experienceYears`
      ).value;
      const hourlyRate = document.getElementById(`${prefix}hourlyRate`).value;

      document
        .getElementById(`${prefix}specialitiesError`)
        .classList.add("hidden");
      document
        .getElementById(`${prefix}experienceYearsError`)
        .classList.add("hidden");
      document
        .getElementById(`${prefix}hourlyRateError`)
        .classList.add("hidden");

      if (!specialities) {
        document.getElementById(`${prefix}specialitiesError`).textContent =
          "Specialities are required";
        document
          .getElementById(`${prefix}specialitiesError`)
          .classList.remove("hidden");
        isValid = false;
      }
      if (!experienceYears || experienceYears < 0) {
        document.getElementById(`${prefix}experienceYearsError`).textContent =
          "Valid years of experience required";
        document
          .getElementById(`${prefix}experienceYearsError`)
          .classList.remove("hidden");
        isValid = false;
      }
      if (!hourlyRate || hourlyRate < 0) {
        document.getElementById(`${prefix}hourlyRateError`).textContent =
          "Valid hourly rate required";
        document
          .getElementById(`${prefix}hourlyRateError`)
          .classList.remove("hidden");
        isValid = false;
      }

      if (isValid) {
        formData.specialities = specialities;
        formData.experienceYears = experienceYears;
        formData.hourlyRate = hourlyRate;
      }
    } else if (step === 3 && formData.userType === "MENTOR") {
      const prefix = "mentor-";
      const selfieData = document.getElementById(`${prefix}selfieData`).value;
      if (!selfieData) {
        document.getElementById(`${prefix}selfieError`).textContent =
          "Please capture a selfie before proceeding.";
        document
          .getElementById(`${prefix}selfieError`)
          .classList.remove("hidden");
        isValid = false;
      } else {
        document.getElementById(`${prefix}selfieError`).classList.add("hidden");
        formData.selfie = selfieData;
      }
    } else if (step === 4 && formData.userType === "MENTOR") {
      const prefix = "mentor-";
      const idDocument = document.getElementById(`${prefix}idDocument`)
        .files[0];
      if (!idDocument) {
        document.getElementById(`${prefix}idDocumentError`).textContent =
          "ID document is required";
        document
          .getElementById(`${prefix}idDocumentError`)
          .classList.remove("hidden");
        isValid = false;
      } else {
        document
          .getElementById(`${prefix}idDocumentError`)
          .classList.add("hidden");
        formData.idDocument = idDocument;
        formData.certificate = document.getElementById(
          `${prefix}certificate`
        ).files[0];
      }
    }
    return isValid;
  }

  function closeConfirmation(overlay) {
    event.preventDefault(); // Prevent form submission
    console.log("Closing confirmation overlay");

    // Close the entire overlay based on userType
    const overlayId =
      formData.userType === "MENTEE"
        ? "#menteeRegistrationOverlay"
        : "#mentorRegistrationOverlay";
    document.querySelector(overlayId).style.display = "none";

    // Optionally reset form and clear data
    const formId =
      formData.userType === "MENTEE"
        ? "menteeRegistrationForm"
        : "mentorRegistrationForm";
    const form = document.getElementById(formId);
    form.reset();
    localStorage.removeItem("userType");
    localStorage.removeItem("email");
    Object.keys(formData).forEach((key) => (formData[key] = ""));
    currentStep = 1;
  }

  function displayConfirmation() {
    removeControls();
    const today = new Date().toLocaleDateString();
    const details = `
    <h3 class="text-lg font-semibold mb-3 text-center uppercase bg-green-200 text-green-800">Registration Succeeded!</h3>
    <p class="mb-2 text-xs text-center">Thank you for registering with TutorFinder. A confirmation email has been sent to your provided email address. Please check your inbox and follow the instructions to verify your account.</p>
    <p class="mb-2 text-xs text-center">If you do not see the email, please check your spam or junk folder.</p>
    <p class="mb-2 text-xs text-center">We are excited to have you on board and look forward to helping you connect with mentors and mentees worldwide!</p>
    <div class="flex flex-col justify-end gap-2 mt-1 max-h-90 overflow-y-auto relative">
      <h1 class="text-md mb-0 text-center uppercase bg-yellow-200 text-yellow-800">Application Pending</h1>
      <div class="flex flex-col gap-0 w-fit">
        <span class="flex gap-4 text-sm">
          <p>User Type: </p>  
          <b>${formData.userType || "Unknown"}</b>
        </span>
        <span class="flex gap-4 text-sm">
          <p>Application Date: </p>
          <b>${today ?? "N/A"}</b>
        </span>
      </div>
      <h2 class="uppercase font-bold m-0 text-center">Personal Information</h2>
      <div class="flex justify-evenly">
        <div class="user-data">
          <p>Full Name: </p>
          <b>${formData.fullname}</b>
        </div>
        <div class="user-data">
          <p>Date of Birth: </p>
          <b>${formData.dob}</b>
        </div>
        <div class="user-data">
          <p>Phone Number: </p>
          <b>(+27) ${formData.phone}</b>
        </div>
        <div class="user-data">
          <p>Email: </p>
          <b>${formData.email}</b>
        </div>
      </div>
      ${
        formData.userType === "MENTEE"
          ? `
      <h2 class="uppercase font-bold m-0 text-center">Bio</h2>
      <div class="flex justify-around">
        <div class="user-data">
          <p>Education Level: </p>
          <b>${formData.educationLevel}</b>
        </div>
        <div class="user-data">
          <p>Tertiary Education</p>
          <b>${formData.tertiaryEducation ?? "N/A"}</b>
        </div>
      </div>
      `
          : `
      <h2 class="uppercase font-bold m-0 text-center">Documents</h2>
      <div class="flex justify-around min-h-30 h-30 bg-blue-200 p-2">
        <div class="rounded-xl bg-white shadow-md p-4 w-30 h-30 flex justify-center items-center relative">
          <i class="ph ph-file-pdf text-6xl"></i>
          <i class="ph-thin ph-check-circle bg-green-200 text-green-800 rounded-full p-2 text-md absolute z-10 -right-1 -bottom-1"></i>
          <b class='uppercase'>UPLOADED</b>
        </div>
        <div class="rounded-xl bg-white shadow-md p-4 w-30 h-30 flex justify-center items-center relative">
          <i class="ph ph-image text-6xl"></i>
          <i class="ph-thin ph-check-circle bg-green-200 text-green-800 rounded-full p-2 text-md absolute z-10 -right-1 -bottom-1"></i>
          <b class='uppercase'>CAPTURED</b>
        </div>
      </div>
      <h2 class="uppercase font-bold m-0 text-center">Experience</h2>
      <div class="flex justify-evenly">
        <div class="user-data">
          <p>Years of Experience: </p>
          <b>${formData.experienceYears}</b>
        </div>
        <div class="user-data">
          <p>Area of Expertise: </p>
          <b>${formData.specialities}</b>
        </div>
        <div class="user-data">
          <p>Hourly Rate: </p>
          <b>R ${formData.hourlyRate}</b>
        </div>
      </div>
      `
      }
      <div class="w-fit flex gap-3">
        <p> Status: </p>
        <b>Pending</b>
      </div>
      <button type="button" id="confirmationCloseBtn" class="absolute z-100 bottom-0 right-2 mr-2 mt-2 bg-red-400 p-1 rounded-sm">CLOSE <i class="ph ph-x-circle text-md"></i></button>
    </div>
  `;

    const confirmationDetails =
      formData.userType === "MENTEE"
        ? "confirmationMenteeDetails"
        : "confirmationMentorDetails";
    document.getElementById(confirmationDetails).innerHTML = details;
  }

  //? removes the navigation and progress bar on the confirmation page.
  function removeControls() {
    const progressbar = document.querySelector(".progress-bar");
    const navigationButtons = document.querySelector(".nav-btn");
    const exitButtons = document.querySelector(".cancelRegistrationBtn");
    progressbar.style.display = "none";
    progressbar.classList.add("hidden", "h-0");
    navigationButtons.style.display = "none";
    navigationButtons.classList.add("hidden", "h-0");
    exitButtons.style.display = "none";
    exitButtons.classList.add("hidden", "h-0");
  }

  async function initializeCamera() {
    const prefix = "mentor-";
    const video = document.getElementById(`${prefix}video`);
    const canvas = document.getElementById(`${prefix}canvas`);
    try {
      stream = await navigator.mediaDevices.getUserMedia({
        video: { facingMode: "user" },
      });
      video.srcObject = stream;
      video.style.display = "block";
      canvas.style.display = "none";
      document.getElementById("captureSelfie").style.display = "inline-block";
      document.getElementById("retakeSelfie").style.display = "none";
      document.getElementById(`${prefix}selfieData`).value = "";
    } catch (err) {
      document.getElementById(`${prefix}selfieError`).textContent =
        "Unable to access camera: " + err.message;
      document
        .getElementById(`${prefix}selfieError`)
        .classList.remove("hidden");
    }
  }

  document.getElementById("captureSelfie").addEventListener("click", () => {
    const prefix = "mentor-";
    const video = document.getElementById(`${prefix}video`);
    const canvas = document.getElementById(`${prefix}canvas`);
    const context = canvas.getContext("2d");
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    const imageData = canvas.toDataURL("image/jpeg");
    document.getElementById(`${prefix}selfieData`).value = imageData;
    formData.selfie = imageData;
    video.style.display = "none";
    canvas.style.display = "block";
    document.getElementById("captureSelfie").style.display = "none";
    document.getElementById("retakeSelfie").style.display = "inline-block";
    document.getElementById(`${prefix}selfieError`).classList.add("hidden");
  });

  document.getElementById("retakeSelfie").addEventListener("click", () => {
    const prefix = "mentor-";
    const video = document.getElementById(`${prefix}video`);
    const canvas = document.getElementById(`${prefix}canvas`);
    document.getElementById(`${prefix}selfieData`).value = "";
    formData.selfie = null;
    canvas.getContext("2d").clearRect(0, 0, canvas.width, canvas.height);
    video.style.display = "block";
    canvas.style.display = "none";
    document.getElementById("captureSelfie").style.display = "inline-block";
    document.getElementById("retakeSelfie").style.display = "none";
    document.getElementById(`${prefix}selfieError`).classList.add("hidden");
  });

  document.getElementById("next3Mentor").addEventListener("click", async () => {
    if (validateStep(3)) {
      formData.selfie = document.getElementById("mentor-selfieData").value;
      if (stream) {
        stream.getTracks().forEach((track) => track.stop());
        stream = null;
      }
      currentStep = 4;
      showStep(4);
    } else {
      Toastify({
        text: "Please capture a selfie before proceeding.",
        duration: 3000,
        gravity: "top",
        position: "right",
        style: { background: "#ef4444" },
      }).showToast();
    }
  });

  // Step 1 navigation for mentee
  document.getElementById("menteeNext1").addEventListener("click", async () => {
    if (formData.userType !== "MENTEE") return; // Prevent misfiring
    console.log("Mentee Next1 clicked, validating Step 1");
    if (validateStep(1)) {
      const loadingSpinner = document.getElementById(
        "mentee-loadingSpinnerStep1"
      );
      loadingSpinner.style.display = "inline-block";
      await new Promise((resolve) => setTimeout(resolve, 3000)); // Simulate async operation
      currentStep = 2;
      showStep(2);
      loadingSpinner.style.display = "none";
    } else {
      Toastify({
        text: "Please fill in all required fields correctly.",
        duration: 3000,
        gravity: "top",
        position: "right",
        style: { background: "#ef4444" },
      }).showToast();
    }
  });

  // Step 1 navigation for mentor
  document.getElementById("mentorNext1").addEventListener("click", async () => {
    if (formData.userType !== "MENTOR") return; // Prevent misfiring
    console.log("Mentor Next1 clicked, validating Step 1");
    if (validateStep(1)) {
      const loadingSpinner = document.getElementById(
        "mentor-loadingSpinnerStep1"
      );
      loadingSpinner.style.display = "inline-block";
      await new Promise((resolve) => setTimeout(resolve, 3000)); // Simulate async operation
      currentStep = 2;
      showStep(2);
      loadingSpinner.style.display = "none";
    } else {
      Toastify({
        text: "Please fill in all required fields correctly.",
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

  // Update submitMentee
  document.getElementById("submitMentee").addEventListener("click", () => {
    if (validateStep(2)) {
      currentStep = 3;
      showStep(3);
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

  // Add prev3Mentee
  document.getElementById("prev3Mentee").addEventListener("click", () => {
    currentStep = 2;
    showStep(2);
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

  // In finishMentor
  document.getElementById("finishMentor").addEventListener("click", () => {
    removeControls();
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
    closeOverlayStep(); // Fixed
    localStorage.removeItem("userType");
    localStorage.removeItem("email");
    Object.keys(formData).forEach((key) => (formData[key] = ""));
    currentStep = 1;
  });

  // Add finishMentee handler
  document.getElementById("finishMentee").addEventListener("click", () => {
    removeControls();
    console.log("Mentee Registration:", formData);
    Swal.fire({
      title: "Application Submitted",
      text: "Mentee application submitted! It is now pending review.",
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
    closeOverlayStep();
    localStorage.removeItem("userType");
    localStorage.removeItem("email");
    Object.keys(formData).forEach((key) => (formData[key] = ""));
    currentStep = 1;
  });

  const exitBtns = document.querySelectorAll(".cancelRegistrationBtn");
  exitBtns.forEach((btn) => {
    btn.addEventListener("click", () => {
      const formId =
        formData.userType === "MENTEE"
          ? "menteeRegistrationForm"
          : "mentorRegistrationForm";
      const form = document.getElementById(formId);
      form.setAttribute("novalidate", "novalidate"); // Disable validation
      form.reset();
      form.removeAttribute("novalidate"); // Restore after reset
      localStorage.removeItem("userType");
      localStorage.removeItem("email");
      closeOverlayStep();
      if (stream) {
        stream.getTracks().forEach((track) => track.stop());
        stream = null;
      }
      currentStep = 1; // Reset step
    });
  });

  function validateNumberInputs() {
    const numberInputs = document.querySelectorAll('input[type="number"]');
    numberInputs.forEach((input) => {
      input.addEventListener("input", (event) => {
        let value = event.target.value;
        if (
          event.target.id === "experienceYears" ||
          event.target.id === "mentor-experienceYears"
        ) {
          value = value.replace(/[^0-9]/g, "").slice(0, 2); // Max 2 digits, no decimals/negatives
        } else if (
          event.target.id === "hourlyRate" ||
          event.target.id === "mentor-hourlyRate"
        ) {
          value = value.replace(/[^0-9.]/g, "");
          if ((value.match(/\./g) || []).length > 1) value = value.slice(0, -1); // One decimal
        }
        event.target.value = value;

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
        if (!/[0-9.]/.test(char) && !event.ctrlKey && !event.metaKey) {
          event.preventDefault();
        }
      });
    });
  }

  validateNumberInputs();
});
