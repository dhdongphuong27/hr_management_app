<?php
    session_start();
    include 'conn.php';
    if (isset($_POST["reset_password"])){
        $username = $_POST["username"];
        $conn->query("UPDATE users SET password = '$username' WHERE username='$username'");
    }
    header("Location:/webfinal/account_management.php")

?>