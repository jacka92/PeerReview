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
    <td><input type="submit" name="Submit" value="Login"></td>
    <h1>Assessment Page</h1>
    
    <ul>
        <?php
        //PHP insertion
            while($row = mysqli_fetch_assoc($result)){
                echo "<li>"."Assessment ID: ". $row["Assessment_ID"]. "</li>"; 
                echo "<li>"."Assessment Score: ". $row["Assessment"]. "</li>";
                echo "<li>"."Report ID: ". $row["Report_ID"]. "</li>";
                echo "<li>"."User ID: ". $row["User_ID"]. "</li>";
                echo "<hr />";
            }
        ?>
    </ul>
   
</html>

<?php
    mysqli_close($connection);
?>