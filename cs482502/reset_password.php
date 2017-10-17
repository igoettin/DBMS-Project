<!-- File to reset the player's password -->
<!doctype html>
<?php
    include("config.php");
    if(isset($_POST['go_back_button']))
        header("location: login.php");
    else if(isset($_POST['submit_new_password'])){
        $loginID = $_POST['loginID_input'];
        $current_pass = $_POST['current_password_input'];
        $new_pass = $_POST['new_password_input'];
        $retype_pass = $_POST['re-type_password_input'];
        $loginID_row = mysql_fetch_array(mysql_query("(select LoginID from Player where LoginID = '$loginID') union (select LoginID from Manager where LoginID = '$loginID');"));
        $password_row = mysql_fetch_array(mysql_query("(select Password from Player where LoginID = '$loginID') union (select Password from Manager where LoginID = '$loginID');"));
        if(empty($loginID))
            $error = "No loginID is given!";
        if(empty($current_pass))
            $error = "No current password is given!";
        else if(empty($new_pass))
            $error = "No new password is given!!";
        else if(empty($retype_pass))
            $error = "The new password has not been re-typed for confirmation!";
        else if($loginID_row['LoginID'] != $loginID)
            $error = "There is no account that exists with the given loginID.";
        else if($password_row['Password'] != $current_pass)
            $error = "The current password given for the loginID does not match the account.";
        else if($new_pass != $retype_pass)
            $error = "The new password does not match the retyped new password.";
        else {
            mysql_query("update Player set Password = '$new_pass' where LoginID = '$loginID' ");
            mysql_query("update Manager set Password = '$new_pass' where LoginID = '$loginID' ");
            $success = "Password has been successfully reset";
        }
    }

?>
<html>
    <head>
        <title> Reset Account Password </title>

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
                <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b> Edit account information</b> </div>
                <div style = "margin:30px;">
                    <form method = "post">
                        <label> LoginID: </label><input type = "text" name = "loginID_input" class = "box" maxlength = "16"/><br><br>
                        <label> Current password: </label><input type = "text" name = "current_password_input" class = "box" maxlength = "8" /><br><br>
                        <label> New password: </label><input type = "text" name = "new_password_input" class = "box" maxlength = "8" /> <br><br>
                        <label> Re-type new password: </label><input type = "text" name = "re-type_password_input" class = "box" maxlength = "8" /> <br><br>
                        <input type = "submit" name = "submit_new_password" value = "  Submit  "/><br/>
                        <input type = "submit" name = "go_back_button" value = "  Go Back  "/><br/>
                    </form>
                    <div style = "font-size:13px; color:#cc0000; "><?php echo $error; ?> </div>
                    <div style = "font-size:13px; color:#0cc719; "><?php echo $success; ?> </div>
                </div>
            </div>

        </div>

    </body>

</html>
