//? LOADS DATA TO QUICK LINK PAGES ON FOOTER

async function loadsFAQData() {
  try {
    const response = await fetch(`http://localhost:5000/faq?type`);

    if (!response.ok) {
      throw new Error(
        `Server responded with status: ${response.status} ${response.statusText}`
      );
    }

    const data = await response.json();
    console.log("FAQ Response:", data);

    const faqList = data.faqList;
    if (!faqList || !Array.isArray(faqList)) {
      console.warn("No FAQs data found or incorrect format.");
      return;
    }

    const faqParent = document.querySelector(".faq-list");
  } catch (error) {
    console.error("Error loading FAQs:", error);
  }
}

document.addEventListener("DOMContentLoaded", loadsFAQData);
