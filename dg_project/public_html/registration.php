<?php
    $connection = mysqli_connect('localhost','root','Ng2+9&sX','peer_assessment')
        or die('Error: '.mysql_error());
    
    /*$query = "INSERT INTO users (Group_ID, First_Name, Surname, login, password)"."VALUES ('${users['firstName']}','${users['surname']}')";
    $result = mysqli_query($connection, $query)
        or die ('Error: '.mysql_error());   */
?>*/




<html>
    
    <head>
        
        <title>Registration</title>
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
                                    <td colspan="3"><strong>Member Registration </strong></td>
                                </tr>
                                 <tr>
                                    <td width="78">First name</td>
                                    <td width="6">:</td>
                                    <td width="294"><input name="myusername" type="text" id="myusername"></td>
                                </tr>
                                 <tr>
                                    <td width="78">Surname</td>
                                    <td width="6">:</td>
                                    <td width="294"><input name="myusername" type="text" id="myusername"></td>
                                </tr>
                                <tr>
                                    <td width="78">Username</td>
                                    <td width="6">:</td>
                                    <td width="294"><input name="myusername" type="text" id="myusername"></td>
                                </tr>
                                 <tr>
                                    <td width="78">Group ID</td>
                                    <td width="6">:</td>
                                    <td width="294"><input name="myusername" type="text" id="myusername"></td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td>:</td>
                                    <td><input name="mypassword" type="text" id="mypassword"></td>
                                </tr>
                                <tr>
                                    <td>Re-enter Password</td>
                                    <td>:</td>
                                    <td><input name="mypassword" type="text" id="mypassword"></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td><input type="submit" name="Submit" value="Register"></td>
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