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
    <ul>
        <?php
        //PHP insertion
            while($row = mysqli_fetch_assoc($result)){
                echo "<li>"."Assessment ID: ". $row["Assessment_ID"]. "</li>"; 
                echo "<li>"."Assessment Score: ". $row["Assessment"]. "</li>";
                echo "<li>"."Report ID: ". $row["Report_ID"]. "</li>";
                echo "<li>"."User ID: ". $row["User_ID"]. "</li>";
                echo "<hr />";
            }
        ?>
    </ul>
    
    <head>
        
        <title>Peer Assessment</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href='css/bootstrap.min.css' rel='stylesheet'>
    <style>




    </style>

    </head>

        <body>

            
            
            
            
            <h1>Bullshit fucking database</h1>
            <h2>These are the pieces of shits involved in this stupid application</h2>
            <p>Pejhmon asshole Kamaie</p>
            <p>Jack weak-as-fuck Armstrong</p>
            <p>Samuel name-complex Partridge</p>
            <table width="300" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">
                <tr>
                    <form name="form1" method="post" action="checklogin.php">
                        <td>
                            <table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
                                <tr>
                                    <td colspan="3"><strong>Member Login </strong></td>
                                </tr>
                                <tr>
                                    <td width="78">Username</td>
                                    <td width="6">:</td>
                                    <td width="294"><input name="myusername" type="text" id="myusername"></td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td>:</td>
                                    <td><input name="mypassword" type="text" id="mypassword"></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td><input type="submit" name="Submit" value="Login"></td>
                                </tr>
                            </table>
                        </td>
                    </form>
                </tr>
            </table>
            

            
        </body>
</html>

<?php
    mysqli_close($connection);
?>