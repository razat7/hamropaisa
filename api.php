<?php
require_once 'auth.php';

if (!checkAuth()) {
    http_response_code(403);
    die(json_encode(['error' => 'LOGISTICS DENIED']));
}

header('Content-Type: application/json');
// ... [Your DB Connection Code] ...

$action = $_POST['action'] ?? null;

// 1. DELETE ACTION
if (isset($_POST['id'])) {
    $stmt = $pdo->prepare("DELETE FROM transactions WHERE id = ?");
    $stmt->execute([$_POST['id']]);
    echo json_encode(['status' => 'success']);
    exit;
}

// 2. PASSWORD ROTATION
if ($action === 'change_password') {
    $stmt = $pdo->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->execute([$_SESSION['user']]);
    $user = $stmt->fetch();

    if ($user && password_verify($_POST['current_password'], $user['password'])) {
        $new_hash = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
        $update = $pdo->prepare("UPDATE users SET password = ? WHERE username = ?");
        $update->execute([$new_hash, $_SESSION['user']]);
        echo json_encode(['status' => 'success', 'message' => 'KEYS ROTATED']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'INVALID KEY']);
    }
    exit;
}

// 3. QR UPLOAD LOGIC
if (isset($_POST['action']) && $_POST['action'] === 'upload_qr') {
    if (!isset($_FILES['qr_image'])) {
        echo json_encode(['status' => 'error', 'message' => 'No Asset Detected']);
        exit;
    }

    $targetDir = "uploads/";
    
    // Ensure directory exists with correct permissions
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $file = $_FILES['qr_image'];
    $fileType = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));
    
    // Hardcoding to .jpeg to match your <img> src, or use the dynamic $fileType
    $targetFile = $targetDir . "secure_qr.jpeg"; 

    // Validate if it's actually an image
    $check = getimagesize($file["tmp_name"]);
    if($check === false) {
        echo json_encode(['status' => 'error', 'message' => 'File is not an image']);
        exit;
    }

    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        // Return the path with a timestamp to break browser cache
        echo json_encode([
            'status' => 'success', 
            'path' => $targetFile . '?t=' . time()
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Server Write Permission Denied']);
    }
    exit;
}

// 4. ADD / UPDATE TRANSACTION
if (isset($_POST['title'])) {
    // 1. Capture the inputs
    $input_title = htmlspecialchars($_POST['title']);
    $personnel = !empty($_POST['personnel']) ? htmlspecialchars($_POST['personnel']) : null;
   
    $other_topic = !empty($_POST['other_topic']) ? htmlspecialchars($_POST['other_topic']) : null;
    
    $amount = floatval($_POST['amount']);
    $type = $_POST['type'];
    // 3. Determine the "Final Topic"
    // Use the custom topic if provided, otherwise the dropdown value, otherwise 'Mission'
    $topic = !empty($other_topic) ? $other_topic : ($_POST['topic'] ?? 'Mission');

    if (!empty($_POST['update_id'])) {
        // UPDATE: Include personnel column if you've added it to your table
        $stmt = $pdo->prepare("UPDATE transactions SET title = ?, amount = ?, type = ?, topic = ?, personnel = ? WHERE id = ?");
        $stmt->execute([$input_title, $amount, $type, $topic, $personnel, $_POST['update_id']]);
    } else {
        // INSERT: Include personnel column
        $stmt = $pdo->prepare("INSERT INTO transactions (title, amount, type, topic, personnel) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$input_title, $amount, $type, $topic, $personnel]);
    }

    echo json_encode(['status' => 'success', 'debug_title' => $input_title]);
    exit;
}

// 5. DEFAULT: FETCH DATA
$totals = $pdo->query("SELECT 
    COALESCE(SUM(CASE WHEN type = 'income' THEN amount ELSE 0 END), 0) as total_income,
    COALESCE(SUM(CASE WHEN type = 'expense' THEN amount ELSE 0 END), 0) as total_expense 
    FROM transactions")->fetch(PDO::FETCH_ASSOC);

$list = $pdo->query("SELECT * FROM transactions ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);

echo json_encode([
    'totals' => ['total_income' => (float)$totals['total_income'], 'total_expense' => (float)$totals['total_expense']],
    'list' => $list
]);