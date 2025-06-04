<?php
session_start();
require_once 'session1.inc.php';
require_once 'includes/dbConn.inc.php';

function isValidPassword($password) {
    return preg_match('/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9]).{8,}$/', $password);
}

function isValidMobile($mobile) {
    // Check if mobile starts with "05" and is 10 digits long
    return preg_match('/^05\d{8}$/', $mobile);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];

    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.'); window.location.href='newsignupphp.php';</script>";
        exit;
    }

    if (!isValidPassword($password)) {
        echo "<script>alert('Password must be at least 8 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.'); window.location.href='newsignupphp.php';</script>";
        exit;
    }

    if (!isValidMobile($mobile)) {
        echo "<script>alert('Invalid mobile number.'); window.location.href='newsignupphp.php';</script>";
        exit;
    }

    // Check if username already exists
    $stmt = $conn->prepare("SELECT Username FROM user WHERE Username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "<script>alert('The username is already taken.'); window.location.href='newsignupphp.php';</script>";
        exit;
    }

    // Check if email already exists
    $stmt = $conn->prepare("SELECT Email FROM user WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "<script>alert('The email is already registered.'); window.location.href='newsignupphp.php';</script>";
        exit;
    }

    // Check if mobile number already exists
    $stmt = $conn->prepare("SELECT Mobile FROM user WHERE Mobile = ?");
    $stmt->bind_param("s", $mobile);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "<script>alert('The mobile number is already registered.'); window.location.href='newsignupphp.php';</script>";
        exit;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO user (Username, Email, Password, Mobile, Address) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $username, $email, $hashed_password, $mobile, $address);
    if ($stmt->execute()) {
        $_SESSION['success_message'] = 'You signed up successfully!';
        header("Location: welcome.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
