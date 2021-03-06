<?php require_once 'templates/db_connection.php';
   
    $Group_ID = $_SESSION ['group_id'];
    $User = $_SESSION ['user_id'];

?>


<html>

    <head>
        <link rel="stylesheet" href="jquery-ui-1.11.3/jquery-ui.css">
        <title>Peer Assessment</title>
        <?php include 'templates/imports.php';?>

    </head>

    <body role='document' onload="title();">

            <?php include 'templates/template_header.php';?>




                <?php   
    if ($Group_ID == 0){

    }else{
        $query = "SELECT * ";
        $query .= "FROM reports ";
        $query .= "WHERE report_id IN (";
        $query .= "SELECT report_id ";
        $query .= "FROM assignments ";
        $query .= "WHERE group_id = ".$Group_ID." )";

        //Select all reports that have abeen assinged

        $result = mysqli_query ( $connection, $query );

        // query error handling
        if (! $result) {
            die ( "Database query failed." );
        }

        $query2 = "SELECT t1.* ";
        $query2 .= "FROM assessments t1, assignments t2 ";
        $query2 .= "WHERE (t2.group_id = {$Group_ID} ";
        $query2 .= "AND t1.report_id = t2.report_id)";

        $result2 = mysqli_query ($connection, $query2);

        if (! $result2){
            die ("Database query failed.");   
        }
    
                    // run through all rows
                    echo "<div id ='accordion' class = 'col-md-3'>";
    
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
    }

                ?>

        <div id = "assinput" title = "Create Assessment">
            <form method="post" action="viewreport/add_ass.php">
            <input class = "data" id = "assinput_report_id" name = "report_id">
            <input class = "data" name = "user_id" value = "<?php echo $User; ?>">
            <textarea name="comments" "15" cols = "50"></textarea><br><br>
            <input name = "assessment" type = "number" min = "0" max = "5" placeholder = "mark"><br><br>
            <button name="create_ass" class="btn btn-primary">Create</button>    
            </form>
                 
        </div>
        
        
        <div id="info" class = "col-md-9">
        <h2 id = "title">You haven't been assigned a Report.</h3>
        <p name = "body" id="body" rows="20" cols="100" placeholder="Place your report body here" >
        </p>
        <br />
        <button id = "button" style = "visibility:hidden" onclick = "assessment();"> Create New Assessment </button>
            
            
            <div id="assessments">
            
            </div>
            <br><br>
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
                temploader = temploader.replace("<p> Report ID : ","");
                temploader = temploader.split("</p>");
                var loader = temploader[0];
                load(loader);
                }

        });
      });
    
    $(function() {
        $( "#assinput" ).dialog({
            autoOpen: false,
            height: 300,
            width: 600,
        });
        
    $( "#button" ).click(function() {
        $( "#assinput" ).dialog( "open" );
        });
    });
    
    
    function title(){
        var title = document.getElementById("title");  
        
        if ($("#accordion").children().length > 0) {
            title.innerHTML = "Select a report from the left";
        }
    }

    // Function for changing ui elements 
    function load(reportid){
        var title = document.getElementById("title");
        var subtitle = document.getElementById("subtitle");
        var body = document.getElementById("body");
        var button = document.getElementById("button");
        
        button.style.visibility = "visible";
        
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