<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    exit;
}

$conn = new mysqli("localhost", "root", "", "hanaWebsite");

$decade = $conn->real_escape_string($_POST['decade']);
$year = $conn->real_escape_string($_POST['year']);
$category = $conn->real_escape_string($_POST['category']);
$title = $conn->real_escape_string($_POST['title']);
$description = $conn->real_escape_string($_POST['description']);

$sql = "INSERT INTO events (decade, year, category, title, description) VALUES ('$decade', '$year', '$category', '$title', '$description')";
$conn->query($sql);

$event_id = $conn->insert_id;

header("Location: /hanawebsite/login/add_quiz_prompt.php?event_id=$event_id");
exit;
?>
