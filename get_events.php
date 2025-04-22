<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$host = "localhost";
$user = "root";
$password = ""; // or your MySQL root password
$dbname = "hanaWebsite";

// Create connection
$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Optional: Filter by decade
$decade = isset($_GET['decade']) ? $conn->real_escape_string($_GET['decade']) : null;
$sql = "SELECT id, year, 'Quiz' AS category, title, description FROM events";
if ($decade) {
    $sql .= " WHERE decade = '$decade'";
    
}

$sql .= " ORDER BY year ASC";

$result = $conn->query($sql);
$events = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = $row;
    }
}

echo json_encode($events);
$conn->close();
?>
