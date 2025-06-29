<!DOCTYPE html>
<html lang="en">
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/includes/header.html');
$IPATH = $_SERVER['DOCUMENT_ROOT'] . '/src/Screens/';

require $_SERVER['DOCUMENT_ROOT'] . '/components/overlay.php';
require $_SERVER['DOCUMENT_ROOT'] . '/src/registration/registration.php';
?>

<body>
    <div class="parent">
        <header>
            <a href="./index.php" target="_self" rel="noopener noreferrer" class="logo" style="background: var(--clr-body-bg); border-radius: 2rem; padding: 0 10px;">
                <img src="/resources/others/logo-removebg-preview.png" alt="tutorfidner-logo">
            </a>


            <div class="wrapper">
                <div class="switch-container">
                    <div class="switch">
                        <input type="checkbox" id="modeSwitch">
                        <label for="modeSwitch" class="slider">
                            <i class="ph ph-sun" id="modeIcon"></i>
                        </label>
                    </div>
                    <p class="mode-label">Light Mode</p>
                </div>
                <nav>

                    <button onclick="openOverlay('#loginOverlay')">Sign In</button>
                    <button onclick="openOverlay('#signupOverlay')">Get Started</button>
                </nav>
            </div>
        </header>


        <div class="home-view">
            <div class="signup-option-content">
                <div class="tabs">
                    <button class="tab-btn" onclick="openTab(event, 'mentee')">MENTEE</button>
                    <button class="tab-btn" onclick="openTab(event, 'mentor')">MENTOR</button>
                </div>

                <div id="mentee" class="tab-content">
                    <h1>Accelerate Your Growth with Expert Mentoring</h1>
                    <h4>Join a platform designed to foster personal and professional development.
                        With expert mentors and life-changing resources, experience 1:1 mentorship or
                        connect with a like-minded community ready to support your journey.</h4>
                    <span>
                        <i class="ph ph-magnifying-glass"></i>
                        <select name="searchOption" id="searchOption">
                            <option value="">What do you wanna get better at?</option>
                            <option value="">&#128187; Programming</option>
                            <option value="">&#127757; Physics</option>
                            <option value="">&#128176; Finances and Trading</option>
                            <option value="">&#128275; Testing and Penetration</option>
                            <option value="">&#127909; Video and Photo Editing</option>
                            <option value="">&#9962; Theology</option>
                            <option value="">&#128393; Art</option>
                            <option value="">&#128195; Writing</option>
                            <option value="">&#128101; Psychology</option>
                        </select>
                    </span>
                </div>
                <div id="mentor" class="tab-content">
                    <h1>Empower Others, Share Your Expertise, and Make an Impact</h1>
                    <h4>Join a community of mentors dedicated to shaping the next generation of leaders.
                        Use your knowledge and experience to guide mentees, provide valuable insights,
                        and help them navigate their journey to success. Build meaningful connections
                        and inspire growth—one conversation at a time.</h4>
                    <button><a href="/">Get Started</a></button>
                </div>
            </div>

            <div class="mentor-view">
                <img src="" alt="top-mentor-view">
                <img src="" alt="top-mentor-view">
                <img src="" alt="top-mentor-view">
                <img src="" alt="top-mentor-view">
                <img src="" alt="top-mentor-view">
                <img src="" alt="top-mentor-view">
            </div>
        </div>

        <div class="divider">
            <h1>Transforming your potential</h1>
            <h4>Become the best version of yourself by accessing to the perspectives
                and life experiences of others who've been there, done that.
            </h4>
        </div>

        <div class="process-design">
            <div class="improvise">
                <div class="row row1">
                    <span class="process-step" data-step="step1">Join TutorFidner</span>
                    <span class="process-step" data-step="step2">Sign up as Mentor or Mentee</span>
                    <span class="process-step" data-step="step3">Browse the best mentors</span>
                    <span class="process-step" data-step="step4">Join community that help you grow</span>
                    <span class="process-step" data-step="step5">Achieve your goals</span>
                </div>
            </div>
            <div class="row row2">
                <div class="step-description" id="step1">
                    <p>
                        Start your journey by becoming a part of a thriving mentorship community. Create your account and explore the opportunities that await.
                    </p>
                </div>
                <div class="step-description" id="step2">
                    <p>
                        Choose your role—whether you want to guide others as a mentor or learn and grow as a mentee. Customize your profile to showcase your skills or interests.

                    </p>
                </div>
                <div class="step-description" id="step3">
                    <p>
                        Explore a curated list of experienced mentors ready to help you achieve your goals. Filter by expertise, experience, and availability to find the right match
                    </p>
                </div>
                <div class="step-description" id="step4">
                    <p>
                        Connect with a network of like-minded individuals, engage in insightful discussions, and access valuable resources designed to accelerate your development.
                    </p>
                </div>
                <div class="step-description" id="step5">
                    <p>
                        With expert guidance and continuous support, work towards personal and professional growth. Utilize mentorship sessions, community insights, and structured learning paths to reach new heights.
                    </p>
                </div>
            </div>
        </div>


        <div class="divider">
            <h1>With the best mentor from biggest organizations </h1>
        </div>
        <div class="scroll-container">
            <div class="scroll-content"></div>
        </div>


        <div class="carousel-container">
            <div class="carousel-header">
                <h1>Discover the world's best mentors</h1>
                <span class="section-controls">
                    <button id="exploreMentorsBtn" class="explore-btn">Explore all</button>
                    <button id="scroll-left" class="scroll-btn"><i class="ph ph-arrow-fat-lines-left"></i></button>
                    <button id="scroll-right" class="scroll-btn"><i class="ph ph-arrow-fat-lines-right"></i></button>
                </span>
            </div>
            <ul class="carousel"></ul>
        </div>


        <div class="divider">
            <h1>Platform that delivers results</h1>
        </div>
        <div id="cards">
            <div class="card">
                <div class="card-content">
                    <div class="card-image">
                        <i class="ph-duotone ph-smiley"></i>
                    </div>
                    <div class="card-info-wrapper">
                        <div class="card-info">
                            <i class="ph-duotone ph-briefcase"></i>
                            <div class="card-info-title">
                                <h3><b>90<sup>%</sup></b> Happy Members</h3>
                                <h4>Career enhancement for 1000+ members</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="card-image">
                        <i class="ph-duotone ph-chalkboard-teacher"></i>
                    </div>
                    <div class="card-info-wrapper">
                        <div class="card-info">
                            <i class="ph-duotone ph-handshake"></i>
                            <div class="card-info-title">
                                <h3><b>167+</b> Expert mentors</h3>
                                <h4>Find the best in your field.</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="card-image">
                        <i class="ph-duotone ph-flag"></i>
                    </div>
                    <div class="card-info-wrapper">
                        <div class="card-info">
                            <i class="ph-duotone ph-globe-hemisphere-west"></i>
                            <div class="card-info-title">
                                <h3><b>71</b> Counties</h3>
                                <h4>Global community for variety of mentors and mentees.</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="card-image">
                        <i class="ph-duotone ph-globe"></i>
                    </div>
                    <div class="card-info-wrapper">
                        <div class="card-info">
                            <i class="ph-duotone ph-users-four"></i>
                            <div class="card-info-title">
                                <h3><b>1M</b> Global Connection</h3>
                                <h4>Building strong learning relationships worldwide.</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="card-image">
                        <i class="ph-duotone ph-book-bookmark"></i>
                    </div>
                    <div class="card-info-wrapper">
                        <div class="card-info">
                            <i class="ph-duotone ph-book-open-text"></i>
                            <div class="card-info-title">
                                <h3><b>85%</b> Improved Learning</h3>
                                <h4>Students report enhanced skills and confidence.</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="card-image">
                        <i class="ph-duotone ph-hourglass-medium"></i>
                    </div>
                    <div class="card-info-wrapper">
                        <div class="card-info">
                            <i class="ph-duotone ph-clock-clockwise"></i>
                            <div class="card-info-title">
                                <h3><b>24/7</b> Learning Access</h3>
                                <h4>Flexible tutoring anytime, anywhere.</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="divider">
            <h1>Trusted by our community.</h1>
            <h4>Word of mouth from our mentors and mentees</h4>
        </div>
        <div class="testimonials">
            <span class="section-controls">
                <button id="exploreTestimonialsBtn" class="explore-btn">Explore all</button>
                <button class="refresh-btn"><i class="ph-light ph-arrow-clockwise"></i></button>
            </span>
            <main class="testimonial-grid">
                <article class="testimonial grid-col-span-2 flow bg-primary-400 quote text-neutral-100">
                    <div class="flex">
                        <div>
                            <img src="/resources/images/JordanPeterson.png" alt="daniel clifford">
                        </div>
                        <div>
                            <h2 class="name">Daniel Clifford</h2>
                            <p class="position">Verified Graduate</p>
                        </div>
                    </div>
                    <p>
                        I received a job offer mid-course, and the subjects I learned were current, if not more so,
                        in the company I joined. I honestly feel I got every penny’s worth.
                    </p>
                    <p>
                        “ I was an EMT for many years before I joined the bootcamp. I’ve been looking to make a
                        transition and have heard some people who had an amazing experience here. I signed up
                        for the free intro course and found it incredibly fun! I enrolled shortly thereafter.
                        The next 12 weeks was the best - and most grueling - time of my life. Since completing
                        the course, I’ve successfully switched careers, working as a Software Engineer at a VR startup. ”
                    </p>
                </article>
                <article class="testimonial flow bg-secondary-400 text-neutral-100">
                    <div class="flex">
                        <div>
                            <img src="./images/image-jonathan.jpg" alt="Jonathan Walters">
                        </div>
                        <div>
                            <h2 class="name">Jonathan Walters</h2>
                            <p class="position">Verified Graduate</p>
                        </div>
                    </div>
                    <p>
                        The team was very supportive and kept me motivated
                    </p>
                    <p>
                        “ I started as a total newbie with virtually no coding skills. I now work as a mobile engineer
                        for a big company. This was one of the best investments I’ve made in myself. ”
                    </p>
                </article>
                <article class="testimonial flow bg-neutral-100 text-secondary-400">
                    <div class="flex">
                        <div>
                            <img src="./images/image-jeanette.jpg" alt="Jeanette Harmon">
                        </div>
                        <div>
                            <h2 class="name">Jeanette Harmon</h2>
                            <p class="position">Verified Graduate</p>
                        </div>
                    </div>
                    <p>
                        An overall wonderful and rewarding experience</p>
                    <p>
                        “ Thank you for the wonderful experience! I now have a job I really enjoy, and make a good living
                        while doing something I love. ”
                    </p>
                </article>
                <article class="testimonial grid-col-span-2 flow bg-secondary-500 text-neutral-100">
                    <div class="flex">
                        <div>
                            <img class="border-primary-400" src="./images/image-patrick.jpg" alt="Patrick Abrams">
                        </div>
                        <div>
                            <h2 class="name">Patrick Abrams</h2>
                            <p class="position">Verified Graduate</p>
                        </div>
                    </div>
                    <p>
                        Awesome teaching support from TAs who did the bootcamp themselves. Getting guidance from them and
                        learning from their experiences was easy.
                    </p>
                    <p>
                        “ The staff seem genuinely concerned about my progress which I find really refreshing. The program
                        gave me the confidence necessary to be able to go out in the world and present myself as a capable
                        junior developer. The standard is above the rest. You will get the personal attention you need from
                        an incredible community of smart and amazing people. ”
                    </p>
                </article>
                <article class="testimonial flow bg-neutral-100 text-secondary-400">
                    <div class="flex">
                        <div>
                            <img src="./images/image-kira.jpg" alt="Kira Whittle">
                        </div>
                        <div>
                            <h2 class="name">Kira Whittle</h2>
                            <p class="position">Verified Graduate</p>
                        </div>
                    </div>
                    <p>
                        Such a life-changing experience. Highly recommended!
                    </p>
                    <p>
                        “ Before joining the bootcamp, I’ve never written a line of code. I needed some structure from
                        professionals who can help me learn programming step by step. I was encouraged to enroll by a former
                        student of theirs who can only say wonderful things about the program. The entire curriculum and staff
                        did not disappoint. They were very hands-on and I never had to wait long for assistance. The agile team
                        project, in particular, was outstanding. It took my learning to the next level in a way that no tutorial
                        could ever have. In fact, I’ve often referred to it during interviews as an example of my developent
                        experience. It certainly helped me land a job as a full-stack developer after receiving multiple offers.
                        100% recommend! ”
                    </p>
                </article>
            </main>
        </div>



        <footer>
            <div class="footer-top">
                <span>
                    <img src="/resources/others/logo-removebg-preview.png" alt="tutorfinder-logo-img" loading="lazy">
                    <p>Empowering connections, sparking creativity, and transforming the world—one conversation at a time.</p>
                </span>
                <span>
                    <a href="" class="tooltip">
                        <i class="ph-fill ph-youtube-logo"></i>
                        <span class="tooltip-text">YouTube</span>
                    </a>
                    <a href="" class="tooltip">
                        <i class="ph-fill ph-linkedin-logo"></i>
                        <span class="tooltip-text">LinkedIn</span>
                    </a>
                    <a href="" class="tooltip">
                        <i class="ph-fill ph-facebook-logo"></i>
                        <span class="tooltip-text">Facebook</span>
                    </a>
                    <a href="" class="tooltip">
                        <i class="ph-fill ph-x-logo"></i>
                        <span class="tooltip-text">X (Twitter)</span>
                    </a>
                    <a href="" class="tooltip">
                        <i class="ph-fill ph-instagram-logo"></i>
                        <span class="tooltip-text">Instagram</span>
                    </a>
                    <a href="" class="tooltip">
                        <i class="ph-fill ph-tiktok-logo"></i>
                        <span class="tooltip-text">TikTok</span>
                    </a>
                    <a href="" class="tooltip">
                        <i class="ph-fill ph-discord-logo"></i>
                        <span class="tooltip-text">Discord</span>
                    </a>
                    <a href="" class="tooltip">
                        <i class="ph-fill ph-telegram-logo"></i>
                        <span class="tooltip-text">Telegram</span>
                    </a>
                    <a href="" class="tooltip">
                        <i class="ph-fill ph-slack-logo"></i>
                        <span class="tooltip-text">Slack</span>
                    </a>
                    <a href="" class="tooltip">
                        <i class="ph-fill ph-medium-logo"></i>
                        <span class="tooltip-text">Medium</span>
                    </a>
                    <a href="" class="tooltip">
                        <i class="ph-fill ph-reddit-logo"></i>
                        <span class="tooltip-text">Reddit</span>
                    </a>
                </span>


            </div>

            <div class="footer-bottom">
                <div>
                    <span>
                        <a href="./Screens/about.php">About US</a>
                        <a href="./Screens/become-mentor.php">Become a mentor</a>
                        <a href="./Screens/become-mentee.php">Become a mentee</a>
                        <a href="./Screens/community.php">Community</a>
                        <a href="./Screens//blog.php">Blog</a>
                    </span>

                    <span>
                        <a href="">Join TutorFidner</a>
                        <a href="./Screens/about.php#faq">FAQ's</a>
                        <a href="">Help Center</a>
                        <a href="./Screens/about.php#partnerships">Partnerships</a>
                    </span>
                </div>


                <div>
                    <p>&copy; Copyright <?php echo date('Y'); ?> - <b>TutorFinder</b></p>
                    <span>
                        <a href="">Contact Us</a>
                        <a href="">Privacy Policy</a>
                        <a href="">Terms of use</a>
                        <a href="">Sitemap</a>
                    </span>
                </div>

            </div>
            <p class="out-text" style="font-size:.7rem;">Made with <i class="fa-solid fa-heart"></i> by <a
                    href="https://www.linkedin.com/in/banele-zulu-a30861255/?trk=opento_sprofile_topcard" target="_blank"
                    rel="noopener" title="nihil@github">Banele Zulu</a>
            </p>
        </footer>


    </div>

    <!-- <script src="/src/registration/js/register_validation.js"></script> -->
    <script src="/src/assets/js/app.js"></script>
    <script src="/src/assets/js/main.js"></script>
    <script src="/src/assets/js/theme.js"></script>
    <script src="/src/registration/js/app.js"></script>
</body>

</html>