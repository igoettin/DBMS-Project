<!-- File to reset the player's password -->

<?php
    include("config.php");
    //session_start(); 
    if(isset($_POST['go_back_button']))
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
                $max_lookup = mysql_fetch_array(mysql_query("select max(ID) from Player;"))['max(ID)'];
                if($max_lookup == null)
                    $new_ID = 0;
                else
                    $new_ID = $max_lookup + 1;
                mysql_query("insert into Player(ID, LoginID, Name, Password, Birthday, Address, Email, PhoneNumber, PlayPos, RequestFlag) values('$new_ID', '$new_username', 'New Player', '$new_password', '1995-01-01', '', '', '', 'center', 0);") || die(mysql_error());
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
                        <label> Enter a login ID for the new account: </label><input type = "text" name = "requested_login" class = "box" maxlength = "16" /><br/><br/>
                        <label> Enter a password for the new account: </label><input type = "password" name = "requested_pass" class = "box" maxlength = "8" /><br/><br/>
                        <input type = "submit" name = "submit_new_account" value = "  Submit  "/><br/>
                        <input type = "submit" name = "go_back_button" value = "  Go Back  "/><br/>
                    </form>
                    <div style = "font-size:13px; color:#cc0000; "><?php echo $error; ?> </div>
                    <div style = "font-size:13px; color:#0cc719; "><?php echo $success; ?> </div>
                </div>
            </div>

        </div>

    </body>

</html>
