<?php
    include 'conn.php';
    session_start();
    if (!isset($_SESSION["user"])){
        header("location:/webfinal/login.php");
    }

    if ($_SESSION["position"]!="director"){
        if (isset($_POST["add_leave_application"]) && $_POST["reason"]!='' && $_POST["numberofdays"]!=''){
            
            $reason = $_POST["reason"];
            $numberofdays = $_POST["numberofdays"];
            $file_name = "";
            $start_on = $_POST["start_date"];
            $userid = $_SESSION["userid"];
            $department_id = $_SESSION["department_id"];
            $position = $_SESSION["position"];
            $post_on = date("Y-m-d");
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
            $sql = "INSERT INTO leave_applications(userid,department_id,position,numberofdays,reason,attachment,start_on,post_on)
                        VALUES ($userid, $department_id, '$position', $numberofdays, '$reason', '$file_name', '$start_on', '$post_on')";
            mysqli_query($conn, $sql);
            
        }else{
            header("location: index.php");
        }
    }else{
        header("location:/webfinal/login.php");
    }
    header("location: worker_leave_management.php");

?>