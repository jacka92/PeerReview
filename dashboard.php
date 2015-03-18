<?php require_once 'templates/db_connection.php'; ?>
<html>

    <head>
        <link rel="stylesheet" href="jquery-ui-1.11.3/jquery-ui.css">
        <title>Peer Assessment</title>
        <?php include 'templates/imports.php';?>
<?php
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
    $query .= "WHERE group_id = ".$Group_ID."";

    //Select all reports that have abeen assinged

    $result = mysqli_query ( $connection, $query );

    // query error handling
    if (! $result) {
        die ( "Database query failed." );
    }
    ///student-users will submit grading assessments and comments on the reports assigned to them - check user from session and display only the reports
    //assigned to them

    $query2 = "SELECT * ";
    $query2 .= "FROM assessments ";
    $result2 = mysqli_query ($connection, $query2);

    if (! $result2){
        die ("Database query failed.");   
    }

?>



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

                    echo "<h3> Insert New Report <h3>";
                    echo "<div> Start creating your new report to the right </div>";
    
                    while ( $row = mysqli_fetch_assoc ( $result ) ) {
                        // set the current row to this php var. Needed for id use
                        $currentrowgroupid = $row ["group_id"];
                        // giving all
                        echo "<h3>" . "Report ID : " . $row ["report_id"] . "</h3>";
                        
                        
                        // set the div's id to the current row's group id
                        echo "<div ";
                        echo "id = $currentrowgroupid   >";
                        echo "<p> Report ID : " . $row ["report_id"] . "</li>";
                        echo "<p> Group ID: " . $row ["group_id"] . "</li>";
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
        <br>
        <h2 id = "title">Your group has not completed any Reports</h3>
            
        <p name = "body" id="body" rows="20" cols="100" placeholder="Place your report body here" ></p>

        <div id="assessments"></div>
            
            <div id = "reportinput" style = "visibility:hidden;">
                <form method="post" action="dashboard/add_report.php">
                    <input class = "data" name = "group_id" name = "<?php echo $Group_ID; ?>">
                    <input class = "data" name = "user_id" value = "<?php echo $User; ?>">
                        <textarea name="report_text"></textarea><br><br>
                        <button name="create_report" class="btn btn-primary">Create</button>    
                </form>    
            </div>  
        </div>
            
        

        <?php
            include 'templates/template footer.php';
        ?>

        <script src="jquery-ui-1.11.3/external/jquery/jquery.js"></script>
        <script src="jquery-ui-1.11.3/jquery-ui.js"></script>


    </body>
</html>


<script type="text/javascript">
    
    //Function for setting the title
    $('#accordion').accordion({
        active: false,
        collapsible: true,
        heightStyle: "content"
        
    });
        
    // Function for creating accordion
    $(function accordion() {
    
        $( "#accordion" ).accordion({
            activate: function( event, ui ) {
                var temploader = ui.newPanel.html();  
                if (temploader == "<div> Start creating your new report to the right </div>"){
                    console.log("yo");
                    createreport();
                }else{
                    console.log("pleb");
                    temploader = temploader.replace("<p> Report ID : ","");
                    temploader = temploader.split("</p>");
                    var loader = temploader[0];
                    load(loader);
                }
            }

        });
      });
    

    
    function title(){
        var title = document.getElementById("title");  
        
        if ($("#accordion").children().length > 0) {
            title.innerHTML = "Select a report from the left";
        }
        
    }
    
    function createreport(){
        var title = document.getElementById("title");
        var body = document.getElementById("body");
        var reportinput = document.getElementById("reportinput");
        
        title.innerHTML = "New Report for Group <?php echo $Group_ID; ?>";
        body.innerHTML = "";
        reportinput.style = "visibility : visible;";
        
        var ass = document.getElementById("assessments");
        while (ass.firstChild) {
            ass.removeChild(ass.firstChild);
        }
        
    }


    // Function for changing ui elements 
    function load(reportid){
        var title = document.getElementById("title");
        var body = document.getElementById("body");
        var reportinput = document.getElementById("reportinput");
        
        reportinput.style = "visibility : hidden;";
        
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
        while (i < 10000){
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
    
    function assessment(){
        var reportno = document.getElementById("title").innerHTML;
        reportno = reportno.split("Report ");
        reportno = reportno[1];
        console.log(reportno);
        var aim = document.getElementById("assinput_report_id");
        aim.value = reportno;

    }

</script>

<?php
    mysqli_close ( $connection );
?>