<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
    <head>
        
        <title>Insert Assessments</title>
        <?php include 'templates/imports.php';?>

    </head>

    <body role='document'>
        <?php include 'templates/template header.php';?>

        <form action="assessments.php"><input type = "submit" value = "Return"></form>

        <?php include 'templates/template footer.php';?>
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
    $assessment = 0;
    $report_id = 0;
    $user_id = 0;
    
    //delete query handling
    $query = "INSERT INTO assessments ";
    $query .= "(assessment_id, assessment, report_id, user_id) ";
    $query .= "VALUES ";
    $query .= "('{$assessment_id}','{$assessment}','{$report_id}','{$user_id}')";
    
    $result = mysqli_query($connection, $query);

    //query error handling
    if ($result && mysqli_affected_rows($connection) == 1){
        echo "Success!";
    }else{
        die("Insert failed. No changes made to database.") .mysqli_error($connection);
    }
    

    mysqli_close($connection);
?>