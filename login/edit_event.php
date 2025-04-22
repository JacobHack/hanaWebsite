<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    exit;
}

$conn = new mysqli("localhost", "root", "", "hanawebsite");

$event_id = $_GET['event_id'] ?? null;
if (!$event_id) {
    echo "Missing event ID.";
    exit;
}

$result = $conn->query("SELECT * FROM events WHERE id = $event_id");
$event = $result->fetch_assoc();
if (!$event) {
    echo "Event not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h3>Edit Event</h3>
        <form method="POST" action="update_event.php">
            <input type="hidden" name="event_id" value="<?php echo $event_id; ?>">

            <div class="mb-3">
                <label class="form-label">Decade</label>
                <input type="text" class="form-control" name="decade" value="<?php echo htmlspecialchars($event['decade']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Year</label>
                <input type="text" class="form-control" name="year" value="<?php echo htmlspecialchars($event['year']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Category</label>
                <input type="text" class="form-control" name="category" value="<?php echo htmlspecialchars($event['category']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" class="form-control" name="title" value="<?php echo htmlspecialchars($event['title']); ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" rows="3" required><?php echo htmlspecialchars($event['description']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-success">Update Event</button>
            <a href="dashboard.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
