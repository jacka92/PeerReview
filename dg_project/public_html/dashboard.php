<!DOCTYPE html>

<?php
    //Creating the db connection
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpassword = '';
    $dbname = 'peer_assessment';
    
    $connection = mysqli_connect($dbhost,$dbuser,$dbpassword,$dbname);
    
    //error handling
    if (mysqli_connect_errno()){
           die("Database connection failed: "
               .mysqli_connect_error()
               ." (" .mysqli_connect_errno(). ")"
              );
    }
    
?>



<html>
    <head>
        
        <title>Dashboard</title>
        <?php include 'templates/imports.php';?>

    </head>

    <body role='document'>

        <?php include 'templates/template header.php';?>

        <h1>Dat home page though</h1>

        <form action="reports.php"><input type = "submit" value = "Go to Reports"></form>
        <form action="users.php"><input type = "submit" value = "Go to Users"></form>
        <form action="assessments/insert_assessment.php"><input type = "submit" value = "Insert an Ass"></form>
        

        <?php include 'templates/template footer.php';?>
    </body>
</html>