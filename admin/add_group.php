<?php
	require_once '../templates/db_connection.php';
	include '../included_functions.php';

    $q  = "INSERT INTO groups (group_id) VALUES (NULL)";
    $check = mysqli_query($connection, $q);
            or die ('Error: insert failed'.mysql_error());  
    confirm_query($check);

    redirect_to('../admin.php');
?>