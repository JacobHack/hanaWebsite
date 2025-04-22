<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    exit;
}
$conn = new mysqli("localhost", "root", "", "hanawebsite");

$question_id = intval($_GET['question_id']);
$event_id = intval($_GET['event_id']);

// This will also delete answers if ON DELETE CASCADE is set
$conn->query("DELETE FROM questions WHERE question_id = $question_id");

header("Location: edit_quiz.php?event_id=$event_id");
exit;
?>