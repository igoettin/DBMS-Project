<!-- File to reset the player's password -->

<?php
    include("config.php");
    //session_start(); 
    if(isset($_POST['cancel_new_account']))
        header("location: login.php");
    else if(isset($_POST['submit_new_account'])){
        $new_username = trim($_POST['requested_login']);
        $new_password = trim($_POST['requested_pass']);
        if(empty($new_username)) 
            $error = "No login ID given! You must enter a login ID to submit a new account.";
        else if(empty($new_password))
            $error = "No password given! You must enter a password to submit a new account.";
        else {
            $login_lookup = mysql_query("(select LoginID from Player where LoginID = '$new_username') union (select LoginID from Manager where LoginID = '$new_username');");
            if(mysql_num_rows($login_lookup) > 0)
                $error = "LoginID already exists! Please choose a different one.";
            else {
                //TODO: NEED TO CHANGE THE ID TO BE SELF INCREMENTING!
                mysql_query("insert into Player(ID, LoginID, Name, Password, Birthday, Address, Email, PhoneNumber, PlayPos, RequestFlag) values(1009, '$new_username', '', '$new_password', '1995-01-01', '', '', '', 'center', 0);") || die(mysql_error());
                $success = "New account successfully requested!";
            }
        }
    }

?>

<html>
    <head>
        <title> Request New Player Account </title>

        <style type = "text/css">
            body {
                font-family: Arial, Helvetica, sans-serif;
                font-size:14px;
            }

            label {
                font-weight:bold;
                width:100px;
                font-size:14px;
            }

            .box {
                border:#666666 solid 1px;

            }
        </style>
    </head>
    <body>
        <div align = "center">
            <div style = "width:500px; border: solid 1 px #333333; " align = "left">
                <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b> Request a new player account </b> </div>
                <div style = "margin:30px;">
                    <form method = "post">
                        <label> Enter a login ID for the new account: </label><input type = "text" name = "requested_login" class = "box"/><br/><br/>
                        <label> Enter a password for the new account: </label><input type = "password" name = "requested_pass" class = "box" /><br/><br/>
                        <input type = "submit" name = "submit_new_account" value = "  Submit  "/><br/>
                        <input type = "submit" name = "cancel_new_account" value = "  Cancel  "/><br/>
                    </form>
                    <div style = "font-size:13px; color:#cc0000; "><?php echo $error; ?> </div>
                    <div style = "font-size:13px; color:#0cc719; "><?php echo $success; ?> </div>
                </div>
            </div>

        </div>

    </body>

</html>
