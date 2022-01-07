<?php
	session_start();
	require_once("conn.php");
	$strlink = $_SERVER['PHP_SELF'];
	$uncutstr = strstr($strlink, 'cancel_task.php/', FALSE);
	$cutstr = str_replace("cancel_task.php/","",$uncutstr);

    $sql = "UPDATE tasks SET work_progress = 'Canceled' WHERE task_id = $cutstr";
    $conn->query($sql);

    $location = "location:/webfinal/head_index.php";
	
    header($location);
?>
