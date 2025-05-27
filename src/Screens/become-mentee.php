<!DOCTYPE html>
<html lang="en">
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/includes/header.html');
?>


<body class="mentee-body font-sans">
    <?php include('../util/header.php'); ?>

    <section class="bg-[#f84650] text-white py-20 mt-10">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-8xl md:text-20xl font-bold mb-4">Become a Mentee with TutorFinder</h2>
            <p class="text-lg md:text-xl max-w-3xl mx-auto mb-6">
                Unlock your potential with personalized learning from expert mentors. Join TutorFinder as a mentee and start your journey to deep understanding today!
            </p>
            <a href="#apply"
                class="bg-white text-[#f84650] px-6 py-3 rounded-lg font-semibold hover:bg-gray-200">
                Start Learning
                <i class="ph ph-thin ph-arrow-right ml-2 text-[#f84650] text-1xl"></i>
            </a>

        </div>
    </section>

    <section class="py-12">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-center mb-8">How to Become a Mentee</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="text-blue-600 text-4xl mb-4">📝</div>
                    <h4 class="text-xl font-semibold mb-2">Step 1: Sign Up</h4>
                    <p class="text-gray-600">
                        Create a free account to access our platform and explore mentor profiles.
                    </p>
                </div>
                <div class="text-center">
                    <div class="text-blue-600 text-4xl mb-4">🔍</div>
                    <h4 class="text-xl font-semibold mb-2">Step 2: Find Mentors</h4>
                    <p class="text-gray-600">
                        Browse mentors by subject, availability, and reviews to find your perfect match.
                    </p>
                </div>
                <div class="text-center">
                    <div class="text-blue-600 text-4xl mb-4">🚀</div>
                    <h4 class="text-xl font-semibold mb-2">Step 3: Start Learning</h4>
                    <p class="text-gray-600">
                        Book sessions, engage in personalized lessons, and achieve your learning goals.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-center mb-8">Requirements for Learners</h3>
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Learning Mindset -->
                    <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-blue-500">
                        <h4 class="text-xl font-semibold mb-4 text-blue-800 flex items-center">
                            <i class="ph-fill ph-brain text-blue-600 mr-2"></i>
                            Learning Mindset
                        </h4>
                        <ul class="space-y-3 text-gray-700">
                            <li class="flex items-start">
                                <i class="ph-fill ph-heart text-blue-600 mr-3 mt-1 flex-shrink-0"></i>
                                <span><strong>Genuine Desire to Learn:</strong> Motivation and enthusiasm to improve in your chosen subject or skill area.</span>
                            </li>
                            <li class="flex items-start">
                                <i class="ph-fill ph-target text-blue-600 mr-3 mt-1 flex-shrink-0"></i>
                                <span><strong>Clear Goals:</strong> Basic understanding of what you want to achieve and willingness to discuss learning objectives.</span>
                            </li>
                            <li class="flex items-start">
                                <i class="ph-fill ph-puzzle-piece text-blue-600 mr-3 mt-1 flex-shrink-0"></i>
                                <span><strong>Open to Challenges:</strong> Willingness to step outside your comfort zone and tackle difficult concepts.</span>
                            </li>
                            <li class="flex items-start">
                                <i class="ph-fill ph-arrows-clockwise text-blue-600 mr-3 mt-1 flex-shrink-0"></i>
                                <span><strong>Growth Mindset:</strong> Understanding that learning is a process and mistakes are part of improvement.</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Technical Requirements -->
                    <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-green-500">
                        <h4 class="text-xl font-semibold mb-4 text-green-800 flex items-center">
                            <i class="ph-fill ph-devices text-green-600 mr-2"></i>
                            Technical Setup
                        </h4>
                        <ul class="space-y-3 text-gray-700">
                            <li class="flex items-start">
                                <i class="ph-fill ph-laptop text-green-600 mr-3 mt-1 flex-shrink-0"></i>
                                <span><strong>Device Access:</strong> Computer, tablet, or smartphone capable of video calls and screen sharing.</span>
                            </li>
                            <li class="flex items-start">
                                <i class="ph-fill ph-wifi-high text-green-600 mr-3 mt-1 flex-shrink-0"></i>
                                <span><strong>Stable Internet:</strong> Reliable broadband connection for uninterrupted online learning sessions.</span>
                            </li>
                            <li class="flex items-start">
                                <i class="ph-fill ph-microphone text-green-600 mr-3 mt-1 flex-shrink-0"></i>
                                <span><strong>Audio/Video Setup:</strong> Working microphone and camera (built-in or external) for effective communication.</span>
                            </li>
                            <li class="flex items-start">
                                <i class="ph-fill ph-house text-green-600 mr-3 mt-1 flex-shrink-0"></i>
                                <span><strong>Learning Environment:</strong> Access to a reasonably quiet space where you can focus during sessions.</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Commitment & Responsibility -->
                    <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-purple-500">
                        <h4 class="text-xl font-semibold mb-4 text-purple-800 flex items-center">
                            <i class="ph-fill ph-handshake text-purple-600 mr-2"></i>
                            Commitment & Responsibility
                        </h4>
                        <ul class="space-y-3 text-gray-700">
                            <li class="flex items-start">
                                <i class="ph-fill ph-calendar-check text-purple-600 mr-3 mt-1 flex-shrink-0"></i>
                                <span><strong>Session Attendance:</strong> Commitment to attending scheduled sessions on time and providing advance notice for cancellations.</span>
                            </li>
                            <li class="flex items-start">
                                <i class="ph-fill ph-notebook text-purple-600 mr-3 mt-1 flex-shrink-0"></i>
                                <span><strong>Assignment Completion:</strong> Dedication to completing homework, practice exercises, and preparation work between sessions.</span>
                            </li>
                            <li class="flex items-start">
                                <i class="ph-fill ph-clock text-purple-600 mr-3 mt-1 flex-shrink-0"></i>
                                <span><strong>Time Management:</strong> Ability to dedicate sufficient time for learning outside of tutoring sessions.</span>
                            </li>
                            <li class="flex items-start">
                                <i class="ph-fill ph-currency-dollar text-purple-600 mr-3 mt-1 flex-shrink-0"></i>
                                <span><strong>Payment Responsibility:</strong> Timely payment for sessions and understanding of cancellation policies.</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Communication & Conduct -->
                    <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-orange-500">
                        <h4 class="text-xl font-semibold mb-4 text-orange-800 flex items-center">
                            <i class="ph-fill ph-chats-circle text-orange-600 mr-2"></i>
                            Communication & Conduct
                        </h4>
                        <ul class="space-y-3 text-gray-700">
                            <li class="flex items-start">
                                <i class="ph-fill ph-user-check text-orange-600 mr-3 mt-1 flex-shrink-0"></i>
                                <span><strong>Respectful Communication:</strong> Professional and courteous interaction with mentors and the TutorFinder community.</span>
                            </li>
                            <li class="flex items-start">
                                <i class="ph-fill ph-chat-circle-dots text-orange-600 mr-3 mt-1 flex-shrink-0"></i>
                                <span><strong>Active Participation:</strong> Engagement in discussions, asking questions, and providing feedback during sessions.</span>
                            </li>
                            <li class="flex items-start">
                                <i class="ph-fill ph-message-circle text-orange-600 mr-3 mt-1 flex-shrink-0"></i>
                                <span><strong>Clear Communication:</strong> Ability to express questions, concerns, and learning preferences to your mentor.</span>
                            </li>
                            <li class="flex items-start">
                                <i class="ph-fill ph-thumbs-up text-orange-600 mr-3 mt-1 flex-shrink-0"></i>
                                <span><strong>Constructive Feedback:</strong> Willingness to provide honest feedback about teaching methods and session effectiveness.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Age and Additional Considerations -->
                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-teal-500">
                        <h4 class="text-xl font-semibold mb-4 text-teal-800 flex items-center">
                            <i class="ph-fill ph-users text-teal-600 mr-2"></i>
                            Age & Support Requirements
                        </h4>
                        <ul class="space-y-3 text-gray-700">
                            <li class="flex items-start">
                                <i class="ph-fill ph-user text-teal-600 mr-3 mt-1 flex-shrink-0"></i>
                                <span><strong>Age Guidelines:</strong> Learners under 18 require parent/guardian consent and may need supervision during sessions.</span>
                            </li>
                            <li class="flex items-start">
                                <i class="ph-fill ph-shield-check text-teal-600 mr-3 mt-1 flex-shrink-0"></i>
                                <span><strong>Safety First:</strong> Adherence to online safety guidelines and platform community standards.</span>
                            </li>
                            <li class="flex items-start">
                                <i class="ph-fill ph-question text-teal-600 mr-3 mt-1 flex-shrink-0"></i>
                                <span><strong>Support Access:</strong> Understanding of how to access technical support and academic guidance when needed.</span>
                            </li>
                        </ul>
                    </div>

                    <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-pink-500">
                        <h4 class="text-xl font-semibold mb-4 text-pink-800 flex items-center">
                            <i class="ph-fill ph-star text-pink-600 mr-2"></i>
                            Success Factors
                        </h4>
                        <ul class="space-y-3 text-gray-700">
                            <li class="flex items-start">
                                <i class="ph-fill ph-compass text-pink-600 mr-3 mt-1 flex-shrink-0"></i>
                                <span><strong>Self-Awareness:</strong> Understanding of your learning style and ability to communicate preferences to mentors.</span>
                            </li>
                            <li class="flex items-start">
                                <i class="ph-fill ph-lightning text-pink-600 mr-3 mt-1 flex-shrink-0"></i>
                                <span><strong>Initiative:</strong> Proactive approach to learning, including asking questions and seeking additional resources.</span>
                            </li>
                            <li class="flex items-start">
                                <i class="ph-fill ph-trophy text-pink-600 mr-3 mt-1 flex-shrink-0"></i>
                                <span><strong>Patience with Progress:</strong> Realistic expectations about learning timelines and celebration of small victories.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Encouraging Note -->
                <div class="mt-8 bg-gradient-to-r from-blue-50 to-purple-50 p-6 rounded-lg border border-blue-200">
                    <div class="flex items-start">
                        <i class="ph-fill ph-rocket-launch text-blue-500 text-2xl mr-4 mt-1 flex-shrink-0"></i>
                        <div>
                            <h5 class="font-semibold text-gray-800 mb-2">Ready to Start Your Learning Journey?</h5>
                            <p class="text-gray-600 leading-relaxed">
                                These requirements are designed to help ensure a successful learning experience for everyone.
                                Don't worry if you don't feel confident in all areas - that's exactly why you're here to learn!
                                Our mentors are experienced in working with learners at all levels and will help you develop both
                                the subject knowledge and learning skills you need to succeed. The most important requirement is
                                your commitment to learning and growth.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-center mb-8">Benefits of Being a Mentee</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="card bg-gray-100 p-6 rounded-lg shadow-md">
                    <i class="ph-fill ph-user-focus text-3xl text-blue-600 mb-4"></i>
                    <h4 class="text-lg md:text-xl font-semibold mb-2">Personalized Learning</h4>
                    <p class="text-gray-600">
                        Get tailored lessons that match your pace, goals, and learning style with customized curriculum.
                    </p>
                </div>
                <div class="card bg-gray-100 p-6 rounded-lg shadow-md">
                    <i class="ph-fill ph-clock text-3xl text-green-600 mb-4"></i>
                    <h4 class="text-lg md:text-xl font-semibold mb-2">Flexible Scheduling</h4>
                    <p class="text-gray-600">
                        Book sessions that fit your busy life, with online or in-person options available 24/7.
                    </p>
                </div>
                <div class="card bg-gray-100 p-6 rounded-lg shadow-md">
                    <i class="ph-fill ph-medal text-3xl text-purple-600 mb-4"></i>
                    <h4 class="text-lg md:text-xl font-semibold mb-2">Expert Mentors</h4>
                    <p class="text-gray-600">
                        Learn from verified, community-rated mentors who are experts and passionate about their fields.
                    </p>
                </div>
                <div class="card bg-gray-100 p-6 rounded-lg shadow-md">
                    <i class="ph-fill ph-currency-dollar text-3xl text-orange-600 mb-4"></i>
                    <h4 class="text-lg md:text-xl font-semibold mb-2">Affordable Plans</h4>
                    <p class="text-gray-600">
                        Choose from flexible pricing options and payment plans to suit your budget and learning needs.
                    </p>
                </div>
                <div class="card bg-gray-100 p-6 rounded-lg shadow-md">
                    <i class="ph-fill ph-rocket-launch text-3xl text-red-600 mb-4"></i>
                    <h4 class="text-lg md:text-xl font-semibold mb-2">Accelerated Progress</h4>
                    <p class="text-gray-600">
                        Achieve your learning goals faster with focused, one-on-one attention and targeted skill development.
                    </p>
                </div>
                <div class="card bg-gray-100 p-6 rounded-lg shadow-md">
                    <i class="ph-fill ph-lightbulb text-3xl text-yellow-600 mb-4"></i>
                    <h4 class="text-lg md:text-xl font-semibold mb-2">Boost Confidence</h4>
                    <p class="text-gray-600">
                        Build self-assurance through supportive guidance and celebrating achievements at every step.
                    </p>
                </div>
                <div class="card bg-gray-100 p-6 rounded-lg shadow-md">
                    <i class="ph-fill ph-path text-3xl text-indigo-600 mb-4"></i>
                    <h4 class="text-lg md:text-xl font-semibold mb-2">Clear Learning Path</h4>
                    <p class="text-gray-600">
                        Follow structured learning roadmaps with measurable milestones and progress tracking.
                    </p>
                </div>
                <div class="card bg-gray-100 p-6 rounded-lg shadow-md">
                    <i class="ph-fill ph-question text-3xl text-teal-600 mb-4"></i>
                    <h4 class="text-lg md:text-xl font-semibold mb-2">Instant Support</h4>
                    <p class="text-gray-600">
                        Get immediate answers to questions and overcome learning obstacles in real-time.
                    </p>
                </div>
                <div class="card bg-gray-100 p-6 rounded-lg shadow-md">
                    <i class="ph-fill ph-users text-3xl text-pink-600 mb-4"></i>
                    <h4 class="text-lg md:text-xl font-semibold mb-2">Learning Community</h4>
                    <p class="text-gray-600">
                        Connect with fellow learners, share experiences, and build lasting educational relationships.
                    </p>
                </div>
                <div class="card bg-gray-100 p-6 rounded-lg shadow-md">
                    <i class="ph-fill ph-exam text-3xl text-cyan-600 mb-4"></i>
                    <h4 class="text-lg md:text-xl font-semibold mb-2">Exam & Test Prep</h4>
                    <p class="text-gray-600">
                        Specialized preparation for standardized tests, certifications, and academic assessments.
                    </p>
                </div>
                <div class="card bg-gray-100 p-6 rounded-lg shadow-md">
                    <i class="ph-fill ph-trend-up text-3xl text-emerald-600 mb-4"></i>
                    <h4 class="text-lg md:text-xl font-semibold mb-2">Career Advancement</h4>
                    <p class="text-gray-600">
                        Develop skills that directly impact your professional growth and job opportunities.
                    </p>
                </div>
                <div class="card bg-gray-100 p-6 rounded-lg shadow-md">
                    <i class="ph-fill ph-device-mobile text-3xl text-violet-600 mb-4"></i>
                    <h4 class="text-lg md:text-xl font-semibold mb-2">Modern Learning Tools</h4>
                    <p class="text-gray-600">
                        Access cutting-edge educational technology, interactive resources, and digital learning materials.
                    </p>
                </div>
                <div class="card bg-gray-100 p-6 rounded-lg shadow-md">
                    <i class="ph-fill ph-graduation-cap text-3xl text-amber-600 mb-4"></i>
                    <h4 class="text-lg md:text-xl font-semibold mb-2">Academic Excellence</h4>
                    <p class="text-gray-600">
                        Improve grades, master difficult subjects, and develop effective study strategies.
                    </p>
                </div>
                <div class="card bg-gray-100 p-6 rounded-lg shadow-md">
                    <i class="ph-fill ph-compass text-3xl text-slate-600 mb-4"></i>
                    <h4 class="text-lg md:text-xl font-semibold mb-2">Learning Strategy</h4>
                    <p class="text-gray-600">
                        Discover your optimal learning methods and develop lifelong skills for continuous education.
                    </p>
                </div>
                <div class="card bg-gray-100 p-6 rounded-lg shadow-md">
                    <i class="ph-fill ph-handshake text-3xl text-rose-600 mb-4"></i>
                    <h4 class="text-lg md:text-xl font-semibold mb-2">Mentorship Beyond Learning</h4>
                    <p class="text-gray-600">
                        Gain valuable life advice, career guidance, and personal development insights from experienced mentors.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-center mb-8">Mentee Expectations</h3>
            <div class="max-w-6xl mx-auto">
                <div class="accordion mb-4">
                    <div class="accordion-header bg-[#f84650] p-4 rounded-t-lg">
                        <h4 class="text-lg font-semibold">Active Participation</h4>
                    </div>
                    <div class="accordion-content bg-white p-1 rounded-b-lg">
                        <p class="text-gray-600 p-4">
                            Engage fully in sessions, ask questions, and complete assigned tasks.
                        </p>
                    </div>
                </div>
                <div class="accordion mb-4">
                    <div class="accordion-header bg-[#f84650] p-4 rounded-t-lg">
                        <h4 class="text-lg font-semibold">Timely Communication</h4>
                    </div>
                    <div class="accordion-content bg-white p-4 rounded-b-lg">
                        <p class="text-gray-600 p-4">
                            Respond promptly to mentor messages and confirm session schedules.
                        </p>
                    </div>
                </div>
                <div class="accordion mb-4">
                    <div class="accordion-header bg-[#f84650] p-4 rounded-t-lg">
                        <h4 class="text-lg font-semibold">Respectful Interaction</h4>
                    </div>
                    <div class="accordion-content bg-white p-4 rounded-b-lg">
                        <p class="text-gray-600 p-4">
                            Maintain professionalism and respect in all communications with mentors.
                        </p>
                    </div>
                </div>
                <div class="accordion mb-4">
                    <div class="accordion-header bg-[#f84650] p-4 rounded-t-lg">
                        <h4 class="text-lg font-semibold">Goal Setting</h4>
                    </div>
                    <div class="accordion-content bg-white p-1 rounded-b-lg">
                        <p class="text-gray-600 p-4">
                            Work with your mentor to set and pursue clear learning objectives.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold text-center mb-8">What Our Mentees Say</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="card bg-gray-100 p-6 rounded-lg shadow-md text-center">
                    <p class="text-gray-600 italic mb-4">
                        “TutorFinder helped me master calculus with a mentor who truly cared about my progress.”
                    </p>
                    <h4 class="text-lg font-semibold">Liam S., Student</h4>
                </div>
                <div class="card bg-gray-100 p-6 rounded-lg shadow-md text-center">
                    <p class="text-gray-600 italic mb-4">
                        “The flexibility and personalized lessons made learning coding so much easier!”
                    </p>
                    <h4 class="text-lg font-semibold">Ava M., Aspiring Developer</h4>
                </div>
                <div class="card bg-gray-100 p-6 rounded-lg shadow-md text-center">
                    <p class="text-gray-600 italic mb-4">
                        “I gained confidence in physics thanks to my amazing mentor on TutorFinder.”
                    </p>
                    <h4 class="text-lg font-semibold">Noah K., High Schooler</h4>
                </div>
            </div>
        </div>
    </section>

    <section id="apply" class="py-12 bg-[#f84650] text-white text-center">
        <div class="container mx-auto px-4">
            <h3 class="text-3xl font-bold mb-4">Ready to Start Your Learning Journey?</h3>
            <p class="text-lg mb-6">
                Join TutorFinder as a mentee and connect with mentors who will guide you to success. Sign up now to begin!
            </p>
            <a href="join.html" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-200">
                Sign Up Now
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