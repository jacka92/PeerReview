<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

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
    
    //query handling
    $query = "SELECT * "; 
    $query .= "FROM assessments ";
    
    $result = mysqli_query($connection, $query);

    //query error handling
    if (!$result){
        die("Database query failed.");
    }
    
?>




<html>
    <form action="reports.php"><input type = "submit" value = "Go to Reports"></form>
    <form action="users.php"><input type = "submit" value = "Go to Users"></form>
    
    <h1>Assessments</h1>
    
    <ul>
        <?php
        //PHP insertion
            while($row = mysqli_fetch_assoc($result)){
                echo "<li>"."Assessment ID: ". $row["assessment_id"]. "</li>"; 
                echo "<li>"."Assessment Score: ". $row["assessment"]. "</li>";
                echo "<li>"."Report ID: ". $row["report_id"]. "</li>";
                echo "<li>"."User ID: ". $row["user_id"]. "</li>";
                echo "<hr />";
            }
        ?>
    </ul>
   
</html>

<?php
    mysqli_close($connection);
?>