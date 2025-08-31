<div class="overlay-wrapper" id="loginOverlay">
    <div class="overlay-content">
        <button class="exit-btn" onclick="closeOverlay('#loginOverlay')">&times;</button>
        <div class="flex justify-start items-center gap-4 w-auto">
            <p class="w-auto">Don't have an account join in today!</p>
            <button class="rounded-full bg-[#f84650] py-1 px-2" title="Sign in" id="signupBtnOvl">Sign Up</button>
        </div>
        <form method="POST" class="w-[80%] py-4 flex flex-col justify-center items-center m-auto">
            <h2 class="text-4xl font-bold text-center">Accelerate your career</h2>
            <p class="text-center w-90">Get access to our expert community of Mentors in every learning spectrum imaginable.
                Connect with people living your dream <b>worldwide</b>.
            </p>
            <div class="form-data">
                <label for="">Email</label>
                <input type="email" name="signinEmail" id="signinEmail" placeholder="YourEmail@mail.com" required>
                <p class="error">Invalid Email</p>
            </div>
            <div class="form-data">
                <label for="">Password</label>
                <input type="password" name="signinPassword" id="signinPassword" placeholder="**************" required>
                <p class="error">Invalid Email</p>
            </div>
            <button class="bn54">
                <span class="bn54span">Sign In
                    <i class="ph-fill ph-sign-in"></i>
                </span>
            </button>
            <p class="text-center w-[90%]">
                This site is protected by reCAPTCHA Enterprise and the Google
                <a href="" rel="noopener" target="_blank" title="Privacy Policy">Privacy Policy</a> and <a href="" rel="noopener" target="_blank" title="Terms of Use">Terms of Service apply.</a>
            </p>
            <p class="text-center w-[95%]">
                By continuing, you agree to the
                <a href="" rel="noopener" target="_blank" title="">Terms of use</a>,
                <a href="" rel="noopener" target="_blank" title="">Privacy Policy</a>, and <a href="" rel="noopener" target="_blank" title="">Community Standards</a>
                of <b>TutorFidner</b>
            </p>
        </form>
    </div>
</div>

<div class="overlay-wrapper" id="signupOverlay">
    <div class="overlay-content">
        <button class="exit-btn" onclick="closeOverlay('#signupOverlay')">×</button>
        <div class="flex justify-start items-center gap-4 w-auto">
            <p class="w-auto">Already have an account?</p>
            <button class="rounded-full bg-[#f84650] py-1 px-2" title="Sign in" id="loginBtnOvl">Sign In</button>
        </div>
        <!-- Email Validation -->
        <form method="POST" class="w-[80%] py-4 flex flex-col justify-center items-center m-auto">
            <h2 class="text-4xl font-bold text-center">Get started today</h2>
            <p class="text-center w-90">Get access to our expert community of Mentors in every learning spectrum imaginable.
                Connect with people living your dream <b>worldwide</b>.
            </p>
            <div class="form-data">
                <label for="signupEmail">Email</label>
                <input type="email" name="email" id="signupEmail" placeholder="YourEmail@mail.com" required>
                <div class="message" id="signupEmailMessage"></div>
            </div>
            <button class="bn54 submit-btn" id="signupRegisterBtn">
                <span class="bn54span">Sign Up
                    <i class="ph-fill ph-sign-in"></i>
                </span>
                <span class="loading" id="loadingSpinner" style="display: none;"></span>
            </button>

            <p class="text-center w-[90%]">
                This site is protected by reCAPTCHA Enterprise and the Google
                <a href="" rel="noopener" target="_blank" title="Privacy Policy">Privacy Policy</a> and <a href="" rel="noopener" target="_blank" title="Terms of Use">Terms of Service apply.</a>
            </p>
            <p class="text-center w-[95%]">
                By continuing, you agree to the
                <a href="" rel="noopener" target="_blank" title="">Terms of use</a>,
                <a href="" rel="noopener" target="_blank" title="">Privacy Policy</a>, and <a href="" rel="noopener" target="_blank" title="">Community Standards</a>
                of <b>TutorFidner</b>
            </p>
        </form>
    </div>
</div>

