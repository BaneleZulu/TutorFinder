<div id="registrationOverlay" class="overlay-wrapper">
    <div class="overlay-content">
        <div class="progress-bar">
            <div class="progress-step" data-step="1">
                <div class="step-circle">1</div>
                <div>Basic Info</div>
                <div class="step-line"></div>
            </div>
            <div class="progress-step" data-step="2">
                <div class="step-circle">2</div>
                <div>User Details</div>
                <div class="step-line"></div>
            </div>
            <div class="progress-step" data-step="3" data-type="mentee">
                <div class="step-circle">3</div>
                <div>Education</div>
                <div class="step-line"></div>
            </div>
            <div class="progress-step" data-step="3" data-type="mentor">
                <div class="step-circle">3</div>
                <div>Teaching Info</div>
                <div class="step-line"></div>
            </div>
            <div class="progress-step" data-step="4" data-type="mentor">
                <div class="step-circle">4</div>
                <div>Selfie</div>
                <div class="step-line"></div>
            </div>
            <div class="progress-step" data-step="5" data-type="mentor">
                <div class="step-circle">5</div>
                <div>Documents</div>
                <div class="step-line"></div>
            </div>
        </div>

        <div class="form-section">
            <form id="registrationForm">
                <!-- Step 1: Basic Info -->
                <div id="step1" class="step">
                    <h3 class="text-lg font-semibold mb-4">Step 1: Basic Information</h3>
                    <div class="form-data mb-4">
                        <label for="fullname" class="block text-sm font-medium">Full Name</label>
                        <input type="text" id="fullname" class="w-full p-2 border rounded" required>
                        <p id="fullnameError"></p>
                    </div>
                    <div class="form-data mb-4">
                        <label for="dob" class="block text-sm font-medium">Date of Birth</label>
                        <input type="date" id="dob" class="w-full p-2 border rounded" required>
                        <p id="dobError"></p>
                    </div>
                    <div class="form-data mb-4">
                        <label for="phone" class="block text-sm font-medium">Phone Number</label>
                        <input type="tel" id="phone" class="w-full p-2 border rounded" required>
                        <p id="phoneError"></p>
                    </div>
                    <div class="form-data mb-4">
                        <label for="password" class="block text-sm font-medium">Password</label>
                        <input type="password" id="password" class="w-full p-2 border rounded" required>
                        <p id="passwordError"></p>
                    </div>
                    <div class="form-data mb-4">
                        <label for="confirmPassword" class="block text-sm font-medium">Confirm Password</label>
                        <input type="password" id="confirmPassword" class="w-full p-2 border rounded" required>
                        <p id="confirmPasswordError"></p>
                    </div>
                    <div class="flex justify-end gap-4 pr-4">
                        <button type="button" id="next1" class="p-2 rounded hover:bg-[#f84650]">Save & Continue</button>
                    </div>
                </div>
                <!-- Mentee Step 2: Education Info -->
                <div id="menteeStep2" class="step hidden">
                    <h3 class="text-lg font-semibold mb-4">Step 2: Education Information</h3>
                    <div class="form-data mb-4">
                        <label for="educationLevel" class="block text-sm font-medium text-gray-300">Education Level</label>
                        <select id="educationLevel" class="w-full p-2 border rounded" required>
                            <option value="">Select Education Level</option>
                            <option value="High School">High School</option>
                            <option value="Undergraduate">Undergraduate</option>
                            <option value="Postgraduate">Postgraduate</option>
                        </select>
                        <p id="educationLevelError" class="error hidden"></p>
                    </div>
                    <div class="form-data mb-4">
                        <label for="tertiaryEducation" class="block text-sm font-medium text-gray-300">Tertiary Education (Optional)</label>
                        <input type="text" id="tertiaryEducation" class="w-full p-2 border rounded">
                    </div>
                    <div class="form-data mb-4">
                        <label for="learningGoals" class="block text-sm font-medium text-gray-300">Learning Goals</label>
                        <textarea id="learningGoals" class="w-full p-2 border rounded" rows="4"></textarea>
                        <p id="learningGoalsError" class="error hidden"></p>
                    </div>
                    <div class="flex justify-between">
                        <button type="button" id="prev2Mentee" class="p-2 rounded hover:bg-gray-600">Previous</button>
                        <button type="button" id="submitMentee" class="bg-blue-500 p-2 rounded hover:bg-blue-600">Save & Continue</button>
                    </div>
                </div>
                <!-- Mentor Step 2: Teaching Info -->
                <div id="mentorStep2" class="step hidden">
                    <h3 class="text-lg font-semibold mb-4">Step 2: Teaching Information</h3>
                    <div class="form-data mb-4">
                        <label for="specialities" class="block text-sm font-medium text-gray-300">Specialities (comma-separated)</label>
                        <input type="text" id="specialities" class="w-full p-2 border rounded" placeholder="e.g., Math, Physics, Coding">
                        <p id="specialitiesError" class="error hidden"></p>
                    </div>
                    <div class="form-data mb-4">
                        <label for="experienceYears" class="block text-sm font-medium text-gray-300">Years of Experience</label>
                        <input type="number" id="experienceYears" class="w-full p-2 border rounded" min="0" required>
                        <p id="experienceYearsError" class="error hidden"></p>
                    </div>
                    <div class="form-data mb-4">
                        <label for="hourlyRate" class="block text-sm font-medium text-gray-300">Hourly Rate ($)</label>
                        <input type="number" id="hourlyRate" class="w-full p-2 border rounded" min="0" step="0.01" required>
                        <p id="hourlyRateError" class="error hidden"></p>
                    </div>
                    <div class="flex justify-between">
                        <button type="button" id="prev2Mentor" class="p-2 rounded hover:bg-gray-600">Previous</button>
                        <button type="button" id="next2Mentor" class="bg-blue-500 p-2 rounded hover:bg-blue-600">Save & Continue</button>
                    </div>
                </div>
                <!-- Mentor Step 3: Selfie Verification -->
                <div id="mentorStep3" class="step hidden">
                    <h3 class="text-lg font-semibold mb-4">Step 3: Selfie Verification</h3>
                    <div class="form-data mb-4">
                        <label class="block text-sm font-medium text-gray-300">Take Selfie with Front Camera</label>
                        <video id="video" autoplay></video>
                        <canvas id="canvas" width="300" height="300"></canvas>
                        <button type="button" id="captureSelfie" class="mt-2 bg-blue-500 p-2 rounded hover:bg-blue-600">Capture Selfie</button>
                        <p id="selfieError" class="error hidden"></p>
                    </div>
                    <div class="flex justify-between">
                        <button type="button" id="prev3Mentor" class="p-2 rounded hover:bg-gray-600">Previous</button>
                        <button type="button" id="next3Mentor" class="bg-blue-500 p-2 rounded hover:bg-blue-600">Save & Continue</button>
                    </div>
                </div>
                <!-- Mentor Step 4: Document Verification -->
                <div id="mentorStep4" class="step hidden">
                    <h3 class="text-lg font-semibold mb-4">Step 4: Document Verification</h3>
                    <div class="form-data mb-4">
                        <label for="idDocument" class="block text-sm font-medium text-gray-300">ID Document</label>
                        <input type="file" id="idDocument" class="w-full p-2 border rounded" accept=".pdf,.jpg,.png" required>
                        <p id="idDocumentError" class="error hidden"></p>
                    </div>
                    <div class="form-data mb-4">
                        <label for="certificate" class="block text-sm font-medium text-gray-300">Certificate (Optional)</label>
                        <input type="file" id="certificate" class="w-full p-2 border rounded" accept=".pdf,.jpg,.png">
                    </div>
                    <div class="flex justify-between">
                        <button type="button" id="prev4Mentor" class="p-2 rounded hover:bg-gray-600">Previous</button>
                        <button type="button" id="submitMentor" class="bg-blue-500 p-2 rounded hover:bg-blue-600">Save & Continue</button>
                    </div>
                </div>
                <!-- Mentor Final Step: Confirmation -->
                <div id="mentorFinal" class="step hidden">
                    <h3 class="text-lg font-semibold mb-4">Application Pending</h3>
                    <div id="confirmationDetails" class="mb-4 text-gray-300"></div>
                    <div class="flex justify-between">
                        <button type="button" id="prev5Mentor" class="p-2 rounded hover:bg-gray-600">Previous</button>
                        <button type="button" id="finishMentor" class="bg-blue-500 p-2 rounded hover:bg-blue-600">Finish</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>