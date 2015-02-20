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

    //TODO change this for a dynamic update
    $group_id = 2;
    
    //query handling
    $query = "SELECT * "; 
    $query .= "FROM reports ";
    $query .= "WHERE group_id = '{$group_id}'";
    
    $result = mysqli_query($connection, $query);

    //query error handling
    if (!$result){
        die("Database query failed.");
    }
    
?>




<html>
    <head>
        
        <title>Peer Assessment</title>
        <?php include 'templates/imports.php';?>

    </head>

    <body role='document'>

        <?php include 'templates/template header.php';?>


        <h1>View Your Reports</h1>
        
        <ul>
            <?php
            //PHP insertion
                if($row = mysqli_fetch_assoc($result)){
                    echo "<li>"."Report ID : ". $row["report_id"]. "</li>"; 
                    echo "<li>"."Group ID: ". $row["group_id"]. "</li>";
                    echo "<li>"."Mark Aggregate: ". $row["mark_aggregate"]. "</li>";
                }else{
                    echo "No report found for your Group ID: ". $group_id;
                    }
                    echo "<hr />";
            ?>
        </ul>
        <h2>Create New Report</h2>
        
        <input id = "mark" size="30" type="number" min="0" max="100" step="1" placeholder = "Mark">
        <br/><br/>
        
        <textarea id="body" rows="20" cols="100" placeholder="Place your repory body here"></textarea>
        <br/><br/>
        <form action="dashboard.php"><input type = "submit" value = "Submit Report"></form>
        
        <?php include 'templates/template footer.php';?>
    </body>
</html>

<?php
    mysqli_close($connection);
?>