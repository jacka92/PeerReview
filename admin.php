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



<!--
     administrator-users will have a separate interface through which student registration will be managed and
groups defined from the student registration list
    
     the administrator-user interface will support searching for details of a particular student and browsing of
student details
    
     the administrator-user interface will allow particular groups to be allocated to the peer assessment of
particular other groups
    
     the administrator-users will be able to see a list of the groups ranked according with the aggregation of peer
assessments on their submissions
-->