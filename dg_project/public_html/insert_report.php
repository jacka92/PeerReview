<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
      <form action="reports.php"><input type = "submit" value = "Return"></form>

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
    $report_id = 999;
    $group_id = 0;
    $mark_aggregate = 0;
    
    //delete query handling
    $query = "INSERT INTO reports ( ";
    $query .= "report_id, group_id, mark_aggregate ";
    $query .= ") VALUES ( ";
    $query .= "'{$report_id}''{$group_id}','{$mark_aggregate}' ";
    $query .= ")";
    
    $result = mysqli_query($connection, $query);

    //query error handling
    if ($result && mysqli_affected_rows($connection) == 1){
        echo "Success!";
    }else{
        die("Insert failed. No changes made to database.") . mysqli_error($connection);
    }
    

    mysqli_close($connection);
?>