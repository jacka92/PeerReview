<?php
	require_once '../templates/db_connection.php';
	include '../included_functions.php';

//    $assessment = 9999;
//    $report = 9999;
//    $user = 9999;
//    $assessment1 = 9999;
    $comments = (isset($_POST['comment']) ? $_POST['comment'] : '');


    $q  = "INSERT INTO assessments (comments) VALUES ('{$comments}')";
    $check = mysqli_query($connection, $q)
            or die ('Error: insert failed'.mysql_error());  
    confirm_query($check);

    redirect_to('../viewreport.php');
?>
