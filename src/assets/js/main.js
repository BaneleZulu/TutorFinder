//profile update/edit overlay tab mechanism
function openTab(event, tabId) {
  // Hide all tab contents
  const tabContents = document.querySelectorAll(".tab-content");
  tabContents.forEach((content) => (content.style.display = "none"));

  // Remove active class from all tab buttons
  const tabButtons = document.querySelectorAll(".tab-btn");
  tabButtons.forEach((btn) => btn.classList.remove("active"));

  // Show the selected tab content and add active class to the button
  document.getElementById(tabId).style.display = "block";
  event.currentTarget.classList.add("active");
}

/*//? SITE OVERVIEW *********************************************** */
const steps = document.querySelectorAll(".process-step");
const descriptions = document.querySelectorAll(".step-description");

// Show the description for the first step by default
descriptions[0].style.display = "block";
steps[0].classList.add("active");

steps.forEach((step) => {
  step.addEventListener("click", () => {
    const stepId = step.getAttribute("data-step");

    // Hide all descriptions
    descriptions.forEach((desc) => {
      desc.style.display = "none";
    });

    // Show the hovered step's description
    document.getElementById(stepId).style.display = "block";

    // Remove active class from all steps
    steps.forEach((s) => s.classList.remove("active"));

    // Add active class to the hovered step
    step.classList.add("active");
    steps.classList.add("active");
  });
});
/*//? TOP MENTORS CAROUSEL  *********************************************** */
document.addEventListener("DOMContentLoaded", () => {
  const carousel = document.querySelector(".carousel");
  const scrollLeftBtn = document.getElementById("scroll-left");
  const scrollRightBtn = document.getElementById("scroll-right");

  if (!carousel || !scrollLeftBtn || !scrollRightBtn) {
    console.warn("Carousel or scroll buttons not found.");
    return;
  }

  // Ensure the carousel has content
  const observer = new MutationObserver(() => {
    const scrollAmount = carousel.clientWidth / 5; // Adjusted calculation

    scrollLeftBtn.addEventListener("click", () => {
      carousel.scrollBy({ left: -scrollAmount, behavior: "smooth" });
    });

    scrollRightBtn.addEventListener("click", () => {
      carousel.scrollBy({ left: scrollAmount, behavior: "smooth" });
    });

    // Disconnect observer after first mutation detection
    observer.disconnect();
  });

  observer.observe(carousel, { childList: true });
});

/*//? HOVER CARDS  *********************************************** */

document.getElementById("cards").onmousemove = (e) => {
  console.log("moving");
  for (const card of document.getElementsByClassName("card")) {
    const rect = card.getBoundingClientRect(),
      x = e.clientX - rect.left,
      y = e.clientY - rect.top;

    card.style.setProperty("--mouse-x", `${x}px`);
    card.style.setProperty("--mouse-y", `${y}px`);
  }
};

// ? RENDER SIGN IN OVERLAY
// ? global overlay opener function.
//? @{param} : overlay wrapper id or class to open.
function openOverlay(overlay) {
  document.querySelector(overlay).style.display = "flex";
}
// ? global overlay closer function.
//? @{param} : overlay wrapper id or class to close.
function closeOverlay(overlay) {
  document.querySelector(overlay).style.display = "none";
}

const signupOverlay = document.getElementById("signupOverlay");
const signinOverlay = document.getElementById("loginOverlay");
const registerOverlay = document.getElementById("registrationOverlay");

document.getElementById("loginBtnOvl").addEventListener("click", () => {
  signinOverlay.style.display = "flex";
  signupOverlay.style.display = "none";
  registerOverlay.style.display = "none";
});

document.getElementById("signupBtnOvl").addEventListener("click", () => {
  signupOverlay.style.display = "flex";
  signinOverlay.style.display = "none";
  registerOverlay.style.display = "none";
});

//? REGISTRATION PROCESS OVERLAY
document.getElementById("registerBtn").addEventListener("click", (event) => {
  event.preventDefault();
  registerOverlay.style.display = "flex";
  signupOverlay.style.display = "none";
});
