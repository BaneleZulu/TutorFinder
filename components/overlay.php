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
                <input type="email" name="" id="" placeholder="YourEmail@mail.com" required>
            </div>
            <div class="form-data">
                <label for="">Password</label>
                <input type="password" name="" id="" placeholder="**************" required>
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
        <button class="exit-btn" onclick="closeOverlay('#signupOverlay')">&times;</button>
        <div class="flex justify-start items-center gap-4 w-auto">
            <p class="w-auto">Already have an account?</p>
            <button class="rounded-full bg-[#f84650] py-1 px-2" title="Sign in" id="loginBtnOvl">Sign In</button>
        </div>
        <!-- Step 1: Email Validation -->
        <form method="POST" class="w-[80%] py-4 flex flex-col justify-center items-center m-auto">
            <h2 class="text-4xl font-bold text-center">Get started today</h2>
            <p class="text-center w-90">Get access to our expert community of Mentors in every learning spectrum imaginable.
                Connect with people living your dream <b>worldwide</b>.
            </p>
            <div class="form-data">
                <label for="">Email</label>
                <input type="email" name="" id="" placeholder="YourEmail@mail.com" required>
            </div>
            <button class="bn54" id="registerBtn">
                <span class="bn54span">Sign Up
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