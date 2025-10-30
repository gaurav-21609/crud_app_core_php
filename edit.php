<?php include 'dbConfig.php'; ?>

<?php
$id = $_GET['id'];
$user = $conn->query("SELECT * FROM users WHERE id=$id")->fetch_assoc();

if (isset($_POST['update'])) {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $profile_pic = $user['profile_pic'];
    $resume = $user['resume'];

    if (!empty($_FILES['profile_pic']['name'])) {
        $profile_pic = 'uploads/' . basename($_FILES['profile_pic']['name']);
        move_uploaded_file($_FILES['profile_pic']['tmp_name'], $profile_pic);
    }
    if (!empty($_FILES['resume']['name'])) {
        $resume = 'uploads/' . basename($_FILES['resume']['name']);
        move_uploaded_file($_FILES['resume']['tmp_name'], $resume);
    }

    $sql = "UPDATE users SET 
            name='$name', email='$email', phone='$phone',
            profile_pic='$profile_pic', resume='$resume'
            WHERE id=$id";
    $conn->query($sql);
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head><title>Edit User</title></head>
<body>
<h2>Edit User</h2>
<form method="POST" enctype="multipart/form-data">
    Name: <input type="text" name="name" value="<?= $user['name'] ?>"><br><br>
    Email: <input type="email" name="email" value="<?= $user['email'] ?>"><br><br>
    Phone: <input type="text" name="phone" value="<?= $user['phone'] ?>"><br><br>
    Profile Picture: <input type="file" name="profile_pic"><br><br>
    Resume: <input type="file" name="resume"><br><br>
    <button type="submit" name="update">Update</button>
</form>
</body>
</html>
