<div id="menteeRegistrationOverlay" class="overlay-wrapper">
    <div class="overlay-content w-64">
        <div class="progress-bar">
            <div class="progress-step" data-step="1">
                <div class="step-circle">1</div>
                <div class="step-text">Basic Info</div>
                <div class="step-line"></div>
            </div>
            <div class="progress-step" data-step="2" data-type="mentee">
                <div class="step-circle">2</div>
                <div class="step-text">Education</div>
                <div class="step-line"></div>
            </div>
        </div>

        <div class="form-section">
            <form id="menteeRegistrationForm" class="relative" novalidate>
                <!-- Step 1: Basic Info -->
                <div id="step1" class="step">
                    <h3 class="text-lg font-semibold mb-4">Step 1: Basic Information</h3>
                    <!-- <h1 id="test">her</h1> -->
                    <div class="form-data mb-4">
                        <label for="mentee-fullname" class="block text-sm font-medium">Full Name<span class="text-red-500">*</span></label>
                        <input type="text" id="mentee-fullname" name="name" class="w-full p-2 border rounded" required>
                        <p id="mentee-fullnameError" aria-live="polite"></p>
                    </div>
                    <div class="flex justify-end gap-4 mt-2">
                        <div class="form-data mb-4">
                            <label for="mentee-dob" class="block text-sm font-medium">Date of Birth</label>
                            <input type="date" id="mentee-dob" name="dob" class="w-full p-2 border rounded" required>
                            <p id="mentee-dobError"></p>
                        </div>
                        <div class="form-data mb-4">
                            <label for="mentee-phone" class="block text-sm font-medium">Phone Number</label>
                            <input type="tel" id="mentee-phone" name="phone" class="phone w-full p-2 border rounded" required maxlength="10">
                            <p id="mentee-phoneError"></p>
                        </div>
                    </div>
                    <div class="flex justify-end gap-4">
                        <div class="form-data mb-4">
                            <label for="mentee-password" class="block text-sm font-medium">Password</label>
                            <input type="password" id="mentee-password" name="password" class="w-full p-2 border rounded" required>
                            <p id="mentee-passwordError"></p>
                        </div>
                        <div class="form-data my-4">
                            <label for="mentee-confirmPassword" class="block text-sm font-medium">Confirm Password</label>
                            <input type="password" id="mentee-confirmPassword" name="confirmPassword" class="w-full p-2 border rounded" required>
                            <p id="mentee-confirmPasswordError"></p>
                        </div>
                    </div>
                    <div class="flex justify-end gap-4 mt-2">
                        <button type="button" id="menteeNext1" class="p-2 rounded hover:bg-[#f84650 mr-2]">Save & Continue <i class="ph-thin ph-arrow-bend-up-right"></i>
                            <span class="loading" id="mentee-loadingSpinnerStep1" style="display: none;"></span>
                        </button>
                    </div>
                </div>

                <!-- Mentee Step 2: Education Info -->
                <div id="menteeStep2" class="step hidden">
                    <h3 class="text-lg font-semibold mb-4">Step 2: Education Information</h3>
                    <div class="form-data mb-4">
                        <label for="mentee-educationLevel" class="block text-sm font-medium text-gray-300">Education Level</label>
                        <select id="mentee-educationLevel" name="education" class="w-full p-2 border rounded" required>
                            <option value="">Select Education Level</option>
                            <option value="Primary School">Primary School</option>
                            <option value="High School">High School</option>
                            <option value="Undergraduate">Undergraduate</option>
                            <option value="Postgraduate">Postgraduate</option>
                        </select>
                        <p id="mentee-educationLevelError" class="error hidden"></p>
                    </div>
                    <div class="form-data mb-4">
                        <label for="mentee-tertiaryEducation" class="block text-sm font-medium text-gray-300">Tertiary Institution (Optional)</label>
                        <input type="text" id="mentee-tertiaryEducation" name="tertiaryEducation" class="w-full p-2 border rounded">
                    </div>
                    <div class="form-data mb-4">
                        <label for="mentee-learningGoals" class="block text-sm font-medium text-gray-300">Learning Goals</label>
                        <textarea id="mentee-learningGoals" name="learningGoals" class="w-full p-2 border rounded" rows="4"></textarea>
                        <p id="mentee-learningGoalsError" class="error hidden"></p>
                    </div>
                    <div class="flex justify-end gap-4 mt-2">
                        <button type="button" id="prev2Mentee" class="p-2 rounded hover:bg-gray-600 mr-2">Previous <i class="ph-thin ph-arrow-bend-up-left"></i></i></button>
                        <button type="button" id="submitMentee" class="bg-blue-500 p-2 rounded hover:bg-blue-600 mr-2">Save & Continue <i class="ph-thin ph-arrow-bend-up-right"></i></button>
                    </div>
                </div>


                <!-- In mentee overlay, after menteeStep2 -->
                <div id="menteeFinal" class="step hidden relative">
                    <button type="button" class="exit-btn" onclick="closeOverlayStep()">&times;</button>
                    <div id="confirmationMenteeDetails" class="mb-4 text-gray-300"></div>
                    <div class="nav-btn flex justify-end gap-4 mt-2">
                        <button type="button" id="prev3Mentee" class="p-2 rounded hover:bg-gray-600 mr-2">Previous <i class="ph-thin ph-arrow-bend-up-left"></i></button>
                        <button type="button" id="finishMentee" class="bg-blue-500 p-2 rounded hover:bg-blue-600 mr-2">Finish <i class="ph-thin ph-floppy-disk-back"></i></button>
                    </div>
                </div>
                <button class="cancelRegistrationBtn absolute z-100 bottom-0 left-2 mr-2 mt-2 bg-red-400 p-1 rounded-sm">EXIT <i class="ph ph-x-circle text-md"></i></button>
            </form>
        </div>
    </div>
