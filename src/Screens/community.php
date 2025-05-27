<!DOCTYPE html>
<html lang="en">

<?php
require($_SERVER['DOCUMENT_ROOT'] . '/includes/header.html');
?>

<body class="community-body font-sans">
    <?php include("../util/header.php"); ?>

    <section class="bg-[#f84650] text-white py-20 mt-10">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-8xl md:text-20xl font-bold mb-4">Join the TutorFinder Community</h2>
            <p class="text-lg md:text-xl max-w-3xl mx-auto mb-6">
                Connect with passionate mentors and learners in a supportive, vibrant community dedicated to deep learning and growth. Be part of something bigger!
            </p>
            <a href="#get-involved" class="bg-white text-[#f84650] px-6 py-3 rounded-lg font-semibold hover:bg-gray-200">
                Get Involved
                <i class="ph ph-thin ph-arrow-right ml-2 text-[#f84650] text-1xl"></i>
            </a>

        </div>
    </section>

    <section class="py-12">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-center mb-8">Our Community’s Heart</h3>
            <div class="max-w-7xl mx-auto text-center">
                <p class="text-gray-600 mb-4">
                    At TutorFinder, our community is built on collaboration, curiosity, and a shared passion for learning. Whether you’re a mentor sharing expertise or a mentee chasing goals, you’ll find a welcoming space to connect, grow, and inspire.
                </p>
                <p class="text-gray-600">
                    From online forums to local meetups, our community thrives on meaningful interactions that foster knowledge and friendship.
                </p>
            </div>
        </div>
    </section>

    <section class="py-12">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-center mb-8">Ways to Engage</h3>
            <div class="max-w-7xl mx-auto">
                <div class="accordion mb-4">
                    <div class="accordion-header bg-[#f84650] p-4 rounded-t-lg">
                        <h4 class="text-lg font-semibold">Join Our Forums</h4>
                    </div>
                    <div class="accordion-content bg-white p-1 rounded-b-lg">
                        <p class="text-gray-600 p-4">
                            Participate in online discussions, ask questions, and share tips with mentors and mentees worldwide.
                        </p>
                    </div>
                </div>
                <div class="accordion mb-4">
                    <div class="accordion-header bg-[#f84650] p-4 rounded-t-lg">
                        <h4 class="text-lg font-semibold">Attend Events</h4>
                    </div>
                    <div class="accordion-content bg-white p-1 rounded-b-lg">
                        <p class="text-gray-600 p-4">
                            Join webinars, workshops, and local meetups to learn new skills and network with the community.
                        </p>
                    </div>
                </div>
                <div class="accordion mb-4">
                    <div class="accordion-header bg-[#f84650] p-4 rounded-t-lg">
                        <h4 class="text-lg font-semibold">Form Study Groups</h4>
                    </div>
                    <div class="accordion-content bg-white p-1 rounded-b-lg">
                        <p class="text-gray-600 p-4">
                            Collaborate with peers in group sessions to tackle challenges and achieve goals together.
                        </p>
                    </div>
                </div>
                <div class="accordion mb-4">
                    <div class="accordion-header bg-[#f84650] p-4 rounded-t-lg">
                        <h4 class="text-lg font-semibold">Share Your Story</h4>
                    </div>
                    <div class="accordion-content bg-white p-1 rounded-b-lg">
                        <p class="text-gray-600 p-4">
                            Contribute to our blog or newsletter by sharing your learning journey or mentoring experience.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-center mb-8">Community Success Stories</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="card bg-gray-100 p-6 rounded-lg shadow-md text-center">
                    <p class="text-gray-600 italic mb-4">
                        “Through TutorFinder’s community, I found a mentor who helped me ace my exams and a study group that became my friends.”
                    </p>
                    <h4 class="text-lg font-semibold">Sophie R., Mentee</h4>
                </div>
                <div class="card bg-gray-100 p-6 rounded-lg shadow-md text-center">
                    <p class="text-gray-600 italic mb-4">
                        “Mentoring on TutorFinder connected me with learners who inspired me to grow as an educator.”
                    </p>
                    <h4 class="text-lg font-semibold">Mark T., Mentor</h4>
                </div>
                <div class="card bg-gray-100 p-6 rounded-lg shadow-md text-center">
                    <p class="text-gray-600 italic mb-4">
                        “The webinars and forums gave me new perspectives and skills I never expected to gain.”
                    </p>
                    <h4 class="text-lg font-semibold">Ella K., Mentee</h4>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-center mb-8">Upcoming Community Events</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
                <div class="card bg-white p-6 rounded-lg shadow-md">
                    <h4 class="text-lg font-semibold mb-2">Coding Bootcamp Webinar</h4>
                    <p class="text-gray-600 mb-2">June 10, 2025 | 7:00 PM</p>
                    <p class="text-gray-600">
                        Learn Python basics from expert mentors in this interactive online session.
                    </p>
                    <a href="join.html" class="text-blue-600 hover:underline mt-2 inline-block">Register Now</a>
                </div>
                <div class="card bg-white p-6 rounded-lg shadow-md">
                    <h4 class="text-lg font-semibold mb-2">Math Mastery Workshop</h4>
                    <p class="text-gray-600 mb-2">June 15, 2025 | 3:00 PM</p>
                    <p class="text-gray-600">
                        Join our community for a hands-on workshop tackling algebra challenges.
                    </p>
                    <a href="join.html" class="text-blue-600 hover:underline mt-2 inline-block">Register Now</a>
                </div>
            </div>
        </div>
    </section>

    <section id="get-involved" class="py-12 bg-[#f84650] text-white text-center">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold mb-4">Be Part of Our Community</h3>
            <p class="text-lg mb-6">
                Whether you’re a mentor, mentee, or lifelong learner, there’s a place for you in the TutorFinder community. Sign up today to connect, learn, and grow together!
            </p>
            <a href="join.html" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-200">
                Join Now
            </a>
        </div>
    </section>


    <!-- Footer -->
    <?php include("../util/footer.php"); ?>
    <script src="../assets/js/theme.js"></script>

    <style>
        section {
            background: var(--clr-body-bg);
        }

        .card {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .accordion-header {
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .accordion-header:hover {
            background-color: #e5e7eb;
        }

        .accordion-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .accordion-content.open {
            max-height: 200px;
        }

        .tab {
            transition: background-color 0.2s;
        }

        .tab.active {
            background-color: #3b82f6;
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

        // Accordion functionality
        function setupAccordions() {
            document.querySelectorAll('.accordion-header').forEach(header => {
                header.addEventListener('click', () => {
                    const content = header.nextElementSibling;
                    const isOpen = content.classList.contains('open');
                    document.querySelectorAll('.accordion-content').forEach(c => {
                        c.classList.remove('open');
                        c.style.maxHeight = '0';
                    });
                    if (!isOpen) {
                        content.classList.add('open');
                        content.style.maxHeight = content.scrollHeight + 'px';
                    }
                });
            });
        }

        setupAccordions();
    </script>
</body>

</html>