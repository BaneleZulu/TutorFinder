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
    if (!faqParent) {
      console.log("Parent element not found");
      return;
    }

    // clears current/default content
    faqParent.innerHTML = "";

    //dynamically create FAQs on the markup
    faqList.forEach((faq) => {
      const faqItem = document.createElement("div");
      faqItem.className = "accordion md-4";
      faqItem.innerHTML = `
        <div class="accordion-header bg-[#f84650] p-4 rounded-t-lg">
        <h4 class="text-lg font-semibold">${faq.question}</h4>
        </div>
        <div class="accordion-content bg-white p-1 rounded-b-lg">
            <p class="text-gray-600 p-4">${faq.answer}</p>
        </div>`;

      faqParent.appendChild(faqItem);
    });
  } catch (error) {
    console.error("Error loading FAQs:", error);
  }
}
document.addEventListener("DOMContentLoaded", loadsFAQData);

async function loadsBlogData() {
  try {
    const response = await fetch(`http://localhost:5000/blogs`);
    if (!response.ok) {
      throw new Error(
        `Server responded with status: ${response.status} ${response.statusText}`
      );
    }

    const data = await response.json();
    console.log("Blog Response:", data);

    const blog = data.blogList;
    if (!blog) {
      console.warn("No blog data found.");
      return;
    }

    const blogParent = document.querySelector(".card.blog-card");
    if (!blogParent) {
      console.log("Parent element not found");
      return;
    }

    // Clear current/default content
    blogParent.innerHTML = "";

    const blogImg = document.createElement("img");
    blogImg.className = "w-full h-64 object-cover rounded-lg mb-4";
    const alterativeImgURL = "/resources/images/default.jpg";
    const blogHeader = document.createElement("h4");
    blogHeader.className = "ext-2xl font-semibold mb-2";
    const subHeader = document.createElement("p");
    subHeader.className = "mb-2";
    const blogContent = document.createElement("p");
    blogContent.className = "mb-4";
    const blogDate = document.createElement("i");
    blogDate.className = "text-gray-300 text-italic";

    blogHeader.textContent = blog.header;
    subHeader.textContent = blog.sub_header;
    blogContent.textContent = blog.content;
    blogDate.textContent = blog.date.subString(0, 10);

    // Handle BASE64 image conversion
    if (blog.image_base64) {
      // Convert BASE64 to displayable image
      blogImg.src = `data:image/jpeg;base64,${blog.image_base64}`;
      blogImg.alt = blog.header || "Blog image";
      blogImg.style.maxWidth = "100%";
      blogImg.style.height = "auto";

      // Optional: Add error handling for image loading
      blogImg.onerror = function () {
        console.error("Failed to load image");
        this.src = alterativeImgURL;
        this.alt = "Alternative image";
        this.style.display = "block";
        this.style.maxWidth = "100%";
        this.style.height = "auto";
      };
    } else {
      // Hide image if no BASE64 data
      blogImg.style.display = "none";
    }
    setImageFromBase64(blogImg, blog.image);

    // Append elements to parent
    blogParent.appendChild(blogImg);
    blogParent.appendChild(blogHeader);
    blogParent.appendChild(subHeader);
    blogParent.appendChild(blogContent);
    blogParent.appendChild(blogDate);
  } catch (error) {
    console.error("Failed to fetch blogs:", error);
  }
}

document.addEventListener("DOMContentLoaded", loadsBlogData);

// Enhanced image handling function
function setImageFromBase64(imgElement, base64Data, mimeType = "image/jpeg") {
  if (!base64Data) {
    imgElement.style.display = "none";
    return;
  }

  // Auto-detect image type if not specified
  let detectedType = mimeType;
  if (base64Data.startsWith("/9j/")) detectedType = "image/jpeg";
  else if (base64Data.startsWith("iVBORw0KGgo")) detectedType = "image/png";
  else if (base64Data.startsWith("R0lGOD")) detectedType = "image/gif";

  imgElement.src = `data:${detectedType};base64,${base64Data}`;
  imgElement.alt = "Blog image";
  imgElement.style.maxWidth = "100%";
  imgElement.style.height = "auto";

  imgElement.onerror = function () {
    console.error("Failed to load image");
    this.style.display = "none";
  };
}

async function loadMostUpvotedPosts() {
  try {
    const response = await fetch(`http://localhost:5000/posts`);
    if (!response.ok) {
      throw new Error(
        `Server responded with
        status: ${response.status} ${response.statusText}`
      );
    }

    const data = await response.json();
    console.log("Posts Response:", data);

    const posts = data.topPosts;
    if (!posts || !Array.isArray(posts)) {
      console.warn("No posts data found or incorrect format.");
      return;
    }

    const postsParent = document.getElementById("post-container");
    if (!postsParent) {
      console.log("Parent element not found");
      return;
    }

    //clears existing/default markup
    postsParent.innerHTML = "";

    topPosts.forEach((post) => {
      const postItem = document.createElement("div");
      postItem.className = "card bg-white p-6 rounded-lg shadow-md post";
      postItem.innerHTML = `
              <img src="/resources/others/${post.image_url}" alt="Post: ${post.image_url}" class="w-full h-40 object-cover rounded-lg mb-4">
              <h4 class="text-xl font-semibold mb-2">${post.user_role}</h4>
              <p class="mb-2">By ${post.username} | ${post.created_at}</p>
              <p class="mb-4">${post.content}</p>
              <span class="flex items-center justify-between gap-2">
                  <p>Upvotes: <i class="ph-fill ph-thumbs-up ml-2"></i>${post.upvotes}</p>
                  <p>Downvotes: <i class="ph-fill ph-thumbs-down ml-2"></i>${post.downvotes}</p>
              </span>
      `;
      postsParent.appendChild(post);
    });
  } catch (error) {
    console.error("Error loading posts:", error);
  }
}

document.addEventListener("DOMContentLoaded", loadMostUpvotedPosts);
