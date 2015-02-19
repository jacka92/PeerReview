    <!DOCTYPE html>
    <?php
    $connection = mysqli_connect('localhost','root','','peer_assessment')
    or die('Error: '.mysql_error());?>

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

<body id="body-color">
    <div id="Sign-Up">
        <fieldset style="width: 30%">
            <legend>Registration Form</legend>
            <table border="0">
                <tr>
                    <form method="post" action="registration_successful.php">
                        <td>First name</td>
                        <td><input type="text" name="name"></td>
                </tr>
                 <tr>
                    <td>Surname</td>
                    <td><input type="text" name="surname"></td>
                </tr>
                <tr>
                    <td>Group ID</td>
                    <td><input type="text" name="group_id"></td>
                </tr>
                <tr>
                    <td>UserName</td>
                    <td><input type="text" name="user"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="pass"></td>
                </tr>
                <tr>
                    <td>Confirm Password</td>
                    <td><input type="password" name="cpass"></td>
                </tr>
                <tr>
                    <td><input id="button" type="submit" name="submit"
                        value="Sign-Up"></td>
                </tr>

                </form>
            </table>
        </fieldset>
    </div>
</html>

<?php
mysqli_close($connection);
?>