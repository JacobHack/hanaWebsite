<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    exit;
}

$conn = new mysqli("localhost", "root", "", "hanawebsite");

$event_id = $_POST['event_id'];
$decade = $conn->real_escape_string($_POST['decade']);
$year = $conn->real_escape_string($_POST['year']);
$category = $conn->real_escape_string($_POST['category']);
$title = $conn->real_escape_string($_POST['title']);
$description = $conn->real_escape_string($_POST['description']);

$sql = "UPDATE events SET
    decade = '$decade',
    year = '$year',
    category = '$category',
    title = '$title',
    description = '$description'
    WHERE id = $event_id";

$conn->query($sql);

header("Location: dashboard.php");
exit;
?>
