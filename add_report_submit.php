<?php
    include 'conn.php';
    session_start();
    if (!isset($_SESSION["user"])){
        header("location:/webfinal/login.php");
    }

    if ($_SESSION["position"]=="employee"){
        if (isset($_POST["add_report"])){
            
            $report_description = $_POST["report_description"];
            $task_id = $_POST["task_id"];
            $current_date = new DateTime("now", new DateTimeZone('Asia/Ho_Chi_Minh'));
            $current_date = $current_date->format('Y-m-d H:i:s');
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
            $sql = "INSERT INTO reports(task_id,report_description,attachment,submit_date)
                        VALUES ('$task_id', '$report_description', '$file_name', '$current_date')";
            mysqli_query($conn, $sql);
            $sql1 = "UPDATE tasks SET work_progress = 'Waiting' WHERE task_id = $task_id";
            mysqli_query($conn, $sql1);
            
        }else{
            header("location:reports.php/".$task_id);
        }
    }else{
        header("location:/webfinal/login.php");
    }
    header("location:reports.php/".$task_id);

?>