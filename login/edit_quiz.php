<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    exit;
}

$conn = new mysqli("localhost", "root", "", "hanawebsite");

$event_id = $_GET['event_id'] ?? null;
if (!$event_id) {
    echo "Missing event ID.";
    exit;
}

// Find quiz
$quiz_result = $conn->query("SELECT quiz_id FROM quizzes WHERE event_id = $event_id");
$quiz = $quiz_result->fetch_assoc();
if (!$quiz) {
    echo "No quiz found.";
    exit;
}

$quiz_id = $quiz['quiz_id'];
$questions = $conn->query("SELECT * FROM questions WHERE quiz_id = $quiz_id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Quiz</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h3>Edit Quiz for Event ID <?php echo $event_id; ?></h3>

    <?php while ($q = $questions->fetch_assoc()): ?>
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <strong>Q: <?php echo htmlspecialchars($q['question_text']); ?></strong>
                <a href="delete_question.php?question_id=<?php echo $q['question_id']; ?>&event_id=<?php echo $event_id; ?>" class="btn btn-danger btn-sm">Delete Question</a>
            </div>
            <div class="card-body">
                <form method="POST" action="update_question.php">
                    <input type="hidden" name="question_id" value="<?php echo $q['question_id']; ?>">
                    <div class="mb-2">
                        <input type="text" name="question_text" class="form-control mb-2" value="<?php echo htmlspecialchars($q['question_text']); ?>" required>
                    </div>

                    <?php
                    $answers = $conn->query("SELECT * FROM answers WHERE question_id = " . $q['question_id']);
                    $temp = $conn->query("SELECT answer_label FROM answers WHERE question_id = " . $q['question_id'] . " AND is_correct = 1");
                    $current_correct_label = ($temp && $correct = $temp->fetch_assoc()) ? $correct['answer_label'] : null;

                    while ($a = $answers->fetch_assoc()) {
                        echo '<div class="input-group mb-2">';
                        echo '<div class="input-group-text">';
                        echo '<input type="radio" name="correct_label" value="' . $a['answer_label'] . '" ' . ($a['answer_label'] === $current_correct_label ? 'checked' : '') . '>';
                        echo '</div>';
                        echo '<span class="input-group-text">' . $a['answer_label'] . '</span>';
                        echo '<input type="text" name="answers['.$a['answer_label'].']" class="form-control" value="'.htmlspecialchars($a['answer_text']).'">';
                        echo '<a href="delete_answer.php?answer_id='.$a['answer_id'].'&event_id='.$event_id.'" class="btn btn-outline-danger">✕</a>';
                        echo '</div>';
                    }
                    ?>

                    <button type="submit" class="btn btn-success btn-sm">Save Changes</button>
                </form>

                <!-- Add new answer -->
                <form class="mt-3" method="POST" action="add_answer.php">
                    <input type="hidden" name="question_id" value="<?php echo $q['question_id']; ?>">
                    <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                    <div class="input-group">
                        <span class="input-group-text">Add Answer</span>
                        <input type="text" name="label" class="form-control" placeholder="Label (e.g., h)" required>
                        <input type="text" name="text" class="form-control" placeholder="Answer text" required>
                        <button type="submit" class="btn btn-outline-primary">Add</button>
                    </div>
                </form>
            </div>
        </div>
    <?php endwhile; ?>

    <!-- Add new question -->
    <div class="card">
        <div class="card-header bg-secondary text-white">Add New Question</div>
        <div class="card-body">
            <form method="POST" action="add_question.php">
                <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">
                <div class="mb-3">
                    <label class="form-label">Question</label>
                    <input type="text" class="form-control" name="question" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Answers</label>
                    <?php foreach (['a','b','c','d','e','f','g'] as $label): ?>
                        <div class="input-group mb-1">
                            <span class="input-group-text"><?php echo $label; ?></span>
                            <input type="text" name="answers[<?php echo $label; ?>]" class="form-control" placeholder="Answer <?php echo $label; ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="mb-3">
                    <label class="form-label">Correct Answer Label (e.g., "d")</label>
                    <input type="text" name="correct_label" class="form-control" placeholder="Correct answer label" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Question</button>
            </form>
        </div>
    </div>

    <a href="dashboard.php" class="btn btn-secondary mt-4">Back to Dashboard</a>
</div>
</body>
</html>
