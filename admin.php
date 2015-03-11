<?php
    require_once 'templates/db_connection.php';
?>

<html>
    <head>
        
        <title>Admin page</title>
        <?php include 'templates/imports.php';?>

    </head>

    <body role='document'>

        <?php include 'templates/template_header.php';?>


        <?php include 'templates/template footer.php';?>
    </body>
</html>

<?php
    mysqli_close($connection);
?>