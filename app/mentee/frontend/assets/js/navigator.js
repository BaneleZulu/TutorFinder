document.addEventListener("DOMContentLoaded", function () {
  const menuItems = document.querySelectorAll(".menu > ul > li");
  const menuBtn = document.querySelector(".menu-btn");
  const sidebar = document.querySelector(".sidebar");
  const sections = document.querySelector(".sections");
  const menuItemsLinks = document.querySelectorAll(".menu > ul > li > a");
  const subMenuLinks = document.querySelectorAll(".sub-menu > li > a");
  // Function to load the current screen based on the URL
  function loadCurrentScreen() {
    const hash = window.location.hash; // Get the current hash
    const screen = hash ? hash.substring(1) + ".php" : "dashboard.php"; // Default to dashboard if no hash
    loadScreen(screen);
  }
  // Function to handle menu item click
  function handleMenuItemClick(e) {
    e.preventDefault(); // Prevent default link behavior
    // Remove 'active' class from other menu items
    menuItems.forEach((item) => item.classList.remove("active"));
    // Toggle 'active' class for the clicked menu item
    this.parentElement.classList.add("active");
    // Toggle sub-menu visibility
    const subMenu = this.nextElementSibling;
    if (subMenu && subMenu.classList.contains("sub-menu")) {
      subMenu.style.display =
        subMenu.style.display === "block" ? "none" : "block";
    }
    // Close other sub-menus
    menuItems.forEach((item) => {
      if (item !== this.parentElement) {
        const otherSubMenu = item.querySelector(".sub-menu");
        if (otherSubMenu) {
          otherSubMenu.style.display = "none";
        }
      }
    });
    // Load the selected screen via AJAX if it's a main menu item
    if (this.getAttribute("href") && !this.nextElementSibling) {
      const screen = this.getAttribute("href").substring(1) + ".php";
      loadScreen(screen);
    }
  }
  // Function to handle sub-menu item click
  function handleSubMenuItemClick(e) {
    e.preventDefault(); // Prevent default link behavior
    // Load the selected sub-screen via AJAX
    if (this.getAttribute("href")) {
      const subScreen = this.getAttribute("href").substring(1) + ".php";
      loadScreen(subScreen);
    }
  }
  // Add click event listener to each menu item link
  menuItemsLinks.forEach((menuItem) => {
    menuItem.addEventListener("click", handleMenuItemClick);
  });
  // Add click event listener to each sub-menu item link
  subMenuLinks.forEach((subMenuItem) => {
    subMenuItem.addEventListener("click", handleSubMenuItemClick);
  });
  // Toggle sidebar visibility
  menuBtn.addEventListener("click", function () {
    sidebar.classList.toggle("active");
    sections.classList.toggle("active");
  });
  // Load the current screen on page load
  loadCurrentScreen();
  // Function to load screen via AJAX
  function loadScreen(screen) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `../screens/${screen}`, true);
    xhr.onload = function () {
      if (xhr.status === 200) {
        sections.innerHTML = xhr.responseText;
        // Initialize charts after AJAX load if applicable
        if (typeof initializeCharts === "function") {
          initializeCharts();
        }
        // Update the URL hash without reloading the page
        history.pushState(null, "", `#${screen.split(".")[0]}`);
      } else {
        sections.innerHTML = "<p>Screen not found.</p>";
      }
    };
    xhr.send();
  }
  // Handle back/forward navigation
  window.onpopstate = loadCurrentScreen;
});
//? Sign out function
function logout() {
  window.location.href = "/logout.php";
}