<div class="overlay-wrapper" id="userSelectOverlay">
    <div class="overlay-content">
        <button class="exit-btn" onclick="closeOverlay('#userSelectOverlay')">&times;</button>
        <!-- Step 1: Email Validation -->
        <form method="POST" class="w-[80%] py-4 flex flex-col justify-center items-center m-auto">
            <h2 class="text-4xl font-bold text-center">Im signing up as....</h2>
            <p class="text-center w-90 text-xs">
                Were learning and teaching is open, and tailed to make you end your day with new information,
                that can be transformed to knowledge to sharpen you world.
            </p>

            <div class="flex justify-between gap-2 w-full relative">
                <div class="w-60 h-60 relative overflow-hidden rounded-md">
                    <img src="/resources/others/mentee.jpg" alt="mentee-img-cover" loading="lazy"
                        class="w-full h-full object-cover object-center">
                    <span class="w-full absolute bottom-0 flex items-center justify-between bg-white bg-opacity-30 px-1">
                        <h1 class="text-gray-800 font-semibold">MENTEE</h1>
                        <label class="custom-radio">
                            <input type="radio" id="userType_radio" name="userType_radio" value="mentee">
                            <div class="custom-radio-slider"></div>
                        </label>
                    </span>
                </div>

                <div class="w-60 h-60 relative overflow-hidden rounded-md">
                    <img src="/resources/others/mentor.jpg" alt="mentee-img-cover" loading="lazy"
                        class="w-full h-full object-cover object-top-center">
                    <span class="w-full absolute bottom-0 flex items-center justify-between bg-white bg-opacity-30 px-1">
                        <h1 class="text-gray-800 font-semibold">MENTOR</h1>
                        <label class="custom-radio">
                            <input type="radio" id="userType_radio" name="userType_radio" value="mentor">
                            <div class="custom-radio-slider"></div>
                        </label>
                    </span>
                </div>
            </div>

            <button id="userTypeSelectBtn" class="bg-[#f84650] px-2 py-1 rounded-md">
                Next <i class="ph-light ph-arrow-right ml-2"></i>
            </button>

            <p class="text-center w-[90%] text-xs">
                This site is protected by reCAPTCHA Enterprise and the Google
                <a href="" rel="noopener" target="_blank" title="Privacy Policy">Privacy Policy</a> and <a href="" rel="noopener" target="_blank" title="Terms of Use">Terms of Service apply.</a>
            </p>
            <p class="text-center w-[95%] text-xs">
                By continuing, you agree to the
                <a href="" rel="noopener" target="_blank" title="">Terms of use</a>,
                <a href="" rel="noopener" target="_blank" title="">Privacy Policy</a>, and <a href="" rel="noopener" target="_blank" title="">Community Standards</a>
                of <b>TutorFidner</b>
            </p>
        </form>
    </div>
</div>


<div class="overlay-wrapper" id="registrationCompleteOverlay">
    <div class="overlay-content">
        <button class="exit-btn" onclick="closeOverlay('#registrationCompleteOverlay')">&times;</button>
        <div id="confirmationDetails" class="mb-4 text-gray-300">
            <h3 class="text-lg font-semibold mb-4 text-center uppercase bg-green-200 text-green-800">Registration Succeeded!</h3>
            <p class="mb-2 text-xs">Thank you for registering with TutorFinder. A confirmation email has been sent to your provided email address. Please check your inbox and follow the instructions to verify your account.</p>
            <p class="mb-2 text-xs">If you do not see the email, please check your spam or junk folder.</p>
            <p class="mb-2 text-xs">We are excited to have you on board and look forward to helping you connect with mentors and mentees worldwide!</p>
            <div class="flex flex-col justify-end gap-2 mt-2 max-h-90 overflow-y-auto bg-red-200">
                <h1 class="text-md mb-0 text-center uppercase bg-yellow-200 text-yellow-800">Application Pending</h1>

                <div class="flex flex-row gap-2 w-fit m-0">
                    <p>User Type: </p>
                    <b id="applicant-userType" class="">placeholder</b>
                </div>
                <h2 class="uppercase font-bold m-0 text-center">Personal Information</h2>
                <div class="flex justify-evenly">
                    <div class="user-data">
                        <p>Full Name: </p>
                        <b id="applicant-name">placeholder</b>
                    </div>
                    <div class="user-data">
                        <p>Date of Birth: </p>
                        <b id="applicant-dob">placeholder</b>
                    </div>
                    <div class="user-data">
                        <p>Phone Number: </p>
                        <b id="applicant-phone">placeholder</b>
                    </div>
                    <div class="user-data">
                        <p>Email: </p>
                        <b id="applicant-email">placeholder</b>
                    </div>
                </div>


                <div class="user-data">
                    <p>Application Date: </p>
                    <b id="applicant-date">placeholder</b>
                </div>
                <div class="user-data">
                    <p>Status: </p>
                    <b>Pending</b>
                </div>
                <div class="user-data">

                </div>



            </div>
        </div>
    </div>
</div>