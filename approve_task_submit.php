<?php
	session_start();
	require_once("conn.php");
	$strlink = $_SERVER['PHP_SELF'];
	$uncutstr = strstr($strlink, 'approve_task_submit.php/', FALSE);
	$cutstr = str_replace("approve_task_submit.php/","",$uncutstr);

    $sql = "SELECT * FROM reports  WHERE report_id = $cutstr";
    $report = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($report, MYSQLI_BOTH);

    $completion_level = $_POST["btnradio"];
    $completion_status = $_POST["completion_status"];
    $task_id =  $row["task_id"];

    echo $completion_status;
    $sql = "UPDATE reports SET report_status = '$completion_level', completion_status = '$completion_status' WHERE report_id = $cutstr";
    $conn->query($sql);

    $sql1 = "UPDATE tasks 
             SET work_progress = 'Completed', 
                 completion_level = '$completion_level' 
             WHERE task_id = $task_id";
    $conn->query($sql1);


    $location = "location:/webfinal/head_index.php";
	
    header($location);
?>
