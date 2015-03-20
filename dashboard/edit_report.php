<?php
	require_once '../templates/db_connection.php';
	include '../templates/included_functions.php';

    $report_id = mysqli_real_escape_string($connection,((isset($_POST['report_id']) ? $_POST['report_id'] : '')));
    $report_text = mysqli_real_escape_string($connection,((isset($_POST['report_text']) ? $_POST['report_text'] : '')));

    $q  = "UPDATE reports ";
    $q .= "SET report_text = ('{$report_text}')";
    $q .= "WHERE report_id = ('{$report_id}')";

    $check = mysqli_query($connection, $q)
            or die ('Error: insert failed'.mysql_error());  
    confirm_query($check);

    redirect_to('../dashboard.php');
?>
    