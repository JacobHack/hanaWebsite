<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    exit;
}

$conn = new mysqli("localhost", "root", "", "hanawebsite");

$event_id = intval($_POST['event_id']);

// This will cascade delete quizzes, questions, and answers if your DB constraints are set
$conn->query("DELETE FROM events WHERE id = $event_id");

header("Location: dashboard.php");
exit;
?>
