<?php
    $position = $_SESSION['position'];
    if (!isset($_SESSION["user"])){
        header("location:login.php");
    }else if (password_verify($_SESSION["user"], $_SESSION["password"])){
        header("Location:/webfinal/set_password.php");
    }else if ($position=="employee"){
        header("location: employee_index.php");
    }else if ($position=="head"){
        header("location: head_index.php");
    }else if ($position=="director"){
        header("location: director_index.php");
    }
?>