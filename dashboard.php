<?php require_once 'templates/db_connection.php'; ?>

<html>
    <head>
        <title>Peer Assessment</title>
        <link rel="stylesheet" href="jquery-ui-1.11.3/jquery-ui.css">
        <?php include 'templates/imports.php';  ?>
    </head>
    
    <body role='document' onload="title();">
          <?php include 'templates/template_header.php';

            $Group_ID = $_SESSION ['group_id'];
            $User = $_SESSION ['user_id'];
        ?>
        <div id = "welcome" class = "col-md-15">
            <h1>Welcome to Peer Review, User <?php echo $User; ?> </h1>
            <h3>Your Group number is <?php echo $Group_ID ?>. The reports submitted by your group are below.</h3>
            
            <?php 
                $groupquery = "SELECT user_id FROM users WHERE group_id = ".$Group_ID.""; 
                $groupmembers = mysqli_query( $connection, $groupquery );

                 if (! $groupmembers){
                        die ("Database query failed.");   
                    }

 
            
            ?>
            
            <h4> Your group members are;</h4>
            <?php                            
                while ( $row0 = mysqli_fetch_assoc ( $groupmembers ) ){
                    echo "<li> User ";
                    echo $row0 ["user_id"];
                    echo "</li>";
                }; ?>
            
            <br><br>
        </div>
        
        <?php

            if ($Group_ID == 0){

            }else{
                $reportquery = "SELECT * ";
                $reportquery .= "FROM reports ";
                $reportquery .= "WHERE group_id = ".$Group_ID."";

                $reports = mysqli_query ( $connection, $reportquery );

                if (! $reports) {
                    die ( "Database query failed." );
                }
                    $assessmentquery = "SELECT * ";
                    $assessmentquery .= "FROM assessments ";
                    $assessments = mysqli_query ($connection, $assessmentquery);

                    if (! $assessments){
                        die ("Database query failed.");   
                    }


                echo "<div id ='accordion' class = 'col-md-3'>";
                    echo "<h3> Insert New Report <h3>";
                    echo "<div> Start creating your new report to the right </div>";

                    while ( $row = mysqli_fetch_assoc ( $reports ) ) {
                        echo "<h3>" . "Report ID : " . $row ["report_id"] . "</h3>";
                        echo "<div ";
                        echo "id = " . $row ["group_id"] . ">";
                        echo "<p> Report ID : " . $row ["report_id"] . "</li>";
                        echo "<p> Group ID: " . $row ["group_id"] . "</li>";
                        echo "<p class = 'data' id = " . $row["report_id"] . "> Report col : ". $row["report_text"] . "</p>";   
                        echo "</div>";

                    }
                echo "</div>";

                $i = 0;
                while ( $row2 = mysqli_fetch_assoc ( $assessments ) ){
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
        

    
        <div id="info" class = "col-md-9">
            <h2 id = "title">You have not been assigned to a group.</h3>
            <p name = "body" id="body" rows="20" cols="100" placeholder="Place your report body here" ></p>
 
            <button id = "edit" onclick = "edit();" class="btn btn-primary" style = "visibility:hidden;">Edit</button>

            
            <div id="assessments"></div>

            <div id = "reportinput" style = "visibility:hidden;">
                <form id = "reportform" method="post" action="dashboard/add_report.php">
                    <input class = "data" name = "report_id" id = "report_id">
                    <input class = "data" name = "group_id" value = "<?php echo $Group_ID; ?>">
                    <input class = "data" name = "user_id" value = "<?php echo $User; ?>">                  
                    <textarea id = "report_text" name="report_text" rows = "15" cols = "120"></textarea><br><br>
                    <button id = "button" name="create_report" class="btn btn-primary">Submit</button>    
                </form>    
            </div>
            

        </div>
            
        <?php include 'templates/template footer.php'; ?>
        <script src="jquery-ui-1.11.3/external/jquery/jquery.js"></script>
        <script src="jquery-ui-1.11.3/jquery-ui.js"></script>

    </body>
</html>


<script type="text/javascript">
    
    $('#accordion').accordion({
        active: false,
        collapsible: true,
        heightStyle: "content"
        
    });
        
    $(function accordion() {
    
        $( "#accordion" ).accordion({
            activate: function( event, ui ) {
                var temploader = ui.newPanel.html();  
                if (temploader == "<div> Start creating your new report to the right </div>"){
                    createreport();
                }else{
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
        var edit = document.getElementById("edit");
        
        title.innerHTML = "New Report for Group <?php echo $Group_ID; ?>";
        body.innerHTML = "";
        
        reportinput.style.visibility = "visible";
        reportinput.style.display = "block";//this is needed mainly for Chrome
        
        edit.style.visibility = "hidden";
        edit.style.display = "none";//this is needed mainly for Chrome
        
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
        var edit = document.getElementById("edit");

        edit.style.visibility = "visible";
        edit.style.display = "block";//this is needed mainly for Chrome
        
        reportinput.style.display = "hidden";
        reportinput.style.display = "none" //this is needed mainly for Chrome"
        
        var tempdata = document.getElementById(reportid).innerHTML;  
        tempdata = tempdata.split("Report col : ");
        tempdata = tempdata[1];
        tempdata = tempdata.replace("</p>","");

        title.innerHTML = "Report "+reportid+"";
        body.innerHTML = tempdata + "<br><br>";
        
        
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
    
    function edit(){
        console.log("yo");
        
        
        var reportinput = document.getElementById("reportinput");
        var report_text = document.getElementById("report_text");
        var reportform = document.getElementById("reportform");
        var edit = document.getElementById("edit");
        var title = document.getElementById("title");
        var report_id = document.getElementById("report_id");
        var button = document.getElementById("button");
        
        button.value = "Update";
        
        report_id.value = title.innerHTML.replace("Report ","");
        
        report_text.value = body.innerHTML.replace("<br><br>","");
        
        reportform.action = "dashboard/edit_report.php";
        
        reportinput.style.visibility = "visible";
        reportinput.style.display = "block";//this is needed mainly for Chrome
        
        edit.style.visibility = "hidden";
        edit.style.display = "none";//this is needed mainly for Chrome
        
    }

</script>

<?php
    mysqli_close ( $connection );
?>