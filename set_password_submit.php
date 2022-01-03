<?php
    session_start();
    include 'conn.php';
    if (isset($_POST["save"])){
        $password = $_POST["password"];
        $userid = $_SESSION["userid"];
        $conn->query("UPDATE users SET password = $password WHERE userid=$userid");
        $_SESSION["password"] = $password;
    }
    include 'redirect.php';

?>