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
      console.log(mentor.profile_image);
      if (mentorImages[index]) {
          mentorImages[index].src = `${url}${mentor.profile_image}`;
          mentorImages[
              index
            ].alt = `${mentor.fullname} - Rating: ${mentor.average_rating}`;
        }
        console.log(url, mentor.profile_image);
    });
  } catch (error) {
    console.error("Error loading mentors:", error);
  }
}

document.addEventListener("DOMContentLoaded", loadMentors);
