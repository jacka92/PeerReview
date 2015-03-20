<?php require_once '../templates/db_connection.php'; ?>
<?php
	include '../templates/included_functions.php';
	include 'queries.php';

    $Post = isset($_GET['thread']) ? $_GET['thread'] : '';

    if($Post === ''){
        $_SESSION['check'] = 2;
        redirect_to('../forum.php');
    }else{

        $query = get_thread_id($Post);
        $id_check = mysqli_query($connection, $query)
                or die ('Error: get thread id failed'.mysql_error());  
        confirm_query($id_check);

        while($Post_ID = mysqli_fetch_assoc($id_check)){
    ?>
            <form id="redirect" action="../forum_comments.php" method="post">
                <input type="text" name="view" value=<?php echo $Post_ID['post_id']; ?> style="position: absolute; display: none;">
            </form>
    <?php
        }
    }
?>

<script type="text/javascript">
    document.getElementById("redirect").submit();
</script>