<?php
    include 'conn.php';
    session_start();
    if (!isset($_SESSION["user"])){
        header("location:/webfinal/login.php");
    }
    if ($_SESSION["position"]=="director"){
        if (isset($_POST["delete_department"]) && $_POST["department_id"]!=''){
            $department_id = $_POST["department_id"];
            $sql = "DELETE FROM departments
                    WHERE department_id = $department_id";
            mysqli_query($conn, $sql);
        }else{
            header("location: department_management.php");
        }
    }else{
        header("location:/webfinal/login.php");
    }
    header("location: department_management.php");

?>