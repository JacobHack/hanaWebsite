<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    exit;
}

$conn = new mysqli("localhost", "root", "", "hanawebsite");
$events = $conn->query("SELECT * FROM events ORDER BY year ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Manage Events</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Admin Dashboard</h3>
            <a href="/hanawebsite/home.php" class="btn btn-outline-primary">View Main Site</a>
        </div>

        <div class="card shadow-sm mb-5">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Add New Event</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="add_event.php">
                    <div class="mb-3">
                        <label class="form-label">Decade</label>
                        <input type="text" class="form-control" name="decade" placeholder="1940s" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Year</label>
                        <input type="text" class="form-control" name="year" placeholder="1944" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" class="form-control" name="category" placeholder="Scientific, Social..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3" required></textarea>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Submit Event</button>
                    </div>
                </form>
            </div>
        </div>

        <h5 class="mb-3">Existing Events</h5>
        <?php while ($row = $events->fetch_assoc()): ?>
            <div class="card mb-2">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <strong><?php echo htmlspecialchars($row['year']); ?> - <?php echo htmlspecialchars($row['title']); ?></strong><br>
                        <small><?php echo htmlspecialchars($row['category']); ?></small>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="edit_event.php?event_id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="edit_quiz.php?event_id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Edit Quiz</a>
                        <form action="delete_event.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this event and all related quizzes?');" class="d-inline">
                            <input type="hidden" name="event_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
