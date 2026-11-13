<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
    <p>You have successfully logged into the CAT 2 PHP Web Application.</p>
    <p><a href="feedback.php">Go to Course Feedback Form</a> | <a href="logout.php">Logout</a></p>
</body>
</html>