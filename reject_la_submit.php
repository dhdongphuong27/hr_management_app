<?php
	session_start();
	require_once("conn.php");
	$strlink = $_SERVER['PHP_SELF'];
	$uncutstr = strstr($strlink, 'reject_la_submit.php/', FALSE);
	$cutstr = str_replace("reject_la_submit.php/","",$uncutstr);

    $sql = "UPDATE leave_applications SET status = 'refused' WHERE la_id = $cutstr";
    $conn->query($sql);

    $location = "location:/webfinal/approver_leave_management.php";
	
    header($location);
?>
