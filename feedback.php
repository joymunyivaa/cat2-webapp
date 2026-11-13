<?php
require 'db.php';
$status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_name = trim($_POST['student_name']);
    $unit_code = trim($_POST['unit_code']);
    $comments = trim($_POST['comments']);

    $stmt = $conn->prepare("INSERT INTO feedback (student_name, unit_code, comments) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $student_name, $unit_code, $comments);

    if ($stmt->execute()) {
        $status = "Feedback submitted successfully!";
    } else {
        $status = "Error: " . $stmt->error;
    }
    $stmt->close();
}

$result = $conn->query("SELECT * FROM feedback ORDER BY submitted_at DESC");
?>
<!DOCTYPE html>
<html>
<head><title>Unit Feedback Form</title></head>
<body>
    <h2>Submit Unit Feedback</h2>
    <?php if ($status) echo "<p style='color:green;'>$status</p>"; ?>
    <form method="POST" action="">
        <label>Student Name:</label><br>
        <input type="text" name="student_name" required><br><br>
        <label>Unit Code:</label><br>
        <input type="text" name="unit_code" value="CNS 3102" required><br><br>
        <label>Comments:</label><br>
        <textarea name="comments" rows="3" cols="35" required></textarea><br><br>
        <button type="submit">Submit Feedback</button>
    </form>

    <hr>
    <h3>Retrieved Submissions from CAT2.feedback</h3>
    <table border="1" cellpadding="6">
        <tr>
            <th>ID</th>
            <th>Student Name</th>
            <th>Unit Code</th>
            <th>Comments</th>
            <th>Submitted At</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['student_name']); ?></td>
            <td><?php echo htmlspecialchars($row['unit_code']); ?></td>
            <td><?php echo htmlspecialchars($row['comments']); ?></td>
            <td><?php echo $row['submitted_at']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>