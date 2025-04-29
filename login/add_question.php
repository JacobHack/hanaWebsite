<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    exit;
}

$conn = new mysqli("localhost", "root", "", "hanawebsite");

$event_id = intval($_POST['event_id']);
$question_text = $conn->real_escape_string($_POST['question']);
$answers = $_POST['answers'] ?? [];
$correct_label = $_POST['correct_label'] ?? '';

// Get or create quiz
$result = $conn->query("SELECT quiz_id FROM quizzes WHERE event_id = $event_id");
if ($row = $result->fetch_assoc()) {
    $quiz_id = $row['quiz_id'];
} else {
    $conn->query("INSERT INTO quizzes (event_id) VALUES ($event_id)");
    $quiz_id = $conn->insert_id;
}

// Insert question
$conn->query("INSERT INTO questions (quiz_id, question_text) VALUES ($quiz_id, '$question_text')");
$question_id = $conn->insert_id;

// Insert answers
foreach ($answers as $label => $text) {
    $text = $conn->real_escape_string(trim($text));
    if (!empty($text)) {
        $is_correct = ($label === $correct_label) ? 1 : 0;
        $conn->query("INSERT INTO answers (question_id, answer_label, answer_text, is_correct) VALUES ($question_id, '$label', '$text', $is_correct)");
    }
}

header("Location: edit_quiz.php?event_id=$event_id");
exit;
?>
