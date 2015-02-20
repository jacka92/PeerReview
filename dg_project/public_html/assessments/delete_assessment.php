<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
    <head>
        
        <title>Delete Assessments</title>
        <?php include '../templates/imports.php';?>

    </head>

    <body role='document'>
        <?php include '../templates/template header.php';?>

        <form action="assessments.php"><input type = "submit" value = "Return"></form>

        <?php include '../templates/template footer.php';?>
    </body>

</html>


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
    
    //Test update
    $assessment_id = 999;
    
    //delete query handling
    $query = "DELETE FROM assessments "; 
    $query .= "WHERE assessment_id ='{$assessment_id}' ";
    $query .= "LIMIT 1";
    
    $result = mysqli_query($connection, $query);

    //query error handling
    if ($result && mysqli_affected_rows($connection) == 1){
        echo "Success!";
    }else{
        die("Delete failed. No changes made to database.");
    }
    

    mysqli_close($connection);
?>