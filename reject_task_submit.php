<?php
	session_start();
	require_once("conn.php");
	$strlink = $_SERVER['PHP_SELF'];
	$uncutstr = strstr($strlink, 'reject_task_submit.php/', FALSE);
	$cutstr = str_replace("reject_task_submit.php/","",$uncutstr);

    if ($_FILES['attachment']['error'] === UPLOAD_ERR_OK)
    {
        $target_dir = "./uploads/";
        $base_name = basename($_FILES["attachment"]["name"]);
        $extension = pathinfo($base_name, PATHINFO_EXTENSION);
        $file_name = strval(rand(0,10000000000)) . "." . $extension;
        $target_file = $target_dir . $file_name;
        if (is_uploaded_file($_FILES['attachment']['tmp_name'])){
            move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file);
        }
        
    }

    $sql = "SELECT * FROM reports  WHERE report_id = $cutstr";
    $report = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($report, MYSQLI_BOTH);

    $task_id =  $row["task_id"];
    $comment = $_POST['comment'];
    $extend_deadline = $_POST['extend_deadline'];
    $sql = "UPDATE tasks 
            SET deadline = '$extend_deadline',
                work_progress = 'Rejected'
            WHERE task_id = $task_id";
    $conn->query($sql);
    $sql1 = "INSERT INTO responses(report_id,comment,deadline,attachment) VALUES ('$cutstr', '$comment', '$extend_deadline', '$file_name')";
    $conn->query($sql1);
    $sql2 = "UPDATE reports SET report_status = 'Rejected' WHERE report_id = $cutstr";
    $conn->query($sql2);

    $location = "location:/webfinal/head_index.php";
	
    header($location);
?>
