<!DOCTYPE html>
<html lang="en">

<?php
require($_SERVER['DOCUMENT_ROOT'] . '/includes/header.html');
?>

<body class="bg-gray-100 font-sans">
    <?php include('../util/header.php'); ?>
    <!-- Hero Section -->
    <section class="banner bg-[#f84650] text-white py-20 mt-10">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-8xl md:text-20xl font-bold mb-4">About TutorFinder</h2>
            <p class="text-lg md:text-xl max-w-3xl mx-auto mb-6">
                At TutorFinder, we believe in the power of learning through understanding. Our mission is to connect passionate mentors with eager learners, fostering deep knowledge through personalized, affordable, and flexible learning experiences.
            </p>
            <a href="#join" class="bg-white text-[#f84650] px-6 py-3 rounded-lg font-semibold hover:bg-gray-200">
                Join Our Community
                <i class="ph ph-thin ph-arrow-right ml-2 text-[#f84650] text-1xl"></i>
            </a>
        </div>
    </section>

    <!-- Our Mission Section -->
    <section class="py-12 ">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-center mb-8 underline">Our Mission</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="text-blue-600 text-4xl mb-4">📚</div>
                    <h4 class="text-xl font-semibold mb-2">Deep Learning</h4>
                    <p class="text-gray-600">
                        We prioritize understanding over quick fixes, helping learners grasp the logic and reasoning behind their subjects.
                    </p>
                </div>
                <div class="text-center">
                    <div class="text-blue-600 text-4xl mb-4">💸</div>
                    <h4 class="text-xl font-semibold mb-2">Affordability</h4>
                    <p class="text-gray-600">
                        Flexible subscription plans and discounts make quality education accessible to everyone.
                    </p>
                </div>
                <div class="text-center">
                    <div class="text-blue-600 text-4xl mb-4">🌐</div>
                    <h4 class="text-xl font-semibold mb-2">Community-Driven</h4>
                    <p class="text-gray-600">
                        Our platform thrives on community-rated mentors and diverse learning formats, from 1-on-1 to group sessions.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team/Community Section -->
    <section class="py-12 ">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-center mb-8 underline">Our Community</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="card p-6 rounded-lg shadow-md text-center">
                    <img src="/resources/images/JordanPeterson.png" alt="Team Member" class="w-24 h-24 bg-gray-200 rounded-full mx-auto mb-4">
                    <h4 class="text-lg font-semibold">Jordan B. Peterson</h4>
                    <p class="text-gray-700 uppercase">Clinical psychologist, professor, and author</p>
                    <p class="text-sm text-gray-500">
                        Specializing in personality psychology,
                        ethics, and mythology. Offers guidance on personal development and meaning in life.
                        Global recognized clinical psychologist, practising over 25yrs
                    </p>
                </div>
                <div class="card p-6 rounded-lg shadow-md text-center">
                    <img src="/resources/images/Elliot_Alderson.png" alt="Team Member" class="w-24 h-24 bg-gray-200 rounded-full mx-auto mb-4">
                    <h4 class="text-lg font-semibold">Elliot Alderson</h4>
                    <p class="text-gray-700 uppercase">Elite cybersecurity engineer and ethical hacker</p>
                    <p class="text-sm text-gray-500">
                        With expertise in network security, penetration testing,
                        and vulnerability assessment.
                        Specializes in teaching security-first coding practices and digital privacy protection.
                    </p>
                </div>
                <div class="card p-6 rounded-lg shadow-md text-center">
                    <img src="/resources/images/KevinPowell.png" alt="Team Member" class="w-24 h-24 bg-gray-200 rounded-full mx-auto mb-4">
                    <h4 class="text-lg font-semibold">Kevin Powell</h4>
                    <p class="text-gray-700 uppercase">Front-end web development expert specializing in CSS</p>
                    <p class="text-sm text-gray-500">Creates educational content focused on modern web design techniques and best practices.</p>
                </div>
                <div class="card p-6 rounded-lg shadow-md text-center">
                    <img src="/resources/images/55834ce6a2e4ae59e219aeed23ad59cb--white-eyes-dark-anime.jpg" alt="Team Member" class="w-24 h-24  bg-gray-200 rounded-full mx-auto mb-4">
                    <h4 class="text-lg font-semibold">Banele Zulu</h4>
                    <p class="text-gray-700 uppercase">Software developer: Developed TutorFinder!!!!</p>
                    <a href="#join" class="text-blue-600 hover:underline">Apply Now</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Partners Section (Infinite Horizontal Scroll) -->
    <section id="partnerships" class="py-12 bg-white">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-center mb-8">Our Partners</h3>
            <div class="scroll-container">
                <div class="scroll-content flex">
                    <!-- Repeated cards for infinite scroll effect -->
                    <div class="card bg-gray-100 p-4 rounded-lg text-center min-w-[150px] mx-2">
                        <img src="https://static.wixstatic.com/media/511876_03e9af0ead6d44aa931f86e388c886ab~mv2.png/v1/fit/w_2500,h_1330,al_c/511876_03e9af0ead6d44aa931f86e388c886ab~mv2.png" alt="Partner Logo" class="w-30 h-30 mx-auto mb-2">
                        <p class="text-sm font-semibold">EduConnect</p>
                    </div>
                    <div class="card bg-gray-100 p-4 rounded-lg text-center min-w-[150px] mx-2">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSnnakujGy69P5eOk4gH9xGpQbR3jNEIOSTnw&s.jpg" alt="Partner Logo" class="w-30 h-30 mx-auto mb-2">
                        <p class="text-sm font-semibold">SchoolarSphere</p>
                    </div>
                    <div class="card bg-gray-100 p-4 rounded-lg text-center min-w-[150px] mx-2">
                        <img src="https://learneasy.co.za/wp-content/uploads/2023/08/Learn-easy-Logo.png" alt="Partner Logo" class="w-30 h-30 mx-auto mb-2">
                        <p class="text-sm font-semibold">LearnEasy</p>
                    </div>
                    <div class="card bg-gray-100 p-4 rounded-lg text-center min-w-[150px] mx-2">
                        <img src="https://s3-eu-west-1.amazonaws.com/tpd/logos/605a1bafdcd5e70001f2740d/0x0.png" alt="Partner Logo" class="w-30 h-30 mx-auto mb-2">
                        <p class="text-sm font-semibold">SmartTutors Inc.</p>
                    </div>
                    <div class="card bg-gray-100 p-4 rounded-lg text-center min-w-[150px] mx-2">
                        <img src="https://i0.wp.com/www.defendedge.com/wp-content/uploads/2024/06/skillbridge-1.png?resize=1024%2C577&ssl=1" alt="Partner Logo" class="w-30 h-30 mx-auto mb-2">
                        <p class="text-sm font-semibold">SkillBridge</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- FAQ Section -->
    <section id="faq" class="py-12 ">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-center mb-8">Frequently Asked Questions</h3>
            <div class="max-w-4xl mx-auto">
                <div class="accordion mb-4">
                    <div class="accordion-header bg-[#f84650] p-4 rounded-t-lg">
                        <h4 class="text-lg font-semibold">What makes TutorFinder different?</h4>
                    </div>
                    <div class="accordion-content bg-white p-1 rounded-b-lg">
                        <p class="text-gray-600 p-4">
                            TutorFinder focuses on deep learning, connecting you with community-rated mentors who emphasize understanding over quick answers. Choose from online, in-person, or group sessions at affordable rates.
                        </p>
                    </div>
                </div>
                <div class="accordion mb-4">
                    <div class="accordion-header bg-[#f84650] p-4 rounded-t-lg">
                        <h4 class="text-lg font-semibold">How do I choose a mentor?</h4>
                    </div>
                    <div class="accordion-content bg-white p-1 rounded-b-lg">
                        <p class="text-gray-600 p-4">
                            Browse mentors by subject, teaching style, and session format. Use our filters to match your budget and preferences, and check ratings to find the perfect fit.
                        </p>
                    </div>
                </div>
                <div class="accordion mb-4">
                    <div class="accordion-header bg-[#f84650] p-4 rounded-t-lg">
                        <h4 class="text-lg font-semibold">Are there affordable options?</h4>
                    </div>
                    <div class="accordion-content bg-white p-1 rounded-b-lg">
                        <p class="text-gray-600 p-4">
                            Yes! We offer flexible subscription plans and discounts to make learning accessible. Check our plans page for details.
                        </p>
                    </div>
                </div>
                <div class="accordion mb-4">
                    <div class="accordion-header bg-[#f84650] p-4 rounded-t-lg">
                        <h4 class="text-lg font-semibold">Do you have tutors who work with students with learning disabilities?</h4>
                    </div>
                    <div class="accordion-content bg-white p-1 rounded-b-lg">
                        <p class="text-gray-600 p-4">
                            Yes, many of our tutors specialize in working with students who have ADHD, dyslexia, autism spectrum disorders, and other learning differences. You can filter for these specializations when searching for tutors.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Join Us Section -->
    <section id="join" class="py-12  text-white text-center">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold mb-4">Join TutorFinder Today</h3>
            <p class="text-lg mb-6">
                Whether you’re a mentor ready to share your expertise or a learner eager to grow, TutorFinder is your platform for meaningful education.
            </p>
            <div class="flex justify-center space-x-4">
                <a href="#" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-200">
                    Sign Up as a Mentee
                </a>
                <a href="#" class="border-2 border-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600">
                    Become a Mentor
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include("../util/footer.php"); ?>
    <script src="../assets/js/theme.js"></script>
    <style>
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            color: var(--clr-heading) !important;
        }

        p,
        b {
            color: var(--clr-text) !important;
        }


        section:not(.banner) {
            background: var(--clr-body-bg);
        }

        /* Custom styles for enhanced visuals */
        .card {
            transition: transform 0.3s, box-shadow 0.3s;
            background: var(--clr-card-bg);
            height: 20rem;
            min-height: max-content;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
        }

        .accordion-header {
            cursor: pointer;
            transition: background-color 0.2s;

            h4 {
                color: #fff !important;
            }
        }

        .accordion-header:hover {
            background-color: #e5e7eb;
            transition: background-color 0.2s;

            h4 {
                color: #333 !important;
            }
        }


        .accordion-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease-out;
        }

        .accordion-content.open {
            max-height: 200px;
        }

        /* Infinite scroll styles */
        .scroll-container {
            display: flex;
            overflow: hidden;
            white-space: nowrap;
            width: 100%;
        }

        .scroll-content {
            display: flex;
            animation: scroll 20s linear infinite;
        }

        .scroll-content:hover {
            animation-play-state: paused;
        }

        @keyframes scroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }



        .section {
            margin-bottom: 20px;
        }

        h2 {
            color: var(--clr-heading);
            border-bottom: 2px solid var(--clr-nav-bg);
            padding-bottom: 5px;
        }

        ul {
            list-style-type: none;
            padding: 0;
            padding-left: 0.5rem;
            border-left: 0.1rem dotted #333;
            text-align: left;

            a {
                color: rgba(24, 24, 230, 0.701);
                font-size: 0.8rem;
            }
        }

        li {
            margin: 10px 0;
            font-size: 0.7rem;
        }

        strong {
            color: var(--clr-heading);
        }
    </style>



    <script>
        // Smooth scroll for in-page links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                target.scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Accordion functionality
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
    </script>
</body>

</html>