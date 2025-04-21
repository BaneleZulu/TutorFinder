// Selecting all the tab buttons
const tabButtons = Array.from(document.querySelectorAll("[role=tab]"));

// Initialize by adding active-tab class to the second button (index 1)
tabButtons[0].classList.add("active-tab");

// Adding click event listener to each tab button
tabButtons.forEach((element) => {
  element.addEventListener("click", () => {
    // Remove active-tab class from all buttons
    tabButtons.forEach((btn) => btn.classList.remove("active-tab"));

    // Add active-tab class to the clicked button
    element.classList.add("active-tab");
  });
});

// ? **************************** TABS FUNCTIONALITY
function openTab(evt, tabName) {
  var i, tab_content, tab_links;
  tab_content = document.getElementsByClassName("tabContent");
  for (i = 0; i < tab_content.length; i++) {
    tab_content[i].style.display = "none";
  }
  tab_links = document.getElementsByClassName("tab");
  for (i = 0; i < tab_links.length; i++) {
    tab_links[i].className = tab_links[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}

// ? **************************** PARALLAX EFFECT STYLE
let text = document.getElementById("hometxt");
let leaf = document.getElementById("leaf");
let hill1 = document.getElementById("hill1");
let hill4 = document.getElementById("hill4");
let hill5 = document.getElementById("hill5");

window.addEventListener("scroll", () => {
  let value = window.scrollY;

  text.style.marginTop = value * 2.5 + "px";
  leaf.style.top = value * -1.5 + "px";
  leaf.style.left = value * 1.5 + "px";
  hill5.style.left = value * 1.5 + "px";
  hill4.style.left = value * -1.5 + "px";
  hill1.style.top = value * 0.7 + "px";

  text.style.visibility = Math.round(value) > 400 ? "hidden" : "visible";
  hill5.style.visibility = Math.round(value) > 500 ? "hidden" : "visible";
});

// ? **************************** HOW IT WORKS
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

// ? **************************** TABS FUNCTIONALITY
