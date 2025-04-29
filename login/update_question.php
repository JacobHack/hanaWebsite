<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    exit;
}

$conn = new mysqli("localhost", "root", "", "hanawebsite");

$question_id = intval($_POST['question_id']);
$question_text = $conn->real_escape_string($_POST['question_text']);
$answers = $_POST['answers'] ?? [];
$correct_label = $_POST['correct_label'] ?? '';

// Update the question text
$conn->query("UPDATE questions SET question_text = '$question_text' WHERE question_id = $question_id");

// Update each answer text
foreach ($answers as $label => $text) {
    $text = $conn->real_escape_string(trim($text));
    $conn->query("UPDATE answers SET answer_text = '$text' WHERE question_id = $question_id AND answer_label = '$label'");
}

// Set all answers to is_correct = 0 first
$conn->query("UPDATE answers SET is_correct = 0 WHERE question_id = $question_id");

// Then mark the selected one as correct
if (!empty($correct_label)) {
    $conn->query("UPDATE answers SET is_correct = 1 WHERE question_id = $question_id AND answer_label = '$correct_label'");
}

header("Location: " . $_SERVER['HTTP_REFERER']);
exit;
?>
