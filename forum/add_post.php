<?php require_once '../templates/db_connection.php'; ?>
<?php
	include '../templates/included_functions.php';
	include 'queries.php';

	$Title = mysqli_real_escape_string($connection,(isset($_POST ['title']) ? $_POST ['title'] : ''));
	$Content = mysqli_real_escape_string($connection,(isset($_POST ['content']) ? $_POST ['content'] : ''));

    $q  = create_post($Title,$Content);
    $check = mysqli_query($connection, $q)
            or die ('Error: insert failed'.mysql_error());  
    confirm_query($check);

    $_SESSION ['check'] = 1;

    redirect_to('../forum.php');
?>