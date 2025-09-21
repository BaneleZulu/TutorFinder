<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Nihil">
    <meta name="description" content="Mentor Dashboard for Mentoring Platform">
    <meta name="keywords" content="Mentoring, Tutoring, Mentor Dashboard, Tutor Portal">
    <meta http-equiv="refresh" content="100000">
    <title>Mentor Nexus</title>
    <link rel="icon" type="image/x-icon" href="/resources/images/logo_2.jpeg">
    <!-- STYLESHEET -->
    <link rel="stylesheet" href="./frontend/assets/css/styles.css" />
    <!--//? fontawesome API -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--//? google fonts API -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Dosis:wght@200..800&family=Handjet:wght@100..900&family=M+PLUS+1+Code:wght@100..700&family=Permanent+Marker&family=Protest+Guerrilla&family=Reddit+Sans+Condensed:wght@200..900&display=swap"
        rel="stylesheet">
    <!--//? charts API -->
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <!-- //? alert API alertifyJS -->
    <!-- SweetAlert CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.2/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.2/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="container-nav">
        <div class="sidebar">
            <div class="menu-btn">
                <i class="ph-bold ph-caret-left"></i>
            </div>
            <div class="head">
                <div class="user-img">
                    <img src="/resources/images/logo_1.jpeg" alt="" />
                </div>
                <div class="user-details">
                    <p class="title">Mentor Dashboard</p>
                    <p class="name">Mentor</p>
                </div>
            </div>
            <div class="nav">
                <div class="menu">
                    <p class="title">Main</p>
                    <ul>
                        <li class="active">
                            <a href="#dashboard">
                                <i class="icon ph-bold ph-house-simple"></i>
                                <span class="text">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="#profile">
                                <i class="icon ph-bold ph-user-circle"></i>
                                <span class="text">Profile & Bio</span>
                            </a>
                        </li>
                        <li>
                            <a href="#availability">
                                <i class="icon ph-bold ph-calendar-blank"></i>
                                <span class="text">Availability</span>
                            </a>
                        </li>
                        <li>
                            <a href="#subjects">
                                <i class="icon ph-bold ph-book-open"></i>
                                <span class="text">Subjects & Expertise</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon ph-bold ph-chalkboard-teacher"></i>
                                <span class="text">Sessions</span>
                                <i class="arrow ph-bold ph-caret-down"></i>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="#one-on-one">
                                        <span class="text">1-on-1 Bookings</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#group-sessions">
                                        <span class="text">Group Sessions</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon ph-bold ph-graduation-cap"></i>
                                <span class="text">Courses</span>
                                <i class="arrow ph-bold ph-caret-down"></i>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="#created-courses">
                                        <span class="text">Created Courses</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#enrollments">
                                        <span class="text">Enrollments</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <i class="icon ph-bold ph-files"></i>
                                <span class="text">Resources</span>
                                <i class="arrow ph-bold ph-caret-down"></i>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="#materials">
                                        <span class="text">Learning Materials</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#books">
                                        <span class="text">Book Recommendations</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#posts">
                                <i class="icon ph-bold ph-article"></i>
                                <span class="text">Posts & Social</span>
                            </a>
                        </li>
                        <li>
                            <a href="#messages">
                                <i class="icon ph-bold ph-chat-teardrop-dots"></i>
                                <span class="text">Messages</span>
                            </a>
                        </li>
                        <li>
                            <a href="#earnings">
                                <i class="icon ph-bold ph-currency-dollar"></i>
                                <span class="text">Earnings & Payments</span>
                            </a>
                        </li>
                        <li>
                            <a href="#reviews">
                                <i class="icon ph-bold ph-star"></i>
                                <span class="text">Reviews</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="menu">
                    <p class="title">Settings</p>
                    <ul>
                        <li>
                            <a href="#settings">
                                <i class="icon ph-bold ph-gear"></i>
                                <span class="text">Settings</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="menu">
                <p class="title">Account</p>
                <ul>
                    <li>
                        <a href="#help">
                            <i class="icon ph-bold ph-info"></i>
                            <span class="text">Help</span>
                        </a>
                    </li>
                    <li onclick="logout()">
                        <a id="logout">
                            <i class="icon ph-bold ph-sign-out"></i>
                            <span class="text">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="sections"> </div>
    </div>
    <script src="./frontend/assets/js/navigator.js"></script>
</body>

</html>