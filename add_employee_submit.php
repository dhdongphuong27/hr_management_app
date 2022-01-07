<?php
    include 'conn.php';
    session_start();
    if (!isset($_SESSION["user"])){
        header("location:login.php");
    }

    if ($_SESSION["position"]=="director"){
        if (isset($_POST["add_employee"]) && $_POST["fullname"]!='' && $_POST["username"]!='' && $_POST["department_id"]!=''){
            $fullname = $_POST["fullname"];
            $username = $_POST["username"];
            $hashed_password = password_hash($username, PASSWORD_DEFAULT);
            $department_id = $_POST["department_id"];
            $check_username = "SELECT * FROM users WHERE username='$username'";
            $old = mysqli_query($conn, $check_username);
            if (mysqli_num_rows($old)>0){
                header("location: add_employee.php");
            }else{
                $sql = "INSERT INTO users(username,password,fullname,department_id) 
                        VALUES ('$username', '$hashed_password', '$fullname', '$department_id')";
                mysqli_query($conn, $sql);
                header("location: account_management.php");
            }
            
        }else{
            header("location: add_employee.php");
        }
    }else{
        header("location:login.php");
    }
    

?>