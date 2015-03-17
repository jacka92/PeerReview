<?php
	require_once '../templates/db_connection.php';
	include '../included_functions.php';

    $assessment = 22;
    $report_id = (isset($_POST['report_id']) ? $_POST['report_id'] : '');
    $user = 22;
    $assessment1 = 22;
    $comments = (isset($_POST['comment']) ? $_POST['comment'] : '');


    $q  = "INSERT INTO assessments (report_id, comments) VALUES ('{$report_id}}','{$comments}')"; 

    $check = mysqli_query($connection, $q)
            or die ('Error: insert failed'.mysql_error());  
    confirm_query($check);

    redirect_to('../viewreport.php');
?>
    