<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    exit;
}
$conn = new mysqli("localhost", "root", "", "hanawebsite");

$answer_id = intval($_GET['answer_id']);
$event_id = intval($_GET['event_id']);

$conn->query("DELETE FROM answers WHERE answer_id = $answer_id");

header("Location: edit_quiz.php?event_id=$event_id");
exit;
?>