<?php
	require_once '../templates/db_connection.php';
	include '../templates/included_functions.php';

    $group_id = mysqli_real_escape_string($connection,(isset($_POST['group_id']) ? $_POST['group_id'] : ''));
    $report_text = mysqli_real_escape_string($connection,(isset($_POST['report_text']) ? $_POST['report_text'] : ''));

    $q  = "INSERT INTO reports (group_id, report_text) ";
    $q .= "VALUES ('{$group_id}', '{$report_text}')"; 

    $check = mysqli_query($connection, $q)
            or die ('Error: insert failed'.mysql_error());  
    confirm_query($check);

    redirect_to('../dashboard.php');
?>
    