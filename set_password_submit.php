<?php
    session_start();
    include 'conn.php';
    if (isset($_POST["save"])){
        $password = $_POST["password"];
        $userid = $_SESSION["userid"];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $conn->query("UPDATE users SET password = '$hashed_password' WHERE userid=$userid");
        $_SESSION["password"] = $password;
    }
    include 'redirect.php';

?>