<?php require_once '../templates/db_connection.php'; ?>
<?php
	include '../templates/included_functions.php';
	include 'queries.php';

	$Title = isset($_POST ['title']) ? $_POST ['title'] : '';
	$Content = isset($_POST ['content']) ? $_POST ['content'] : '';

    $q  = create_post($Title,$Content);
    $check = mysqli_query($connection, $q)
            or die ('Error: insert failed'.mysql_error());  
    confirm_query($check);

    redirect_to('../forum.php');
?>