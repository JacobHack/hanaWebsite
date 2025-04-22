<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    exit;
}

$conn = new mysqli("localhost", "root", "", "hanawebsite");

$question_id = intval($_POST['question_id']);
$event_id = intval($_POST['event_id']);
$label = $conn->real_escape_string($_POST['label']);
$text = $conn->real_escape_string($_POST['text']);

if (!empty($label) && !empty($text)) {
    $conn->query("INSERT INTO answers (question_id, answer_label, answer_text) VALUES ($question_id, '$label', '$text')");
}

header("Location: edit_quiz.php?event_id=$event_id");
exit;
?>