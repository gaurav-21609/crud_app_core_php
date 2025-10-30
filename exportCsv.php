<?php
include 'dbConfig.php';
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="users.csv"');

$output = fopen("php://output", "w");
fputcsv($output, ['ID', 'Name', 'Email', 'Phone', 'Profile Pic', 'Resume']);

$result = $conn->query("SELECT * FROM users");
while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}
fclose($output);
?>
