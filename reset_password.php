<?php
    session_start();
    include 'conn.php';
    if (isset($_POST["reset_password"])){
        $username = $_POST["username"];
        $hashed_password = password_hash($username, PASSWORD_DEFAULT);
        $conn->query("UPDATE users SET password = '$hashed_password' WHERE username='$username'");
    }
    header("Location:/webfinal/employee_details.php/".$_POST["userid"])

?>