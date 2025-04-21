<!DOCTYPE html>
<html lang="en">
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/includes/header.html');
$IPATH = $_SERVER['DOCUMENT_ROOT'] . '/src/Screens/';

?>

<body>

    <header>
        <!--//? ******************main nav bar  -->
        <div class="logo">
            <img src="/resources/images/mentor.jpg" alt="TutorFinder-logo">
            <h1>Tutor<strong>Finder</strong></h1>
        </div>

        <!--//?  **BACKGROUND COLOR CONTROL CODE, changes the pages theme to the liking of the user-->
        <form class="color-picker" action="">
            <fieldset>
                <h4>Plain colors</h4>
                <legend class="visually-hidden">Pick a color scheme</legend>
                <label for="light" class="visually-hidden">Light</label>
                <input type="radio" name="theme" id="light" title="Light Theme Mode" checked>

                <label for="black" class="visually-hidden">Black theme </label>
                <input type="radio" name="theme" id="black" title="Legacy Theme Mode">
            </fieldset>
        </form>
        <!--//? **END BACKGROUND COLOR CONTROL -->

        <nav class="global-nav" role="tablist" aria-labelledby="channel-name">
            <button class="tab" role="tab" aria-controls="tabPanel-1" aria-selected="true" tabindex="0"
                onclick="openTab('event', 'home')">Home</button>
            <button class="tab" role="tab" aria-controls="tabPanel-2" aria-selected="false" tabindex="-1"
                onclick="openTab('event', 'tutors')">Tutors</button>
            <button class="tab" role="tab" aria-controls="tabPanel-3" aria-selected="false" tabindex="-1"
                onclick="openTab('event', 'faq')">FAQ</button>
            <button class="tab" role="tab" aria-controls="tabPanel-4" aria-selected="false" tabindex="-1"
                onclick="openTab('event', 'contact')">Contact US</button>
            <button class="tab" role="tab" aria-controls="tabPanel-5" aria-selected="false" tabindex="-1">Log IN</button>
        </nav>
    </header>

    <main>
        <div id="home" class="tabContent">
            <?php
            include($IPATH . 'home.html');
            ?>
        </div>
        <div id="tutors" class="tabContent" style="display: none;">
            <?php
            include($IPATH . 'tutor.html');
            ?>
        </div>
        <div id="faq" class="tabContent" style="display: none;">
            <?php
            include($IPATH . 'faq.html');
            ?>
        </div>
        <div id="contact" class="tabContent" style="display: none;">
            <?php
            include($IPATH . 'contact.html');
            ?>
        </div>
    </main>

    <footer>

    </footer>

    <script src="/src/assets/js/main.js"></script>
</body>

</html>