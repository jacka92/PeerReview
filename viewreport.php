<?php
require_once 'templates/db_connection.php';

session_start ();
// TODO change this for a dynamic update
    $Group_ID = $_SESSION ['group_id'];
    $User = $_SESSION ['user_id'];

$Warning = "";
if (isset($_POST) && !empty($_POST['submit'])) {
	$ReportText = $_POST ['body'];
	$query = "INSERT INTO reports (group_id, report_text ) VALUES ({$Group_ID}, '{$ReportText}')";
	$result = mysqli_query ( $connection, $query ) or die ( 'Error: insert failed' . mysql_error () );
	$_POST['submit'] = "";
} else {
	$Warning = "Please enter some text to create a report";
}

// query handling
$query = "SELECT * ";
$query .= "FROM reports ";

$result = mysqli_query ( $connection, $query );
// query error handling
if (! $result) {
	die ( "Database query failed." );
}
///student-users will submit grading assessments and comments on the reports assigned to them - check user from session and display only the reports
//assigned to them
?>


<html>

    <head>
        <link rel="stylesheet" href="jquery-ui-1.11.3/jquery-ui.css">
        <title>Peer Assessment</title>
        <?php include 'templates/imports.php';?>

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




	<h1>View Reports</h1>
	<h2><?php
        echo $Warning;
        ?>
    </h2>
        

            <?php

                // run through all rows
                echo "<div id ='accordion'>";

                echo "<h3> Create new report </h3>";
                echo "<div><p>No report found. Create this report to the right.</p></div>";
                while ( $row = mysqli_fetch_assoc ( $result ) ) {
                    // set the current row to this php var. Needed for id use
                    $currentrowgroupid = $row ["group_id"];
                    // giving all
                    echo "<h3>" . "Report ID : " . $row ["report_id"] . "</h3>";

                    // if the current row is your user'
                    if ($currentrowgroupid == $Group_ID) {
                        echo "<div style = color:#A00000 ";
                        // else just close the div
                    } else {
                        echo "<div ";
                    }
                    // set the div's id to the current row's group id
                    echo "id = $currentrowgroupid   >";
                    echo "<p> Report ID : " . $row ["report_id"] . "</li>";
                    echo "<p> Group ID: " . $row ["group_id"] . "</li>";
                    echo "<p> Mark Aggregate: " . $row ["mark_aggregate"] . "</li>";
                    echo "</div>";
                }
                echo "</div>";

                ?>
		<div id="info">
        <h2 id = "title">This</h3>
        <h3 id = "subtitle">That</h2>
        <form method="post" id="report" action="viewreport.php">
		<textarea name = "body" id="body" rows="20" cols="100" placeholder="Place your report body here" >
		</textarea>
		<br />
		<input type="submit" name = "submit" value="submit"/>
		</form>
		<input id="mark" type="hidden">
	</div>
    
    <?php
        include 'templates/template footer.php';
    ?>
    
    <script src="jquery-ui-1.11.3/external/jquery/jquery.js"></script>
    <script src="jquery-ui-1.11.3/jquery-ui.js"></script>
              

    </body>
</html>


<script type="text/javascript">
            
//      Dont remove - old select, needed to be used
//            function select(){
//                var title = document.getElementById("title");
//                var mark = document.getElementById("mark");
//                var body = document.getElementsById("body");
//                
//                title.innerHTML = "Edit Report for Group "+currentgroupid+"";
//                mark.type = "number";
//                mark.min = "0";
//                mark.max = "100";
//                mark.step = "1";
//                mark.placeholder = "Mark";
//                }   
        
        // Function for creating accordion
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
        
        // Function for changing ui elements 
        function load(reportid){
            var title = document.getElementById("title");
            var subtitle = document.getElementById("subtitle");
            var body = document.getElementById("body");
            
            var groupid = 1;
            
            
            
            title.innerHTML = "Report number "+reportid+"";
            subtitle.innerHTML = "Group number "+groupid+"";
            body.innerHTML = "hey";
            
        }
        
        </script>


<?php

mysqli_close ( $connection );
?>