<?php
session_start();

// Redirect to index.html if session data is missing
if (!isset($_SESSION['username']) || !isset($_SESSION['email'])) {
  header("Location: index.html");
  exit;
}

$username = $_SESSION['username'];
$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Profile Page</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .profile-container {
      width: 350px;
      margin: 100px auto;
      padding: 20px;
      background-color: white;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      text-align: center;
    }
    .profile-pic {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      margin-bottom: 15px;
    }
    .success {
      color: green;
      font-weight: bold;
      margin-bottom: 10px;
    }
    .logout-btn {
      margin-top: 15px;
      padding: 8px 12px;
      background-color: #dc3545;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    .logout-btn:hover {
      opacity: 0.9;
    }
  </style>
</head>
<body>
  <div class="profile-container">
    <img src="profile.webp" alt="Profile Picture" class="profile-pic">
    <div class="success">Registration successful!</div>
    <p><strong>Username:</strong> <?php echo htmlspecialchars($username); ?></p>
    <p><strong>Email:</strong> <?php echo htmlspecialchars($email); ?></p>

    <form action="logout.php" method="POST">
      <button type="submit" class="logout-btn">Logout</button>
    </form>
  </div>
</body>
</html>