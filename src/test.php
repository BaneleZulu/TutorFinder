<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tutorfinder";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Fetch prizes from database
$stmt = $conn->prepare("SELECT * FROM spin_win ORDER BY id");
$stmt->execute();
$prizes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch winning state
$stmt = $conn->prepare("SELECT win_enabled FROM spin_state ORDER BY id DESC LIMIT 1");
$stmt->execute();
$win_state = $stmt->fetch(PDO::FETCH_ASSOC);
$win_enabled = $win_state ? $win_state['win_enabled'] : true;

// Convert to JSON for JavaScript
$prizes_json = json_encode($prizes);
$win_enabled_json = json_encode($win_enabled);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Spin Wheel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .wheel-container {
            position: relative;
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }

        .wheel {
            width: 100%;
            height: auto;
            transition: transform 5s cubic-bezier(0.17, 0.67, 0.21, 0.99);
            transform: rotate(0deg);
        }

        .spin-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 70px;
            height: 70px;
            border-radius: 50%;
            z-index: 10;
            cursor: pointer;
            transition: all 0.3s;
        }

        .spin-btn:hover {
            transform: translate(-50%, -50%) scale(1.05);
        }

        .spin-btn:active {
            transform: translate(-50%, -50%) scale(0.95);
        }

        .pointer {
            position: absolute;
            right: -20px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-top: 20px solid transparent;
            border-bottom: 20px solid transparent;
            border-right: 40px solid #ef4444;
            z-index: 5;
            filter: drop-shadow(0 0 5px rgba(0, 0, 0, 0.3));
        }

        .result-modal {
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s;
        }

        .result-modal.show {
            opacity: 1;
            visibility: visible;
        }

        @keyframes confetti {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
            }

            100% {
                transform: translateY(100vh) rotate(360deg);
                opacity: 0;
            }
        }

        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: #f00;
            opacity: 0;
        }
    </style>

</head>

