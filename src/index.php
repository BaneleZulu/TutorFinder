<!DOCTYPE html>
<html lang="en">
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/includes/header.html');
$IPATH = $_SERVER['DOCUMENT_ROOT'] . '/src/Screens/';

?>

<body>
    <div class="parent">

        <header>
            <span class="logo">
                <img src="/resources/others/logo-removebg-preview.png" alt="tutorfidner-logo">
            </span>

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

                    <button>Sign In</button>
                    <button>
                        <a href="/">Get Started</a>
                    </button>
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
                            <option value="">What do wanna get better at?</option>
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
                <span class="carousel-controls">
                    <button id="exploreMentorsBtn" class="explore-btn">Explore all</button>
                    <button id="scroll-left" class="scroll-btn"><i class="ph ph-arrow-fat-lines-left"></i></button>
                    <button id="scroll-right" class="scroll-btn"><i class="ph ph-arrow-fat-lines-right"></i></button>
                </span>
            </div>
            <ul class="carousel"></ul>
        </div>


    </div>

    <script src="/src/assets/js/app.js"></script>
    <script src="/src/assets/js/main.js"></script>
    <script src="/src/assets/js/theme.js"></script>
</body>

</html>