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


        <h1>View Reports</h1>
        
   
            <?php
            //run through all rows
                while($row = mysqli_fetch_assoc($result)){
                    
                    echo "<a href = javascript:select()>";
                    
                    //set the current row to this php var. Needed for id use
                    $currentrowgroupid = $row["group_id"];
                    
                    //if the current row is your user's group id
                    //set the div to a different colour and tell the user it's related to them
                    if ($currentrowgroupid==$group_id){
                        echo "<div style = color:#A00000 ";
                        echo "Report regarding your group work";
                        
                    //else just close the div
                    }else{
                        echo "<div ";   
                    }
                    
                    //set the div's id to the current row's group id
                    echo "id = $currentrowgroupid   >"; 
                    
                    
                    echo "<li>"."Report ID : ". $row["report_id"]. "</li>"; 
                    echo "<li>"."Group ID: ". $row["group_id"]. "</li>";
                    echo "<li>"."Mark Aggregate: ". $row["mark_aggregate"]. "</li>";
                    echo "</div>";
                    echo "</a>";
                    echo "<br/>";
                }
            ?>
        
        <h2>Create New Report</h2>
        
        <input id = "mark" size="30" type="number" min="0" max="100" step="1" placeholder = "Mark">
        <br/><br/>
        
        <textarea id="body" rows="20" cols="100" placeholder="Place your repory body here"></textarea>
        <br/><br/>
        <form action="dashboard.php"><input type = "submit" value = "Submit Report"></form>
        
        <?php include 'templates/template footer.php';?>
    </body>
</html>

<script type="text/javascript">
    function select(){
        alert("hello");
    }
</script>



<?php
    mysqli_close($connection);
?>