<?php
session_start();
include('includes/config.php');

if(isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Encrypting the password using MD5 (not recommended for production, consider using more secure hashing methods)

    $query = mysqli_query($conn, "SELECT * FROM register WHERE email = '$email'") or die(mysqli_error());
    $count = mysqli_num_rows($query);

    if ($count > 0) {
        echo '<script>alert("Data Already Exists");</script>';
    } else {
        mysqli_query($conn, "INSERT INTO register(fullName, email, password) VALUES ('$name', '$email', '$password')") or die(mysqli_error());
        echo '<script>alert("Records Successfully Added");</script>';
        echo '<script>window.location = "indux.html";</script>';
    }
}
?>
