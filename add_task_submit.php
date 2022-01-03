<?php
    include 'conn.php';
    session_start();
    if (!isset($_SESSION["user"])){
        header("location:login.php");
    }

    if ($_SESSION["position"]=="head"){
        if (isset($_POST["add_task"]) && $_POST["task_name"]!='' && $_POST["task_description"]!='' && $_POST["assignee_id"]!=''){
            
            $task_name = $_POST["task_name"];
            $task_description = $_POST["task_description"];
            $assignee_id = $_POST["assignee_id"];
            $file_name = "";
            $department_id = $_SESSION['department_id'];
            $current_date = date('Y-m-d H:i:s');
            $deadline = $_POST["deadline"];
            if ($_FILES['attachment']['error'] === UPLOAD_ERR_OK)
            {
                $target_dir = "./uploads/";
                $base_name = basename($_FILES["attachment"]["name"]);
                $extension = pathinfo($base_name, PATHINFO_EXTENSION);
                $file_name = strval(rand(0,10000000)) . "." . $extension;
                $target_file = $target_dir . $file_name;
                if (is_uploaded_file($_FILES['attachment']['tmp_name'])){
                    move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file);
                }
        
            }
            $sql = "INSERT INTO tasks(task_name,task_description,department_id,assignee_id,attachment,assigned_at,deadline)
                        VALUES ('$task_name', '$task_description', '$department_id', '$assignee_id', '$file_name', '$current_date','$deadline')";
            mysqli_query($conn, $sql);
            
        }else{
            header("location: add_task.php");
        }
    }else{
        header("location:login.php");
    }
    header("location: head_task_management.php");

?>