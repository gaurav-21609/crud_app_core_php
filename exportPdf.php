<?php
require 'vendor/autoload.php';
include 'dbConfig.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$html = '<h2>User List</h2><table border="1" width="100%" cellspacing="0" cellpadding="5">
<tr><th>Name</th><th>Email</th><th>Phone</th></tr>';

$result = $conn->query("SELECT * FROM users");
while ($row = $result->fetch_assoc()) {
    $html .= "<tr>
                <td>{$row['name']}</td>
                <td>{$row['email']}</td>
                <td>{$row['phone']}</td>
              </tr>";
}
$html .= "</table>";

$dompdf->loadHtml($html);
$dompdf->render();
$dompdf->stream("users.pdf");
?>
