<?php
    $position = $_SESSION['position'];
    if ($_SESSION["password"]==$_SESSION["user"]){
        header("Location:/webfinal/set_password.php");
    }else if ($position=="employee"){
        header("location: employee_index.php");
    }else if ($position=="head"){
        header("location: head_index.php");
    }
?>