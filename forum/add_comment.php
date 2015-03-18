<?php require_once '../templates/db_connection.php'; ?>
<?php
	include '../templates/included_functions.php';
	include 'queries.php';

	$Title = isset($_POST ['title']) ? $_POST ['title'] : '';
	$Content = isset($_POST ['content']) ? $_POST ['content'] : '';
	$Post = isset($_POST ['post_id']) ? $_POST ['post_id'] : '';

    $q  = create_comment($Title,$Content,$Post);
    $check = mysqli_query($connection, $q)
            or die ('Error: insert failed'.mysql_error());  
    confirm_query($check);
?>

<form id="redirect" action="../view_forum_comments.php" method="post">
	<input type="text" name="view" value=<?php echo $_POST ['post_id']; ?> style="position: absolute; display: none;">
</form>

<script type="text/javascript">
	document.getElementById("redirect").submit();
</script>