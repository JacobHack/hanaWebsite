<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    exit;
}

$event_id = $_GET['event_id'] ?? null;
if (!$event_id) {
    echo "Missing event ID.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .answer-input { margin-bottom: 10px; }
    </style>
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-info text-white">
                <h4>Add a Quiz Question</h4>
            </div>
            <div class="card-body">
                <form action="save_quiz_question.php" method="POST">
                    <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">

                    <div class="mb-3">
                        <label for="question" class="form-label">Question</label>
                        <input type="text" class="form-control" id="question" name="question" required>
                    </div>

                    <h6>Answers (optional for open-ended):</h6>
                    <?php
                    $labels = ['a', 'b', 'c', 'd', 'e', 'f', 'g'];
                    foreach ($labels as $label) {
                        echo '<div class="input-group answer-input">';
                        echo "<span class='input-group-text'>$label</span>";
                        echo "<input type='text' name='answers[$label]' class='form-control' placeholder='Answer for $label'>";
                        echo '</div>';
                    }
                    ?>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-success">Save Question</button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <a href="create_quiz.php?event_id=<?php echo $event_id; ?>" class="btn btn-outline-secondary btn-sm">Add Another Question</a>
                    <a href="dashboard.php" class="btn btn-outline-dark btn-sm">Finish</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
