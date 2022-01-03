<?php
	session_start();
	require_once("conn.php");
	$strlink = $_SERVER['PHP_SELF'];
	$uncutstr = strstr($strlink, 'start_task_submit.php/', FALSE);
	$cutstr = str_replace("start_task_submit.php/","",$uncutstr);

    $sql = "UPDATE tasks SET work_progress = 'In progress' WHERE task_id = $cutstr";
    $conn->query($sql);

    $location = "location:/webfinal/task_details.php/" . $cutstr;
	
    header($location);
?>
