<!DOCTYPE html>
<html>
    <head>
        
        <title>Dashboard</title>
        <?php include 'templates/header imports.php';?>

    </head>

    <body role='document'>

        <?php include 'templates/template header.php';?>

        <h1>Dat home page though</h1>

        <form action="reports/reports.php"><input type = "submit" value = "Go to Reports"></form>
        <form action="users.php"><input type = "submit" value = "Go to Users"></form>
        <form action="assessments/insert_assessment.php"><input type = "submit" value = "Insert an Ass"></form>
        

        <?php include 'templates/template footer.php';?>
    </body>
</html>
