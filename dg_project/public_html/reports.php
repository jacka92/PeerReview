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
    $query .= "FROM reports ";
    
    $result = mysqli_query($connection, $query);

    //query error handling
    if (!$result){
        die("Database query failed.");
    }
    
?>




<html>
  
    <form action="assessments.php"><input type = "submit" value = "Go to Assessments"></form>
    <form action="users.php"><input type = "submit" value = "Go to Users"></form>
    
    <h1>Reports</h1>
    
    <ul>
        <?php
        //PHP insertion
            while($row = mysqli_fetch_assoc($result)){
                echo "<li>"."Report ID : ". $row["report_id"]. "</li>"; 
                echo "<li>"."Group ID: ". $row["group_id"]. "</li>";
                echo "<li>"."Mark Aggregate: ". $row["mark_aggregate"]. "</li>";
                echo "<hr />";
            }
        ?>
    </ul>
   
</html>

<?php
    mysqli_close($connection);
?>