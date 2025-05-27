<!DOCTYPE html>
<html lang="en">

<?php
require($_SERVER['DOCUMENT_ROOT'] . '/includes/header.html');
?>

<body class="blog bg-gray-100 font-sans">
    <?php include('../util/header.php'); ?>

    <section class="bg-[#f84650] text-white py-20 mt-10">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-8xl md:text-20xl font-bold mb-4">TutorFinder Blog</h2>
            <p class="text-lg md:text-xl max-w-3xl mx-auto mb-6">
                Discover learning tips, mentor spotlights, and community stories to inspire your educational journey. Stay updated with TutorFinder’s latest insights!
            </p>
            <a href="#recent-posts"
                class="bg-white text-[#f84650] px-6 py-3 rounded-lg font-semibold hover:bg-gray-200">
                Explore Posts
                <i class="ph ph-thin ph-arrow-right ml-2 text-[#f84650] text-1xl"></i>
            </a>
        </div>
    </section>

    <section class="py-12">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-center mb-8">Featured Post</h3>
            <div class="max-w-8xl mx-auto ">
                <div class="card mx-auto p-6 rounded-lg shadow-md">
                    <img src="/resources/others/logo.png" alt="Featured Post" class="w-full h-64 object-cover rounded-lg mb-4">
                    <h4 class="text-2xl font-semibold mb-2">5 Tips to Master Coding as a Beginner</h4>
                    <p class="mb-2">By Alex Johnson | May 20, 2025</p>
                    <p class="mb-4">
                        Starting your coding journey? Learn essential tips to stay motivated, practice effectively, and avoid common pitfalls in this beginner’s guide.
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, pariatur cupiditate ipsa tempore magni velit!
                        Obcaecati asperiores reiciendis quos deleniti, repellat, perferendis aut,
                        nesciunt impedit iusto a ipsa. Excepturi, ullam!
                    </p>
                    <a href="blog-post.html" class="text-blue-600 hover:underline">Read More</a>
                </div>
            </div>
        </div>
    </section>

    <section id="recent-posts" class="py-12">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-center mb-8">Recent Posts</h3>
            <div class="flex flex-wrap justify-center gap-4 mb-6">
                <button class="category-btn px-4 py-2 rounded-lg bg-gray-200 text-gray-800 font-semibold hover:bg-[#f84650] hover:text-white active" data-category="all">All</button>
                <button class="category-btn px-4 py-2 rounded-lg bg-gray-200 text-gray-800 font-semibold hover:bg-[#f84650] hover:text-white" data-category="learning-tips">Learning Tips</button>
                <button class="category-btn px-4 py-2 rounded-lg bg-gray-200 text-gray-800 font-semibold hover:bg-[#f84650] hover:text-white" data-category="mentor-spotlights">Mentor Spotlights</button>
                <button class="category-btn px-4 py-2 rounded-lg bg-gray-200 text-gray-800 font-semibold hover:bg-[#f84650] hover:text-white" data-category="community-stories">Community Stories</button>
            </div>
            <div id="posts-container" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="card bg-white p-6 rounded-lg shadow-md post" data-category="learning-tips">
                    <img src="/resources/others/logo.png" alt="Post" class="w-full h-40 object-cover rounded-lg mb-4">
                    <h4 class="text-xl font-semibold mb-2">How to Stay Focused During Study Sessions</h4>
                    <p class="mb-2">By Maria Lee | May 15, 2025</p>
                    <p class="mb-4">
                        Discover practical strategies to boost concentration and make the most of your study time.
                    </p>
                    <a href="blog-post.html" class="text-blue-600 hover:underline">Read More</a>
                </div>
                <div class="card bg-white p-6 rounded-lg shadow-md post" data-category="mentor-spotlights">
                    <img src="https://via.placeholder.com/400x200" alt="Post" class="w-full h-40 object-cover rounded-lg mb-4">
                    <h4 class="text-xl font-semibold mb-2">Meet Our Mentor: Sam Carter</h4>
                    <p class="mb-2">By TutorFinder Team | May 10, 2025</p>
                    <p class="mb-4">
                        Learn about Sam’s journey as a physics mentor and his passion for hands-on learning.
                    </p>
                    <a href="blog-post.html" class="text-blue-600 hover:underline">Read More</a>
                </div>
                <div class="card bg-white p-6 rounded-lg shadow-md post" data-category="community-stories">
                    <img src="https://via.placeholder.com/400x200" alt="Post" class="w-full h-40 object-cover rounded-lg mb-4">
                    <h4 class="text-xl font-semibold mb-2">How TutorFinder Changed My Career</h4>
                    <p class="mb-2">By Emma R. | May 5, 2025</p>
                    <p class="mb-4">
                        A mentee shares her story of gaining confidence and skills through our community.
                    </p>
                    <a href="blog-post.html" class="text-blue-600 hover:underline">Read More</a>
                </div>
                <div class="card bg-white p-6 rounded-lg shadow-md post" data-category="learning-tips">
                    <img src="https://via.placeholder.com/400x200" alt="Post" class="w-full h-40 object-cover rounded-lg mb-4">
                    <h4 class="text-xl font-semibold mb-2">Top 10 Math Hacks for Students</h4>
                    <p class="mb-2">By Maria Lee | April 30, 2025</p>
                    <p class="mb-4">
                        Simplify complex math problems with these clever tricks and shortcuts.
                    </p>
                    <a href="blog-post.html" class="text-blue-600 hover:underline">Read More</a>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12">
        <div class="container mx-auto px-4 text-center">
            <h3 class="text-3xl font-bold mb-4">Want to Share Your Story?</h3>
            <p class="text-lg mb-6">
                Join TutorFinder to contribute to our blog, connect with our community, or start your learning journey today!
            </p>
            <a href="join.html" class="bg-[#f84650] text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700">
                Join Now
            </a>
        </div>
    </section>


    <!-- Footer -->
    <?php include("../util/footer.php"); ?>
    <script src="../assets/js/theme.js"></script>
    <style>
        body.blog .card {
            background: var(--clr-nav-bg);
            transition: transform 0.3s, box-shadow 0.3s;
            width: 90%;
            margin: auto;
            min-height: 30rem;
        }


        section {
            background: var(--clr-body-bg);
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .category-btn {
            transition: background-color 0.2s;
        }

        .category-btn.active {
            background: var(--clr-primary);
            color: white;
        }
    </style>



    <script>
        // Smooth scroll for in-page links
        document.querySelectorAll('a[href*="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const targetId = this.getAttribute('href').split('#')[1];
                if (targetId) {
                    const target = document.getElementById(targetId);
                    if (target) {
                        e.preventDefault();
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                }
            });
        });

        // Category filter functionality
        document.querySelectorAll('.category-btn').forEach(button => {
            button.addEventListener('click', () => {
                document.querySelectorAll('.category-btn').forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');

                const category = button.dataset.category;
                const posts = document.querySelectorAll('.post');

                posts.forEach(post => {
                    if (category === 'all' || post.dataset.category === category) {
                        post.style.display = 'block';
                    } else {
                        post.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>

</html>