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
            <div class="wrapper">
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


        <h1>Transforming your potential</h1>
        <h4>Become the best version of yourself by accessing to the perspectives
            and life experiences of others who've been there, done that.</h4>


        <div style="height: 40rem;"></div>


    </div>

    <script src="/src/assets/js/app.js"></script>
    <script src="/src/assets/js/theme.js"></script>
</body>

</html>