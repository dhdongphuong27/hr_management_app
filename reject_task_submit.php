<?php
	session_start();
	require_once("conn.php");
	$strlink = $_SERVER['PHP_SELF'];
	$uncutstr = strstr($strlink, 'reject_task_submit.php/', FALSE);
	$cutstr = str_replace("reject_task_submit.php/","",$uncutstr);

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
    $sql1 = "INSERT INTO responses(report_id,comment,deadline) VALUES ('$cutstr', '$comment', '$extend_deadline')";
    $conn->query($sql1);
    $sql2 = "UPDATE reports SET report_status = 'Rejected' WHERE report_id = $cutstr";
    $conn->query($sql2);

    $location = "location:/webfinal/head_task_management.php/";
	
    header($location);
?>
