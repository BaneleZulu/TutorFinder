async function loadMentors() {
  try {
    const response = await fetch("http://localhost:5000/mentors");

    if (!response.ok) {
      throw new Error(`Server responded with status: ${response.status}`);
    }

    const data = await response.json(); // Convert response to JSON

    if (!data.mentors || data.mentors.length === 0) {
      console.warn("No mentor data found.");
      return;
    }

    const mentorView = document.querySelector(".mentor-view");
    const mentorImages = mentorView.querySelectorAll("img");
    const url = "/resources/images/";

    data.mentors.forEach((mentor, index) => {
      if (mentorImages[index]) {
        mentorImages[index].src = `${url}${mentor.profile_image}`;
        mentorImages[
          index
        ].alt = `${mentor.fullname} - Rating: ${mentor.average_rating}`;
      }
      // console.log(mentor.profile_image);
      // console.log(url, mentor.profile_image);
    });
  } catch (error) {
    console.error("Error loading mentors:", error);
  }
}

document.addEventListener("DOMContentLoaded", loadMentors);

async function loadPartnerOrganizations() {
  try {
    const response = await fetch("http://localhost:5000/partner_organizations");
    if (!response.ok) {
      throw new Error(`Server responded with status: ${response.status}`);
    }

    const data = await response.json();
    console.log("API Response:", data); // Debugging step

    // FIX: Access the array inside the object
    const partners = data.partner_organizations;

    if (!partners || !Array.isArray(partners)) {
      console.warn("No partner organizations data found or incorrect format.");
      return;
    }

    const scrollContent = document.querySelector(".scroll-content");
    scrollContent.innerHTML = ""; // Clear existing content

    partners.forEach((partner) => {
      const partnerDiv = document.createElement("div");
      partnerDiv.className = "partner";

      const img = document.createElement("img");
      img.src = partner.logo;
      img.alt = partner.organization;
      img.width = 100;
      img.height = 100;

      const name = document.createElement("p");
      name.textContent = partner.organization;

      partnerDiv.appendChild(img);
      partnerDiv.appendChild(name);
      scrollContent.appendChild(partnerDiv);
    });

    duplicateContent(); // Ensure infinite scrolling
  } catch (error) {
    console.error("Error loading partner organizations:", error);
  }
}
function duplicateContent() {
  const scrollContent = document.querySelector(".scroll-content");
  const container = document.querySelector(".scroll-container");
  const clones = scrollContent.cloneNode(true);
  container.appendChild(clones);
}

document.addEventListener("DOMContentLoaded", loadPartnerOrganizations);
