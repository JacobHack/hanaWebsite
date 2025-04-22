<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "Access denied.";
    exit;
}

$event_id = $_GET['event_id'] ?? null;
if (!$event_id) {
    echo "Event ID missing.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz Prompt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5 text-center">
        <div class="alert alert-success">
            <h4 class="alert-heading">Event Created!</h4>
            <p>Would you like to add a quiz for this event?</p>
            <hr>
            <a href="create_quiz.php?event_id=<?php echo $event_id; ?>" class="btn btn-primary">Yes, Add a Quiz</a>
            <a href="dashboard.php" class="btn btn-secondary">No, Go Back</a>
        </div>
    </div>
</body>
</html>
