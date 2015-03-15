<?php
	require_once '../templates/db_connection.php';
	include '../included_functions.php';

	$Title = isset($_POST ['title']) ? $_POST ['title'] : '';
	$Content = isset($_POST ['content']) ? $_POST ['content'] : '';

    $q  = "INSERT INTO forum (post_id, post_title, post_content, post_date) VALUES (NULL, '{$Title}', '{$Content}', CURRENT_TIMESTAMP)";
    $check = mysqli_query($connection, $q)
            or die ('Error: insert failed'.mysql_error());  
    confirm_query($check);

    redirect_to('../forum.php');
?>