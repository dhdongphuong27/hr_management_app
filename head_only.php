<?php
    $position = $_SESSION['position'];
    if (!isset($_SESSION["user"])){
        header("location:/webfinal/login.php");
    }else if ($_SESSION["password"]==$_SESSION["user"]){
        header("Location:/webfinal/set_password.php");
    }else if ($position=="employee"){
        header("location: employee_index.php");
    }else if ($position=="director"){
        header("location: director_index.php");
    }
?>