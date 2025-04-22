<?php
session_start();
$conn = new mysqli("localhost", "root", "", "hanaWebsite");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email = '$email' LIMIT 1");

    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'admin') {
                header("Location: /hanawebsite/login/dashboard.php");
            } else {
                header("Location: /hanawebsite/home.html");
            }
            exit;
        }
    }
}
header("Location: /hanawebsite/login/login_register_modal.html?error=invalid");
?>
