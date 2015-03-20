<?php require_once '../templates/db_connection.php'; ?>
<?php
	include '../templates/included_functions.php';
	include 'queries.php';

	$Title = mysqli_real_escape_string($connection,(isset($_POST ['title']) ? $_POST ['title'] : ''));
	$Content = mysqli_real_escape_string($connection,(isset($_POST ['content']) ? $_POST ['content'] : ''));

    $sql  = "SELECT * FROM forum WHERE post_title = '{$Title}'";
    $check = mysqli_query($connection, $sql) or die("Query to check if post title exists failed");
    confirm_query($check);

    if(!null == (mysqli_fetch_assoc($check))){
        $_SESSION ['check'] = 3;
    }else{
        $q  = create_post($Title,$Content);
        $check2 = mysqli_query($connection, $q)
                or die ('Error: insert failed'.mysql_error());  
        confirm_query($check2);

        $_SESSION ['check'] = 1;
    }

    redirect_to('../forum.php');
?>