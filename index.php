<?php include 'dbConfig.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Users List</title>
</head>
<body>

<h2>All Users</h2>
<a href="create.php">Add User</a> | 
<a href="exportCsv.php">Export CSV</a> | 
<a href="exportPdf.php">Export PDF</a>

<form method="GET">
    Search: <input type="text" name="search" value="<?= $_GET['search'] ?? '' ?>">
    <button type="submit">Search</button>
</form>

<?php

$limit = 5;
$page = $_GET['page'] ?? 1;
$start = ($page - 1) * $limit;

$search = $_GET['search'] ?? '';
$sort = $_GET['sort'] ?? 'id';
$order = $_GET['order'] ?? 'ASC';

$sql = "SELECT * FROM users WHERE name LIKE '%$search%' 
        ORDER BY $sort $order LIMIT $start, $limit";
$result = $conn->query($sql);

$total = $conn->query("SELECT COUNT(*) AS cnt FROM users WHERE name LIKE '%$search%'")->fetch_assoc()['cnt'];
$pages = ceil($total / $limit);
?>

<table border="1" cellpadding="5">
<tr>
    <th><a href="?sort=name&order=<?= $order=='ASC'?'DESC':'ASC' ?>">Name</a></th>
    <th>Email</th>
    <th>Phone</th>
    <th>Profile Pic</th>
    <th>Resume</th>
    <th>Actions</th>
</tr>

<?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['name'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['phone'] ?></td>
    <td><img src="<?= $row['profile_pic'] ?>" width="50"></td>
    <td><a href="<?= $row['resume'] ?>" target="_blank">Download</a></td>
    <td>
        <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
        <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete user?')">Delete</a>
    </td>
</tr>
<?php endwhile; ?>
</table>

<div>
<?php for ($i = 1; $i <= $pages; $i++): ?>
    <a href="?page=<?= $i ?>&search=<?= $search ?>"><?= $i ?></a>
<?php endfor; ?>
</div>

</body>
</html>
