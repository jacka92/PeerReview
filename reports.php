<?php
    require_once 'templates/db_connection.php';
    
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
    <head>
        
        <title>Peer Assessment</title>
        <?php include 'templates/imports.php';?>

    </head>

    <body role='document'>

        <?php include 'templates/template header.php';?>

        <form action="assessments.php"><input type = "submit" value = "Go to Assessments"></form>
        <form action="users.php"><input type = "submit" value = "Go to Users"></form>
        <form action="reports/insert_report.php"><input type = "submit" value = "Insert a Report"></form>

        
        <h1>Reports</h1>
        
        <ul>
            <?php
            //PHP insertion
                while($row = mysqli_fetch_assoc($result)){
                    echo "<li>"."Report ID : ". $row["report_id"]. "</li>"; 
                    echo "<li>"."Group ID: ". $row["group_id"]. "</li>";
                    echo "<li>"."Mark Aggregate: ". $row["mark_aggregate"]. "</li>";
                    ?>         
                        <form action="reports/update_report.php"><input type = "submit" value = "Update a Report"></form>
                        <form action="reports/delete_report.php"><input type = "submit" value = "Delete a Report"></form> 
                    <?php
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