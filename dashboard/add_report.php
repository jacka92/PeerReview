<?php
	require_once '../templates/db_connection.php';
	include '../templates/included_functions.php';

    $report_id = (isset($_POST['report_id']) ? $_POST['report_id'] : '');
    $group_id = (isset($_POST['group_id']) ? $_POST['group_id'] : '');
    $report_text = (isset($_POST['report_text']) ? $_POST['report_text'] : '');

    $q  = "INSERT INTO reports (report_id, group_id, report_text) ";
    $q .= "VALUES ('{$report_id}', '{$group_id}', '{$report_text}')"; 

    $check = mysqli_query($connection, $q)
            or die ('Error: insert failed'.mysql_error());  
    confirm_query($check);

    redirect_to('../dashboard.php');
?>
    