<?php
require_once 'templates/db_connection.php';
    
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
            <link rel="stylesheet" href="jquery-ui-1.11.3/jquery-ui.css">
            <script src="jquery-ui-1.11.3/external/jquery/jquery.js"></script>
            <script src="jquery-ui-1.11.3/jquery-ui.js"></script>
            
        
        
        <script type = text/javascript>
          
 
        
        </script>
        

        
        <title>Peer Assessment</title>
        <?php 
include 'templates/imports.php';
        
        ?>

    </head>

    <body role='document'>

        <?php include 'templates/template_header.php';?>
        
        <style>
            #accordion {
                padding: 20px;
                width: 30%;
                float: left;
            }
            
            #info {
              
                width: 70%;
                float: right;
            }
            
        </style>            
            
            </div>


        <h1>View Reports</h1>
        
            
    
            <?php
            //run through all rows
                echo "<div id ='accordion'>";
                    
                    echo "<h3> Create new report </h3>";
                    echo "<div><p>No report found. Create this report to the right.</p></div>";
                    while($row = mysqli_fetch_assoc($result)){
                        //set the current row to this php var. Needed for id use
                        $currentrowgroupid = $row["group_id"];
                        //giving all 
//                        echo "<a href = javascript:select('$currentrowgroupid')>";
                        echo "<h3>"."Report ID : ". $row["report_id"]. "</h3>"; 
                        
                        //if the current row is your user'
                        if ($currentrowgroupid==$group_id){
                            echo "<div style = color:#A00000 ";
                        //else just close the div
                        }else{
                            echo "<div ";    
                        }
                        //set the div's id to the current row's group id
                        echo "id = $currentrowgroupid   >"; 
                        echo "<p> Report ID : ". $row["report_id"]. "</li>"; 
                        echo "<p> Group ID: ". $row["group_id"]. "</li>";
                        echo "<p> Mark Aggregate: ". $row["mark_aggregate"]. "</li>";
                        echo "</div>";
//                        echo "</a>";
                    }
                echo "</div>";
        
            ?>
        
        <div id = "info">
        <h2 id = "title">Select a report from the right</h2>
        <h3 id = "subtitle">This'll be for group no</h3>
        <br>
        <textarea id="body" rows="20" cols="100" placeholder="Place your repory body here"></textarea>
        <br/><br/>
        <form action="dashboard.php"><input type = "submit" value = "Submit Report"></form>
            <input id = "mark" type = "hidden">
        </div>
        
        <?php 
//include 'templates/template footer.php';
        ?>
        
    </body>
</html>

        
        <script type="text/javascript">
            
////            Function for creating edit page
//            function select(){
//                var title = document.getElementById("title");
//                var mark = document.getElementById("mark");
////                var body = document.getElementsById("body");
//                
//                title.innerHTML = "Edit Report for Group "+currentgroupid+"";
//                mark.type = "number";
//                mark.min = "0";
//                mark.max = "100";
//                mark.step = "1";
//                mark.placeholder = "Mark";
//                }   
        
//      Function for creating accordion
        $(function accordion() {
            
            $( "#accordion" ).accordion();
            
            $( "#accordion" ).accordion({
                activate: function( event, ui ) {
                    var temploader = ui.newPanel.html();                    
                    temploader = temploader.replace("<p> Report ID : ","");
                    temploader = temploader.split("</p>");
                    var loader = temploader[0];
                    load(loader);
                    }
            
            });
          });
            
        function load(reportid){
            var title = document.getElementById("title");
            var subtitle = document.getElementById("subtitle");
            
            var groupid = 5;
            
            subtitle.innerHTML = "Group number "+groupid+"";
            title.innerHTML = "Report number "+reportid+"";
            
        }
            
        
            
        
          
        
        </script>

    





<?php
    mysqli_close($connection);
?>