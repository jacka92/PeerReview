<!DOCTYPE html>

<?php
    require_once 'templates/db_connection.php';
    
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
    <head>
        
        <title>Assessments</title>
        <?php include 'templates/imports.php';?>

    </head>

    <body role='document'>
        <?php require_once 'templates/template_header.php';?>

        <form action="reports.php"><input type = "submit" value = "Go to Reports"></form>
        <form action="users.php"><input type = "submit" value = "Go to Users"></form>
        <form action="assessments/insert_assessment.php"><input type = "submit" value = "Insert an Ass"></form>

        
        <h1>Assessments</h1>
        
        <ul>
            <?php
            //PHP insertion
                while($row = mysqli_fetch_assoc($result)){
                    echo "<li>"."Assessment ID: ". $row["assessment_id"]. "</li>"; 
                    echo "<li>"."Assessment Score: ". $row["assessment"]. "</li>";
                    echo "<li>"."Report ID: ". $row["report_id"]. "</li>";
                    echo "<li>"."User ID: ". $row["user_id"]. "</li>";
                    ?>
                        <form action="assessments/update_assessment.php"><input type = "submit" value = "Update an Ass"></form>
                        <form action="assessments/delete_assessment.php"><input type = "submit" value = "Delete an Ass"></form>
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