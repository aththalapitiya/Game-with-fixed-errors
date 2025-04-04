<?php
include "../includes/db.php"; //--> database conn here

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  //--> hashes the password

    $stmt = $conn->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $email, $username, $password);

    if ($stmt->execute()) {
        echo "<script>alert('Registration successful!'); window.location.href='../pages/signin.php';</script>";
    } else {
        echo "<script>alert('Error: Username or Email already exists!'); window.location.href='../pages/signup.php';</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
