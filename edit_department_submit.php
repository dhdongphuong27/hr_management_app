<?php
    include 'conn.php';
    session_start();
    if (!isset($_SESSION["user"])){
        header("location:login.php");
    }
    if ($_SESSION["position"]=="director"){
        if (isset($_POST["save_department"]) && $_POST["department_name"]!='' && $_POST["room_id"]!='' && $_POST["department_description"]!=''){
            $department_name = $_POST["department_name"];
            $room_id = $_POST["room_id"];
            $department_description = $_POST["department_description"];
            $department_id = (int)$_POST["department_id"];
            $head_id = (int)$_POST["head_id"];
            $sql = "UPDATE departments 
                    SET department_name = '$department_name', 
                        room_id = '$room_id', 
                        department_description = '$department_description',
                        head_id = $head_id
                    WHERE department_id = $department_id";
            mysqli_query($conn, $sql);
            $sql1 = "UPDATE users 
                     SET position='employee'
                     WHERE department_id = $department_id";
            mysqli_query($conn, $sql1);
            $sql2 = "UPDATE users 
                     SET position='head'
                     WHERE userid = $head_id";
            mysqli_query($conn, $sql2);
        }else{
            header("location: department_management.php");
        }
    }else{
        header("location:login.php");
    }
    header("location: department_management.php");

?>