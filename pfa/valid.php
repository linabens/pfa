<?php
session_start();

// Database connection (adjust your credentials if needed)
$servername = "localhost";
$username = "root";
$password = ""; // Update if you have a password
$database = "healthcare_platform";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    // ----------------- Registration -----------------
    if ($action === 'register') {
        // Collect and sanitize form data
        $first_name = trim($_POST['first_name'] ?? '');
        $last_name = trim($_POST['last_name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $phone = trim($_POST['phone_number'] ?? '');
        $needs = trim($_POST['needs_description'] ?? '');

        // Hash the password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Insert into DB
        $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password_hash, phone_number, needs_description) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $first_name, $last_name, $email, $password_hash, $phone, $needs);

        if ($stmt->execute()) {
            echo "✅ Registration successful! You can now log in.";
            header("Location: register_success.php");


        } else {
            if ($conn->errno === 1062) {
                header("Location: email_exists.php");
            } else {
                header("Location: registration_error.php");
            }
        }
        $stmt->close();
    }

    // ----------------- Login -----------------
    elseif ($action === 'login') {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        // Fetch user info
        $stmt = $conn->prepare("SELECT user_id, first_name, password_hash FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($user_id, $first_name, $hashed_password);
            $stmt->fetch();
            
           
            if (password_verify($password, $hashed_password)) {
                $_SESSION['user_id'] = $user_id;
                $_SESSION['first_name'] = $first_name;
                echo "✅ Login successful! Welcome, " . htmlspecialchars($first_name);
                header("Location: client-dashboard.html");
            } else {
                header("Location: login_error.php");
            }
        } else {
            header("Location: login_error.php");
        }
        $stmt->close();
    }

    // ----------------- Invalid Action -----------------
    else {
        echo "❌ Invalid action.";
    }

    $conn->close();
} else {
    echo "❌ Invalid request method.";
}
?>