</div>

<div id="mentorRegistrationOverlay" class="overlay-wrapper">
    <div class="overlay-content">
        <div class="progress-bar">
            <div class="progress-step" data-step="1">
                <div class="step-circle">1</div>
                <div class="step-text">Basic Info</div>
                <div class="step-line"></div>
            </div>
            <div class="progress-step" data-step="2" data-type="mentor">
                <div class="step-circle">2</div>
                <div class="step-text">Teaching Info</div>
                <div class="step-line"></div>
            </div>
            <div class="progress-step" data-step="3" data-type="mentor">
                <div class="step-circle">3</div>
                <div class="step-text">Face Verification</div>
                <div class="step-line"></div>
            </div>
            <div class="progress-step" data-step="4" data-type="mentor">
                <div class="step-circle">4</div>
                <div class="step-text">Documents</div>
                <div class="step-line"></div>
            </div>
        </div>

        <div class="form-section">
            <form id="mentorRegistrationForm" class="relative" novalidate>
                <!-- Step 1: Basic Info -->
                <div id="step1" class="step">
                    <h3 class="text-lg font-semibold mb-4">Step 1: Basic Information</h3>
                    <!-- <h1 id="test">her</h1> -->
                    <div class="form-data mb-4">
                        <label for="mentor-fullname" class="block text-sm font-medium">Full Name</label>
                        <input type="text" id="mentor-fullname" name="name" class="w-full p-2 border rounded" required>
                        <p id="mentor-fullnameError"></p>
                    </div>
                    <div class="flex justify-end gap-4 mt-2">
                        <div class="form-data mb-4">
                            <label for="mentor-dob" class="block text-sm font-medium">Date of Birth</label>
                            <input type="date" id="mentor-dob" name="dob" class="w-full p-2 border rounded" required>
                            <p id="mentor-dobError"></p>
                        </div>
                        <div class="form-data mb-4">
                            <label for="mentor-phone" class="block text-sm font-medium">Phone Number</label>
                            <input type="tel" id="mentor-phone" name="phone" class="phone w-full p-2 border rounded" required maxlength="10">
                            <p id="mentor-phoneError"></p>
                        </div>
                    </div>
                    <div class="flex justify-end gap-4">
                        <div class="form-data mb-4">
                            <label for="mentor-password" class="block text-sm font-medium">Password</label>
                            <input type="password" id="mentor-password" name="password" class="w-full p-2 border rounded" required>
                            <p id="mentor-passwordError"></p>
                        </div>
                        <div class="form-data my-4">
                            <label for="mentor-confirmPassword" class="block text-sm font-medium">Confirm Password</label>
                            <input type="password" id="mentor-confirmPassword" name="confirmPassword" class="w-full p-2 border rounded" required>
                            <p id="mentor-confirmPasswordError"></p>
                        </div>
                    </div>
                    <div class="flex justify-end gap-4 mt-2">
                        <button type="button" id="mentorNext1" class="p-2 rounded hover:bg-[#f84650 mr-2]">Save & Continue <i class="ph-thin ph-arrow-bend-up-right"></i>
                            <span class="loading" id="mentor-loadingSpinnerStep1" style="display: none;"></span>
                        </button>
                    </div>
                </div>
                <!-- Mentor Step 2: Teaching Info -->
                <div id="mentorStep2" class="step hidden">
                    <h3 class="text-lg font-semibold mb-4">Step 2: Teaching Information</h3>
                    <div class="form-data mb-4">
                        <label for="mentor-specialities" class="block text-sm font-medium text-gray-300">Specialities (comma-separated)</label>
                        <input type="text" id="mentor-specialities" name="specialities" class="w-full p-2 border rounded" placeholder="e.g., Math, Physics, Coding">
                        <p id="mentor-specialitiesError" class="error hidden"></p>
                    </div>
                    <div class="form-data mb-4">
                        <label for="mentor-experienceYears" class="block text-sm font-medium text-gray-300">Years of Experience</label>
                        <input type="number" id="mentor-experienceYears" name="experienceYears" class="w-full p-2 border rounded" min="0" maxlength="2" required>
                        <p id="mentor-experienceYearsError" class="error hidden"></p>
                    </div>
                    <div class="form-data mb-4">
                        <label for="mentor-hourlyRate" class="block text-sm font-medium text-gray-300">Hourly Rate ($)</label>
                        <input type="number" id="mentor-hourlyRate" name="hourlyRate" class="w-full p-2 border rounded" min="0" maxlength="5" step="0.01" required>
                        <p id="mentor-hourlyRateError" class="error hidden"></p>
                    </div>
                    <div class="flex justify-end gap-4 mt-2">
                        <button type="button" id="prev2Mentor" class="p-2 rounded hover:bg-gray-600 mr-2">Previous <i class="ph-thin ph-arrow-bend-up-left"></i></i></button>
                        <button type="button" id="next2Mentor" class="bg-blue-500 p-2 rounded hover:bg-blue-600 mr-2">Save & Continue <i class="ph-thin ph-arrow-bend-up-right"></i></button>
                    </div>
                </div>
                <!-- Mentor Step 3: Selfie Verification -->
                <div id="mentorStep3" class="step hidden">
                    <h3 class="text-lg font-semibold mb-2">Step 3: Selfie Verification</h3>
                    <div class="form-data mb-4">
                        <label class="block text-sm font-medium text-gray-300">Take Selfie with Front Camera</label>
                        <video id="mentor-video" autoplay style="display: block;"></video>
                        <canvas id="mentor-canvas" width="300" height="300" style="display: none;"></canvas>
                        <input type="hidden" id="mentor-selfieData" name="selfie">
                        <button type="button" id="retakeSelfie" class="mt-2 bg-gray-500 p-2 rounded hover:bg-gray-600 ml-2" style="display: none;">Retake Selfie</button>
                        <button type="button" id="captureSelfie" class="mt-2 bg-blue-500 p-2 rounded hover:bg-blue-600">Capture Selfie</button>
                        <p id="mentor-selfieError" class="error hidden"></p>
                    </div>
                    <div class="flex justify-end gap-4 mt-2">
                        <button type="button" id="prev3Mentor" class="p-2 rounded hover:bg-gray-600 mr-2">Previous <i class="ph-thin ph-arrow-bend-up-left"></i></button>
                        <button type="button" id="next3Mentor" class="bg-blue-500 p-2 rounded hover:bg-blue-600 mr-2">Save & Continue <i class="ph-thin ph-arrow-bend-up-right"></i></button>
                    </div>
                </div>
                <!-- Mentor Step 4: Document Verification -->
                <div id="mentorStep4" class="step hidden">
                    <h3 class="text-lg font-semibold mb-4">Step 4: Document Verification</h3>
                    <div class="form-data mb-4">
                        <label for="mentor-idDocument" class="block text-sm font-medium text-gray-300">ID Document</label>
                        <input type="file" id="mentor-idDocument" name="idDocument" class="w-full p-2 border rounded" accept=".pdf,.jpg,.png" required>
                        <p id="mentor-idDocumentError" class="error hidden"></p>
                    </div>
                    <div class="form-data mb-4">
                        <label for="mentor-certificate" class="block text-sm font-medium text-gray-300">Certificate (Optional)</label>
                        <input type="file" id="mentor-certificate" name="certificate" class="w-full p-2 border rounded" accept=".pdf,.jpg,.png">
                    </div>
                    <div class="flex justify-end gap-4 mt-2">
                        <button type="button" id="prev4Mentor" class="p-2 rounded hover:bg-gray-600 mr-2">Previous <i class="ph-thin ph-arrow-bend-up-left"></i></i></button>
                        <button type="button" id="submitMentor" class="bg-blue-500 p-2 rounded hover:bg-blue-600 mr-2">Save & Continue <i class="ph-thin ph-arrow-bend-up-right"></i></button>
                    </div>
                </div>
                <!-- Mentor Final Step: Confirmation -->
                <div id="mentorFinal" class="step hidden">
                    <div id="confirmationMentorDetails" class="mb-4 text-gray-300"></div>
                    <div class="nav-btn flex justify-end gap-4 mt-2">
                        <button type="button" id="prev5Mentor" class="p-2 rounded hover:bg-gray-600 mr-2">Previous <i class="ph-thin ph-arrow-bend-up-left"></i></i></button>
                        <button type="button" id="finishMentor" class="bg-blue-500 p-2 rounded hover:bg-blue-600 mr-2">Finish <i class="ph-thin ph-floppy-disk-back"></i></button>
                    </div>
                </div>

                <button class="cancelRegistrationBtn absolute z-100 bottom-0 left-2 mr-2 mt-2 bg-red-400 p-1 rounded-sm">EXIT <i class="ph ph-x-circle text-md"></i></button>
            </form>
        </div>
    </div>
</div>

<script type="module" src="/src/registration/js/app.js" defer></script>