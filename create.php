<?php include 'dbConfig.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
</head>
<body>
<h2>Add New User</h2>

<form method="POST" enctype="multipart/form-data">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Phone: <input type="text" name="phone" required><br><br>
    Profile Picture: <input type="file" name="profile_pic" required><br><br>
    Resume: <input type="file" name="resume" required><br><br>
    <button type="submit" name="submit">Save</button>
</form>

<?php
if (isset($_POST['submit'])) {
    $name  = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $profile_pic = 'uploads/profile_picture/' . basename($_FILES['profile_pic']['name']);
    $resume      = 'uploads/resume/' . basename($_FILES['resume']['name']);

    move_uploaded_file($_FILES['profile_pic']['tmp_name'], $profile_pic);
    move_uploaded_file($_FILES['resume']['tmp_name'], $resume);

    $sql = "INSERT INTO users (name, email, phone, profile_pic, resume)
            VALUES ('$name', '$email', '$phone', '$profile_pic', '$resume')";
    if ($conn->query($sql)) {
        echo "User added successfully!";
         header("Location: index.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
</body>
</html>
