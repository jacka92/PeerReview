<?php require_once '../templates/db_connection.php'; ?>
<?php
	include '../templates/included_functions.php';
	include 'queries.php';

    $User = isset($_GET['user']) ? $_GET['user'] : '';

    if($User === ''){
        $_SESSION['check'] = 2;
        redirect_to('../forum.php');
    }else{

        $query = get_user_id($User);
        $id_check = mysqli_query($connection, $query)
                or die ('Error: get user id failed'.mysql_error());  
        confirm_query($id_check);

        while($User_Details = mysqli_fetch_assoc($id_check)){
            $User_ID = $User_Details['user_id'];
            $q = user_threads($User_ID);
            $check = mysqli_query($connection, $q)
                    or die ('Error: user threads failed'.mysql_error());  
            confirm_query($check);

            if(count($check)>1){
    ?>
                <form id="redirect" action="../forum_search_results.php" method="post">
                    <input type="text" name="view" value=<?php echo $User_ID ?> style="position: absolute; display: none;">
                </form>
    <?php
            }elseif(count($check)==1){
                $q2 = get_post_id($User_ID);
                $check2 = mysqli_query($connection, $q2)
                    or die ('Error: get post id failed'.mysql_error());  
                confirm_query($check2);
                while($Post_ID = mysqli_fetch_assoc($check2)){
    ?>
                    <form id="redirect" action="../forum_comments.php" method="post">
                        <input type="text" name="view" value=<?php echo $Post_ID['post_id']; ?> style="position: absolute; display: none;">
                    </form>
    <?php
                }
            }else{
                $_SESSION['check'] = 2;
                redirect_to('../forum.php');
            }
        }
    }
?>

<script type="text/javascript">
    document.getElementById("redirect").submit();
</script>