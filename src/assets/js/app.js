// FETCH TOP 5 MENTORS
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

// FETCH PARTNER ORGANIZATIONS
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

// FETCH BEST RATED MENTORS
async function loadBestRatedMentors() {
  try {
    const response = await fetch("http://localhost:5000/best_rated_mentors");
    if (!response.ok) {
      throw new Error(`Server responded with status: ${response.status}`);
    }

    const data = await response.json();
    console.log("API Response:", data);

    const bestRatedMentors = data.mentors;
    if (!bestRatedMentors || !Array.isArray(bestRatedMentors)) {
      console.warn("No best-rated mentors data found or incorrect format.");
      return;
    }

    const url = "/resources/images/";
    const topRentedBanner = "Top Rated";
    // Select the existing carousel element
    const carousel = document.querySelector(".carousel");

    // Clear previous content (optional)
    carousel.innerHTML = "";

    // Loop through API results and dynamically create mentor items
    bestRatedMentors.forEach((mentor) => {
      const mentorItem = document.createElement("li");

      const mentorName = document.createElement("h2");
      mentorName.textContent = mentor.fullname;

      const verifiedIcon = document.createElement("i");
      verifiedIcon.className = "ph-fill ph-seal-check";
      verifiedIcon.style.color = "#1DCD9F";

      // set top rated banner based on average rating
      if (mentor.average_rating >= 4) {
        const topRatedTxt = document.createElement("b");
        topRatedTxt.className = "ratingBanner";
        topRatedTxt.textContent = topRentedBanner;
        mentorItem.appendChild(topRatedTxt);
      }

      const mentorDescription = document.createElement("p");
      mentorDescription.textContent = `Experience: ${mentor.experience_years} years | Rating: ${mentor.average_rating}`;

      const mentorImage = document.createElement("img");
      mentorImage.src = `${url}${mentor.profile_image}`;
      mentorImage.alt = mentor.fullname;
      mentorImage.width = 100;
      mentorImage.height = 100;

      // Append elements into the list item
      mentorItem.appendChild(mentorImage);
      mentorItem.appendChild(mentorName);
      mentorName.appendChild(verifiedIcon);
      mentorItem.appendChild(mentorDescription);

      // Append mentor item into the carousel
      carousel.appendChild(mentorItem);
    });
  } catch (error) {
    console.error("Error loading mentors:", error);
  }
}

// Load data when the page is fully loaded
document.addEventListener("DOMContentLoaded", loadBestRatedMentors);
