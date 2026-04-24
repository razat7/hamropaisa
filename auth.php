<?php
session_start();

$host = 'localhost'; $db = 'finance_tracker'; $user = 'root'; $pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) { die("System Error: Connection Failed"); }

if (isset($_POST['action']) && $_POST['action'] == 'login') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    // Use password_verify to check the hash against the input
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['authenticated'] = true;
        $_SESSION['user'] = $user['username'];
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'INVALID CLEARANCE CODE']);
    }
    exit;
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

function checkAuth() {
    return isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true;
}
?>