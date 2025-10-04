<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database config
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sam";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $user = trim($_POST['username'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $pass = $_POST['password'] ?? '';
  $confirm = $_POST['confirm_password'] ?? '';

  // Validate fields
  if (empty($user) || empty($email) || empty($pass) || empty($confirm)) {
    echo "All fields are required.";
    exit;
  }

  // Validate password match
  if ($pass !== $confirm) {
    echo "Passwords do not match.";
    exit;
  }

  // Hash password
  $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

  // Insert into database
  $sql = "INSERT INTO users (username, email, password) VALUES ('$user', '$email', '$hashed_pass')";

  if ($conn->query($sql) === TRUE) {
    $_SESSION['username'] = $user;
    $_SESSION['email'] = $email;
    header("Location: profile.php");
    exit;
  } else {
    echo "Error: " . $conn->error;
  }

  $conn->close();
} else {
  echo "Invalid request.";
}
?>