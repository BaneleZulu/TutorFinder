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
