<?php
	require_once '../templates/db_connection.php';
	include '../templates/included_functions.php';

    $report_id = (isset($_POST['report_id']) ? $_POST['report_id'] : '');
    $user_id = (isset($_POST['user_id']) ? $_POST['user_id'] : '');
    $assessment = (isset($_POST['assessment']) ? $_POST['assessment'] : '');
    $comments = (isset($_POST['comments']) ? $_POST['comments'] : '');

    $q  = "INSERT INTO assessments (report_id, user_id, assessment, comments) ";
    $q .= "VALUES ('{$report_id}}', '{$user_id}', '{$assessment}', '{$comments}')"; 

    $check = mysqli_query($connection, $q)
            or die ('Error: insert failed'.mysql_error());  
    confirm_query($check);

    redirect_to('../viewreport.php');
?>
    