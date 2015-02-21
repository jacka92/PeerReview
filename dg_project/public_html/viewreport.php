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
                    
                    //set the current row to this php var. Needed for id use
                    $currentrowgroupid = $row["group_id"];
                    
                    //giving all 
                    echo "<a href = javascript:select('$currentrowgroupid')>";
                    
                    //if the current row is your user'
                    if ($currentrowgroupid==$group_id){
                        echo "<div style = color:#A00000 ";
                        
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
        

        
        
        <h2 id = "title"></h2>
        <input id = "mark" type = "hidden">
        <br/><br/>
        <textarea id="body" style="display:none;" rows="20" cols="100" placeholder="Place your repory body here"></textarea>
        <br/><br/>
        <form action="dashboard.php"><input type = "submit" value = "Submit Report"></form>

        
        <?php include 'templates/template footer.php';?>
    </body>
</html>

        <!-- Function for creating edit page -->
        <script type="text/javascript">
        
            function select(currentgroupid){
                var title = document.getElementById("title");
                var mark = document.getElementById("mark");
                var body = document.getElementsById("body");
                
                title.innerHTML = "Edit Report for Group "+currentgroupid+"";
                mark.type = "number";
                mark.min = "0";
                mark.max = "100";
                mark.step = "1";
                mark.placeholder = "Mark";

                
                }   
        
        </script>





<?php
    mysqli_close($connection);
?>