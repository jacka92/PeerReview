    <!DOCTYPE html>
    <?php
    $connection = mysqli_connect('localhost','root','','peer_assessment')
    or die('Error: '.mysql_error());?>

<html>
    <head>
        <title>Registration</title>
        <?php include 'templates/header imports.php';?>
    </head>

    <body role='document'>
        <?php include 'templates/template header.php';?>

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
                    </tr>
                </table>
            </fieldset>
        </div>

        <?php include 'templates/template footer.php';?>
    </body>
</html>

<?php
mysqli_close($connection);
?>