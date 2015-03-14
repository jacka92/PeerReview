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

    $query2 = "SELECT * FROM assessments ";
    $result2 = mysqli_query ($connection, $query2);

    if (! $result2){
        die ("Database query failed.");   
    }

?>


<html>

    <head>
        <link rel="stylesheet" href="jquery-ui-1.11.3/jquery-ui.css">
        <title>Peer Assessment</title>
        <?php include 'templates/imports.php';?>

    </head>

    <body role='document' onload="title();">

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

    .data{
        display: none;   
    }
                


    </style>



                <?php   
                    // run through all rows
                    echo "<div id ='accordion'>";
    
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

                        echo "<p class = 'data' id = " . $row["report_id"] . "> Report col : ". $row["report_text"] . "</p>";   

                        echo "</div>";

                    }
                    echo "</div>";

                    $i = 0;
                    while ( $row2 = mysqli_fetch_assoc ( $result2 ) ){
                        echo "<p class = 'data' 
                        id = ass" . $row2["report_id"] . "no" . $i . "> " . 
                            "Assessment ID: " . $row2["assessment_id"] . 
                            ", Assigned to Report " . $row2["report_id"] .
                            ", completed by User " . $row2["user_id"] .
                            ", Score:" . $row2["assessment"] .
                            ", " . $row2["comments"] .
                            "</p>";
                        $i++;
                    }

                ?>


        <div id="info">
        <h2 id = "title">You haven't been assigned a Report</h3>

        <p name = "body" id="body" rows="20" cols="100" placeholder="Place your report body here" >
        </p>
        <br />
            
            
            <div id="assessments">
            
            </div>
            
        </div>
        <input id="mark" type="hidden">
            
        

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
    
    //Function for setting the title

        
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
    
    function title(){
        var title = document.getElementById("title");  
        
        if ($("#accordion").children().length > 0) {
            title.innerHTML = "Select a report from the left";
        }
        console.log("Fire");
    }

    // Function for changing ui elements 
    function load(reportid){
        var title = document.getElementById("title");
        var subtitle = document.getElementById("subtitle");
        var body = document.getElementById("body");

        var groupid = 1;
        
        var tempdata = document.getElementById(reportid).innerHTML;  
        tempdata = tempdata.split("Report col : ");
        tempdata = tempdata[1];
        tempdata = tempdata.replace("</p>","");

        title.innerHTML = "Report "+reportid+"";
        body.innerHTML = tempdata;
        
        loadass(reportid);

    }
    
    //Function for loading assessments
    function loadass(reportid){
        
        var ass = document.getElementById("assessments");
        while (ass.firstChild) {
            ass.removeChild(ass.firstChild);
        }
        
        var i = 0;
        while (i < 10){
            var tempdata = document.getElementById("ass"+reportid+"no"+i);
            if (tempdata != null){
                tempdata = tempdata.innerHTML;
                tempdata = tempdata.split(",");
                console.log(tempdata[0]);
                                     
                var div = document.createElement("div");
                div.style.background = "#f6f6f6";
                div.style.padding = "25px 50px;";
                
                div.innerHTML = "<h3>"+tempdata[0]+tempdata[3]+"</h3>"+"<h4>"+tempdata[1]+","+tempdata[2]+"</h4>"+"<p>"+tempdata[4]+"</p>";
                
                ass.appendChild(div);
                
            }
            i++;
            
        }
    }

</script>

<?php
    mysqli_close ( $connection );
?>