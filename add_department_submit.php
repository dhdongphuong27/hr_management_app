<?php
    include 'conn.php';
    session_start();
    if (!isset($_SESSION["user"])){
        header("location:login.php");
    }

    if ($_SESSION["position"]=="director"){
        if (isset($_POST["add_department"]) && $_POST["name"]!='' && $_POST["roomid"]!='' && $_POST["description"]!=''){
            $department_name = $_POST["name"];
            $roomid = $_POST["roomid"];
            $description = $_POST["description"];
            $sql = "INSERT INTO departments(department_name,room_id,department_description) VALUES ('$department_name', '$roomid', '$description')";
            mysqli_query($conn, $sql);
        }else{
            header("location: add_department.php");
        }
    }else{
        header("location:login.php");
    }
    header("location: department_management.php");

?>