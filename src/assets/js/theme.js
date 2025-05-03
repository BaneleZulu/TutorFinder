const modeSwitch = document.getElementById("modeSwitch");
const modeIcon = document.getElementById("modeIcon");
const body = document.body;
const modeLabel = document.querySelector(".mode-label");

// Helper function to set the theme
const setTheme = (theme) => {
  if (theme === "dark-mode") {
    body.classList.remove("light-mode");
    body.classList.add("dark-mode");
    modeSwitch.checked = true;
    modeLabel.textContent = "Dark Mode";
    modeIcon.className = "ph ph-moon"; // Toggle to moon icon
  } else {
    body.classList.remove("dark-mode");
    body.classList.add("light-mode");
    modeSwitch.checked = false;
    modeLabel.textContent = "Light Mode";
    modeIcon.className = "ph ph-sun"; // Toggle to sun icon
  }
  localStorage.setItem("theme", theme); // Save theme to localStorage
};

// Load theme from localStorage on page load
document.addEventListener("DOMContentLoaded", () => {
  const savedTheme = localStorage.getItem("theme") || "light-mode"; // Default to light-mode
  setTheme(savedTheme);
});

// Event listener for toggling light/dark mode
modeSwitch.addEventListener("change", () => {
  const theme = modeSwitch.checked ? "dark-mode" : "light-mode";
  setTheme(theme);
});