<body class="bg-gradient-to-br from-blue-50 to-purple-50 min-h-screen py-10 px-4">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl md:text-5xl font-bold text-center text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-pink-600 mb-2">
            Lucky Spin Wheel
        </h1>
        <p class="text-center text-gray-600 mb-10">Spin to win amazing prizes!</p>

        <div class="wheel-container mb-12">
            <div class="pointer"></div>
            <svg class="wheel" viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg"></svg>
            <button id="spinBtn" class="spin-btn bg-gradient-to-br from-red-500 to-pink-500 text-white font-bold text-lg shadow-lg hover:shadow-xl">
                <i class="fas fa-redo-alt"></i>
            </button>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-10">
            <?php foreach ($prizes as $prize): ?>
                <div class="bg-white p-4 rounded-xl shadow-md text-center">
                    <div class="text-2xl text-<?php echo htmlspecialchars($prize['color']); ?>-600 mb-2"><i class="fas fa-<?php echo htmlspecialchars($prize['icon']); ?>"></i></div>
                    <h3 class="font-bold"><?php echo htmlspecialchars($prize['name']); ?></h3>
                    <p class="text-sm text-gray-500"><?php echo htmlspecialchars($prize['description']); ?></p>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="flex justify-center">
            <button id="howToPlayBtn" class="bg-white text-purple-600 font-semibold px-6 py-2 rounded-full shadow-md hover:bg-purple-50 transition-all mr-4">
                How to Play
            </button>
            <button id="viewPrizesBtn" class="bg-purple-600 text-white font-semibold px-6 py-2 rounded-full shadow-md hover:bg-purple-700 transition-all">
                View All Prizes
            </button>
            <button id="adminBtn" class="bg-blue-600 text-white font-semibold px-6 py-2 rounded-full shadow-md hover:bg-blue-700 transition-all ml-4">
                Admin Panel
            </button>
        </div>
    </div>

    <!-- Result Modal -->
    <div id="resultModal" class="result-modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-xl p-8 max-w-md w-full text-center relative overflow-hidden">
            <div id="confettiContainer" class="absolute inset-0 overflow-hidden"></div>
            <h2 id="spinnerHeader" class="text-3xl font-bold text-purple-600 mb-4"></h2>
            <p class="text-xl mb-6">You won: <span id="prizeResult" class="font-bold text-purple-600"></span></p>
            <div class="text-6xl mb-6 text-yellow-500">
                <i class="fas fa-trophy"></i>
            </div>
            <button id="closeModalBtn" class="bg-purple-600 text-white font-semibold px-6 py-2 rounded-full hover:bg-purple-700 transition-all">
                Claim Prize
            </button>
        </div>
    </div>

    <!-- How to Play Modal -->
    <div id="howToPlayModal" class="result-modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-xl p-8 max-w-md w-full">
            <h2 class="text-2xl font-bold text-purple-600 mb-4">How to Play</h2>
            <ul class="space-y-3 mb-6">
                <li class="flex items-start">
                    <span class="bg-purple-100 text-purple-600 rounded-full p-2 mr-3"><i class="fas fa-mouse-pointer text-sm"></i></span>
                    <span>Click the spin button to start the wheel</span>
                </li>
                <li class="flex items-start">
                    <span class="bg-purple-100 text-purple-600 rounded-full p-2 mr-3"><i class="fas fa-stopwatch text-sm"></i></span>
                    <span>Wait for the wheel to stop spinning</span>
                </li>
                <li class="flex items-start">
                    <span class="bg-purple-100 text-purple-600 rounded-full p-2 mr-3"><i class="fas fa-gift text-sm"></i></span>
                    <span>See what prize you've won</span>
                </li>
                <li class="flex items-start">
                    <span class="bg-purple-100 text-purple-600 rounded-full p-2 mr-3"><i class="fas fa-check-circle text-sm"></i></span>
                    <span>Claim your prize within 24 hours</span>
                </li>
            </ul>
            <button id="closeHowToPlayBtn" class="w-full bg-purple-600 text-white font-semibold px-6 py-2 rounded-full hover:bg-purple-700 transition-all">
                Got It!
            </button>
        </div>
    </div>

    <!-- All Prizes Modal -->
    <div id="allPrizesModal" class="result-modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-xl p-8 max-w-md w-full">
            <h2 class="text-2xl font-bold text-purple-600 mb-6 text-center">All Prizes</h2>
            <div class="grid grid-cols-2 gap-4 mb-6" id="allPrizesContainer"></div>
            <button id="closeAllPrizesBtn" class="w-full bg-purple-600 text-white font-semibold px-6 py-2 rounded-full hover:bg-purple-700 transition-all">
                Close
            </button>
        </div>
    </div>

    <!-- Admin Panel Modal -->
    <div id="adminModal" class="result-modal fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
        <div class="bg-white rounded-xl p-8 max-w-2xl w-full">
            <h2 class="text-2xl font-bold text-purple-600 mb-6 text-center">Admin Panel</h2>
            <form id="adminForm" method="POST">
                <div class="mb-6">
                    <label class="flex items-center"><input type="checkbox" name="win_enabled" <?php echo $win_enabled ? 'checked' : ''; ?> class="mr-2"><span>Enable Winning (Allow spins to land on any prize)</span></label>
                </div>
                <div id="prizesList" class="space-y-4 mb-6"></div>
                <div class="flex justify-between">
                    <button type="button" id="addPrizeBtn" class="bg-green-600 text-white font-semibold px-4 py-2 rounded-full hover:bg-green-700">Add Prize</button>
                    <div>
                        <button type="button" id="closeAdminBtn" class="bg-gray-600 text-white font-semibold px-4 py-2 rounded-full hover:bg-gray-700 mr-2">Close</button>
                        <button type="submit" class="bg-purple-600 text-white font-semibold px-4 py-2 rounded-full hover:bg-purple-700">Save Changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const prizes = <?php echo $prizes_json; ?>;
            const winEnabled = <?php echo $win_enabled_json; ?>;
            const centerX = 250;
            const centerY = 250;
            const radius = 240;
            const wheel = document.querySelector('.wheel');
            let isSpinning = false;
            let currentRotation = 0;

            function createWheel() {
                let wheelHTML = '';
                const segmentAngle = 360 / prizes.length;

                prizes.forEach((prize, index) => {
                    const startAngle = index * segmentAngle;
                    const endAngle = (index + 1) * segmentAngle;
                    const largeArcFlag = segmentAngle > 180 ? 1 : 0;
                    const startX = centerX + radius * Math.cos(startAngle * Math.PI / 180);
                    const startY = centerY + radius * Math.sin(startAngle * Math.PI / 180);
                    const endX = centerX + radius * Math.cos(endAngle * Math.PI / 180);
                    const endY = centerY + radius * Math.sin(endAngle * Math.PI / 180);
                    wheelHTML += `<path d="M${centerX},${centerY} L${startX},${startY} A${radius},${radius} 0 ${largeArcFlag},1 ${endX},${endY} Z" fill="${prize.color}" stroke="#fff" stroke-width="2" />`;
                    const textAngle = startAngle + segmentAngle / 2;
                    const textRadius = radius * 0.65;
                    const textX = centerX + textRadius * Math.cos(textAngle * Math.PI / 180);
                    const textY = centerY + textRadius * Math.sin(textAngle * Math.PI / 180);
                    wheelHTML += `<text x="${textX}" y="${textY}" font-family="Arial" font-size="14" font-weight="bold" fill="white" text-anchor="middle" dominant-baseline="middle" transform="rotate(${textAngle + 0},${textX},${textY})"><tspan x="${textX}" dy="0">${prize.description}</tspan></text>`;
                    const iconRadius = radius * 0.4;
                    const iconX = centerX + iconRadius * Math.cos(textAngle * Math.PI / 180);
                    const iconY = centerY + iconRadius * Math.sin(textAngle * Math.PI / 180);
                    wheelHTML += `<text x="${iconX}" y="${iconY}" font-family="FontAwesome" font-size="20" fill="white" text-anchor="middle" dominant-baseline="middle" transform="rotate(${textAngle + 90},${iconX},${iconY})">${getUnicodeForIcon(prize.icon)}</text>`;
                });

                wheel.innerHTML = wheelHTML;
            }

            function getUnicodeForIcon(iconName) {
                const icons = {
                    'gem': '',
                    'coins': '',
                    'gift': '',
                    'smile': '',
                    'ticket-alt': '',
                    'tshirt': '',
                    'redo': '',
                    'credit-card': ''
                };
                return icons[iconName] || '';
            }

            function populateAllPrizesModal() {
                const container = document.getElementById('allPrizesContainer');
                let html = '';
                const colors = ['purple-50', 'blue-50', 'green-50', 'yellow-50', 'pink-50', 'red-50', 'gray-50', 'teal-50'];
                prizes.forEach((prize, index) => {
                    html += `<div class="bg-${colors[index % colors.length]} p-4 rounded-lg text-center"><div class="text-${prize.color}-600 text-3xl mb-2"><i class="fas fa-${prize.icon}"></i></div><h3 class="font-bold">${prize.name}</h3><p class="text-sm">${prize.description}</p></div>`;
                });
                container.innerHTML = html;
            }

            function populateAdminPanel() {
                const container = document.getElementById('prizesList');
                let html = '';
                prizes.forEach((prize) => {
                    html += `<div class="grid grid-cols-4 gap-2"><span class="border p-2 rounded">${prize.name}</span><span class="border p-2 rounded">${prize.description}</span><span class="border p-2 rounded">${prize.color}</span><span class="border p-2 rounded">${prize.icon}</span></div>`;
                });
                container.innerHTML = html;
            }

            function spinWheel() {
                if (isSpinning) return;

                isSpinning = true;
                const spinBtn = document.getElementById('spinBtn');
                spinBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
                spinBtn.classList.add('opacity-50', 'cursor-not-allowed');

                const spinDuration = 5000;
                const minRotation = 1800;
                const maxRotation = 3600;
                const randomRotation = Math.floor(Math.random() * (maxRotation - minRotation + 1)) + minRotation;
                const segmentAngle = 360 / prizes.length;

                let winningSegment;
                if (!winEnabled) {
                    winningSegment = prizes.findIndex(prize => prize.description === 'Try Again');
                    if (winningSegment === -1) winningSegment = 0;
                } else {
                    winningSegment = Math.floor(Math.random() * prizes.length);
                }

                const segmentCenterAngle = winningSegment * segmentAngle + segmentAngle / 2;
                const preciseRotation = randomRotation + (360 - segmentCenterAngle);

                currentRotation += preciseRotation;
                wheel.style.transform = `rotate(${currentRotation}deg)`;

                setTimeout(() => {
                    isSpinning = false;
                    spinBtn.innerHTML = '<i class="fas fa-redo-alt"></i>';
                    spinBtn.classList.remove('opacity-50', 'cursor-not-allowed');

                    const normalizedRotation = ((currentRotation % 360) + 360) % 360;
                    const segmentIndex = Math.floor((360 - normalizedRotation) / segmentAngle) % prizes.length;
                    showResult(prizes[segmentIndex]);
                }, spinDuration);
            }

            function showResult(prize) {
                const resultModal = document.getElementById('resultModal');
                const prizeResult = document.getElementById('prizeResult');
                const spinnerHeader = document.getElementById('spinnerHeader');
                spinnerHeader.textContent = winEnabled ? "Congratulations!" : "Better Luck Next Time!";
                const confettiContainer = document.getElementById('confettiContainer');

                prizeResult.textContent = prize.description;
                resultModal.classList.add('show');

                confettiContainer.innerHTML = '';
                if (prize.description !== "Try Again") {
                    createConfetti();
                }
            }

            function createConfetti() {
                const colors = ['#ef4444', '#3b82f6', '#10b981', '#f59e0b', '#8b5cf6', '#ec4899'];
                const confettiContainer = document.getElementById('confettiContainer');

                for (let i = 0; i < 100; i++) {
                    const confetti = document.createElement('div');
                    confetti.className = 'confetti';
                    confetti.style.left = Math.random() * 100 + '%';
                    confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                    confetti.style.opacity = '0';

                    if (Math.random() > 0.5) {
                        confetti.style.borderRadius = '50%';
                    }

                    const size = Math.random() * 10 + 5;
                    confetti.style.width = size + 'px';
                    confetti.style.height = size + 'px';

                    confettiContainer.appendChild(confetti);

                    setTimeout(() => {
                        confetti.style.opacity = '1';
                        confetti.style.animation = `confetti ${Math.random() * 3 + 2}s linear forwards`;
                    }, Math.random() * 500);
                }
            }

            const closeModalBtn = document.getElementById('closeModalBtn');
            const howToPlayBtn = document.getElementById('howToPlayBtn');
            const viewPrizesBtn = document.getElementById('viewPrizesBtn');
            const closeHowToPlayBtn = document.getElementById('closeHowToPlayBtn');
            const closeAllPrizesBtn = document.getElementById('closeAllPrizesBtn');
            const adminBtn = document.getElementById('adminBtn');
            const closeAdminBtn = document.getElementById('closeAdminBtn');
            const resultModal = document.getElementById('resultModal');
            const howToPlayModal = document.getElementById('howToPlayModal');
            const allPrizesModal = document.getElementById('allPrizesModal');
            const adminModal = document.getElementById('adminModal');

            closeModalBtn.addEventListener('click', () => resultModal.classList.remove('show'));
            howToPlayBtn.addEventListener('click', () => howToPlayModal.classList.add('show'));
            viewPrizesBtn.addEventListener('click', () => {
                populateAllPrizesModal();
                allPrizesModal.classList.add('show');
            });
            closeHowToPlayBtn.addEventListener('click', () => howToPlayModal.classList.remove('show'));
            closeAllPrizesBtn.addEventListener('click', () => allPrizesModal.classList.remove('show'));
            adminBtn.addEventListener('click', () => {
                populateAdminPanel();
                adminModal.classList.add('show');
            });
            closeAdminBtn.addEventListener('click', () => adminModal.classList.remove('show'));

            [resultModal, howToPlayModal, allPrizesModal, adminModal].forEach(modal => {
                modal.addEventListener('click', (e) => {
                    if (e.target === modal) modal.classList.remove('show');
                });
            });
            if (closeAdminBtn) closeAdminBtn.addEventListener('click', () => adminModal.classList.remove('show'));
            if (document.getElementById('addPrizeBtn')) {
                document.getElementById('addPrizeBtn').addEventListener('click', () => {
                    const container = document.getElementById('prizesList');
                    const index = container.children.length;
                    container.innerHTML += `<div class="grid grid-cols-4 gap-2"><input type="hidden" name="prizes[${index}][id]" value="0"><input type="text" name="prizes[${index}][name]" class="border p-2 rounded" placeholder="Prize Name"><input type="text" name="prizes[${index}][description]" class="border p-2 rounded" placeholder="Description"><input type="text" name="prizes[${index}][color]" class="border p-2 rounded" placeholder="Color (hex)"><input type="text" name="prizes[${index}][icon]" class="border p-2 rounded" placeholder="Icon"></div>`;
                });
            }


            createWheel();
            document.getElementById('spinBtn').addEventListener('click', spinWheel);
        });
    </script>
</body>

</html>