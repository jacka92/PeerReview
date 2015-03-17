<?php
	require_once '../templates/db_connection.php';
	include '../templates/included_functions.php';

    $report_id = (isset($_POST['report_id']) ? $_POST['report_id'] : '');
    $user_id = (isset($_POST['user_id']) ? $_POST['user_id'] : '');
    $assessment1 = 22;
    $comments = (isset($_POST['comment']) ? $_POST['comment'] : '');


    $q  = "INSERT INTO assessments (report_id, user_id, comments) ";
    $q .= "VALUES (report_id='{$report_id}}',user_id='{$user_id}',comments='{$comments}')"; 

    $check = mysqli_query($connection, $q)
            or die ('Error: insert failed'.mysql_error());  
    confirm_query($check);

    redirect_to('../viewreport.php');
?>
    