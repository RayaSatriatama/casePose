<?php
session_start();
include 'connection.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {
        
        header("Location: ../sign-in.php?pesan=kosong");
        exit();
    }

    $sql = "SELECT * FROM user WHERE email='$email' AND password='$password'";
    $cek = mysqli_query($conn,$sql);
    $result = mysqli_num_rows($cek);

    if ($result == 1) {

        $_SESSION["email"] = $email;
        $_SESSION["status"] = "login";
        header("Location: ../after/index.html"); 
        exit(); 
    } else {
       
        header("Location: ../sign-in.php?pesan=gagal");
        exit(); 
    }

    $conn->close();
}
?>
