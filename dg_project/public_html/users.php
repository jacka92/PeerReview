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
    $query .= "FROM users ";
    
    $result = mysqli_query($connection, $query);

    //query error handling
    if (!$result){
        die("Database query failed.");
    }
    
?>




<html>
    <head>
        <title>Users</title>
        <?php include 'templates/imports.php';?>
    </head>

    <body role='document'>
        <?php include 'templates/template header.php';?>

        <form action="assessments.php"><input type = "submit" value = "Go to Assessments"></form>
        <form action="reports.php"><input type = "submit" value = "Go to Reports"></form>


        <h1>Users</h1>

        <ul>
            <?php
            //PHP insertion
                while($row = mysqli_fetch_assoc($result)){
                    echo "<li>"."User ID: ". $row["user_id"]. "</li>"; 
                    echo "<li>"."Group ID: ". $row["group_id"]. "</li>";
                    echo "<li>"."First Name: ". $row["first_name"]. "</li>";
                    echo "<li>"."Surname: ". $row["surname"]. "</li>";
                    echo "<li>"."Login: ". $row["login"]. "</li>";
                    echo "<li>"."Password: ". $row["password"]. "</li>";
                    echo "<hr />";
                }
            ?>
        </ul>

        <?php include 'templates/template footer.php';?>
    </body>
</html>

<?php
    mysqli_close($connection);
?>