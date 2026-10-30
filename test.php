<?php include 'config.php';
echo "Connected sa grading_system database!<br>";
$result = $conn->query("SELECT COUNT(*) as c FROM students");
$row = $result->fetch_assoc();
echo "Total students: " . $row['c'];
?>