<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    exit;
}

$conn = new mysqli("localhost", "root", "", "hanaWebsite");

$event_id = $_POST['event_id'];
$question_text = $conn->real_escape_string($_POST['question']);
$answers = $_POST['answers'] ?? [];

// Insert into quizzes (if not already created per event)
$quiz_result = $conn->query("SELECT quiz_id FROM quizzes WHERE event_id = $event_id LIMIT 1");
if ($quiz_row = $quiz_result->fetch_assoc()) {
    $quiz_id = $quiz_row['quiz_id'];
} else {
    $conn->query("INSERT INTO quizzes (event_id) VALUES ($event_id)");
    $quiz_id = $conn->insert_id;
}

// Insert question
$conn->query("INSERT INTO questions (quiz_id, question_text, event_id) VALUES ($quiz_id, '$question_text', $event_id)");
$question_id = $conn->insert_id;

// Insert answers (skip empty ones)
foreach ($answers as $label => $text) {
    $text = trim($text);
    if (!empty($text)) {
        $escaped = $conn->real_escape_string($text);
        $conn->query("INSERT INTO answers (question_id, answer_label, answer_text) VALUES ($question_id, '$label', '$escaped')");
    }
}

header("Location: /hanawebsite/login/create_quiz.php?event_id=$event_id");
exit;
?>
