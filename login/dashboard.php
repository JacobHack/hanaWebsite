<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Add Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-light bg-light justify-content-end px-3">
        <a class="btn btn-outline-primary" href="/hanawebsite/home.html">View Main Site</a>
    </nav>

    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Add New Event</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="add_event.php">
                    <div class="mb-3">
                        <label for="decade" class="form-label">Decade</label>
                        <input type="text" class="form-control" id="decade" name="decade" placeholder="e.g. 1940s" required>
                    </div>
                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input type="text" class="form-control" id="year" name="year" placeholder="e.g. 1944" required>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <input type="text" class="form-control" id="category" name="category" placeholder="e.g. Scientific, Social" required>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Event Title</label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="Title of the event" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="4" placeholder="Event details..." required></textarea>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success">Submit Event</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
