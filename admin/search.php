<?php require_once '../templates/db_connection.php'; ?>
<?php
	include '../templates/included_functions.php';
	include 'queries.php';

    $User = isset($_GET['user']) ? $_GET['user'] : '';

    if($User === ''){
        $_SESSION['check'] = 3;
        redirect_to('../admin.php');
    }else{

        $query = get_user_id($User);
        $id_check = mysqli_query($connection, $query)
                or die ('Error: get user id failed'.mysql_error());  
        confirm_query($id_check);

        while($User_Details = mysqli_fetch_assoc($id_check)){
            $User_ID = $User_Details['user_id'];
    ?>
                <form id="redirect" action="../admin_search_results.php" method="post">
                    <input type="text" name="view" value=<?php echo $User_ID ?> style="position: absolute; display: none;">
                </form>
    <?php
        }
    }
?>

<script type="text/javascript">
    document.getElementById("redirect").submit();
</script>