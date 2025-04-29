<?php
session_start();
$conn = new mysqli("localhost", "root", "", "hanawebsite");

$events = $conn->query("SELECT * FROM events ORDER BY RAND()");
$events_array = [];

while ($row = $events->fetch_assoc()) {
    $events_array[] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Matching Game - Sort Events</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://jacobhack.github.io/hanaWebsite/home.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        .dropzone {
            min-height: 150px;
            padding: 10px;
            margin-bottom: 20px;
            border: 2px dashed #ccc;
            border-radius: 8px;
            background: #f8f9fa;
        }
        .dropzone.dragover {
            border-color: #007bff;
            background: #e9f5ff;
        }
        .card {
            margin-bottom: 10px;
            cursor: grab;
        }
    </style>
</head>
<body class="bg-light">
    <nav class="navbar sticky-top">
        <ul class="nav-list">
            <li><a href= "./login/login_register_modal.html">Logout</a></li>
            <li><a href="home.php">Timeline</a></li>
            <li><a href="definitions.php">Definitions</a></li>
            <li><a href="matching_game.php">Matching Game</a></li>

            <?php
                
                if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
                    echo '<li><a href="/hanawebsite/login/dashboard.php">Admin Dashboard</a></li>';
                }
            ?>
        </ul>
    </nav>
<div class="container mt-5">
    <h3 class="mb-4">Match Events to Their Correct Decade or Category</h3>

    <div class="mb-4">
        <button class="btn btn-primary me-2" onclick="resetGame()">Reset Game</button>
        <button class="btn btn-warning me-2" onclick="switchMode()">Switch Mode</button>
        <button class="btn btn-success me-2" onclick="checkAnswers()">Submit Answers</button>
        <div id="results" class="mt-4"></div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h5>Events</h5>
            <div id="event-cards" class="border p-3 bg-white">
                <?php foreach ($events_array as $event): ?>
                    <div class="card p-2 mb-2" draggable="true" data-id="<?php echo $event['id']; ?>" data-decade="<?php echo $event['decade']; ?>" data-category="<?php echo $event['category']; ?>">
                        <div class="card-body p-2">
                            <?php echo htmlspecialchars($event['title']); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="col-md-6">
            <h5 id="mode-title">Drop Into the Correct Decade</h5>
            <div id="dropzones">
                <?php
                $decades = ['1940s', '1950s', '1960s', '1970s', '1980s', '1990s', '2000s', '2010s', '2020s'];
                foreach ($decades as $decade) {
                    echo "<div class='dropzone' data-type='decade' data-value='$decade'>$decade</div>";
                }
                ?>
            </div>
        </div>
    </div>

</div>

<script>
let mode = "decade"; // "decade" or "category"

const cards = document.querySelectorAll('.card');
const initialZone = document.getElementById('event-cards');

cards.forEach(card => {
    card.addEventListener('dragstart', e => {
        e.dataTransfer.setData('text/plain', card.dataset.id);
    });
});

function enableDropzones() {
    document.querySelectorAll('.dropzone').forEach(zone => {
        zone.addEventListener('dragover', e => {
            e.preventDefault();
            zone.classList.add('dragover');
        });
        zone.addEventListener('dragleave', e => {
            zone.classList.remove('dragover');
        });
        zone.addEventListener('drop', e => {
            e.preventDefault();
            zone.classList.remove('dragover');
            const id = e.dataTransfer.getData('text/plain');
            const card = document.querySelector(`[data-id='${id}']`);
            zone.appendChild(card);
        });
    });
}

enableDropzones();

function checkAnswers() {
    let correct = 0;
    let total = document.querySelectorAll('.card').length;

    document.querySelectorAll('.dropzone').forEach(zone => {
        const expectedValue = zone.getAttribute('data-value');
        const cardsInZone = zone.querySelectorAll('.card');

        cardsInZone.forEach(card => {
            if (mode === "decade" && card.getAttribute('data-decade') === expectedValue) {
                correct++;
            } else if (mode === "category" && card.getAttribute('data-category') === expectedValue) {
                correct++;
            }
        });
    });

    document.getElementById('results').innerHTML = `<h4>You matched ${correct} out of ${total} correctly!</h4>`;
}

function resetGame() {
    const allCards = document.querySelectorAll('.card');
    allCards.forEach(card => {
        initialZone.appendChild(card);
    });
    document.getElementById('results').innerHTML = "";
}

function switchMode() {
    if (mode === "decade") {
        mode = "category";
        document.getElementById('mode-title').innerText = "Drop Into the Correct Category";
        const dropzones = document.getElementById('dropzones');
        dropzones.innerHTML = "";

        const categories = ['Social Events', 'Scientific Sources', 'Legal Sources'];
        categories.forEach(category => {
            const div = document.createElement('div');
            div.className = "dropzone";
            div.setAttribute('data-type', 'category');
            div.setAttribute('data-value', category);
            div.innerText = category;
            dropzones.appendChild(div);
        });

    } else {
        mode = "decade";
        document.getElementById('mode-title').innerText = "Drop Into the Correct Decade";
        const dropzones = document.getElementById('dropzones');
        dropzones.innerHTML = "";

        const decades = ['1940s', '1950s', '1960s', '1970s', '1980s', '1990s', '2000s', '2010s', '2020s'];
        decades.forEach(decade => {
            const div = document.createElement('div');
            div.className = "dropzone";
            div.setAttribute('data-type', 'decade');
            div.setAttribute('data-value', decade);
            div.innerText = decade;
            dropzones.appendChild(div);
        });
    }
    enableDropzones();
}
</script>
</body>
</html>
