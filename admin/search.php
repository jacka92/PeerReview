<?php require_once '../templates/db_connection.php'; ?>
<?php
	include '../templates/included_functions.php';
	include 'queries.php';

    $User = isset($_GET['user']) ? $_GET['user'] : '';

    if($User === ''){
        $_SESSION['check'] = 3;
        redirect_to('../admin.php');
    }else{
        $_SESSION['check'] = 4;
?>
            <form id="redirect" action="../admin.php" method="post">
                <input type="text" name="view" value=<?php echo $User ?> style="position: absolute; display: none;">
            </form>
<?php
    }
?>

<script type="text/javascript">
    document.getElementById("redirect").submit();
</script>