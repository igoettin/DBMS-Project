<!-- File to reset the player's password -->
<!doctype html>
<?php
    include("config.php");
    session_start();
    $p_ID = $_SESSION['login_user'];
    $player_row = mysql_fetch_array(mysql_query("select * from Player where ID = '$p_ID';"));
    if(isset($_POST['go_back_button']))
        header("location: player_view.php");
    else if(isset($_POST['submit_new_account'])){
        $new_name = trim($_POST['name_input']);
        $new_year = trim($_POST['year_bday']);
        $new_month = trim($_POST['month_bday']);
        $new_day = trim($_POST['day_bday']);
        $new_address = trim($_POST['address_input']);
        $new_email = trim($_POST['email_input']);
        $new_phone_number = trim($_POST['phone_number_input']);
        //TODO: PlayPos
        if(empty($new_name))
            $error = "No player name is given!";
        else if(empty($new_year))
            $error = "No year is given for the birthday!";
        else if(empty($new_month))
            $error = "No month is given for the birthday!";
        else if(empty($new_day))
            $error = "No day is given for the birthday!";
        else if(empty($new_address))
            $error = "No address is given!";
        else if(empty($new_email))
            $error = "No email is given!";
        else if(empty($new_phone_number))
            $error = "No phone number is given!";
        else if(strlen($new_phone_number) < 10)
            $error = "Invalid phone number! There must be at least 10 digits.";
        else {
            $login_lookup = mysql_query("(select LoginID from Player where LoginID = '$new_username') union (select LoginID from Manager where LoginID = '$new_username');");
            if(mysql_num_rows($login_lookup) > 0)
                $error = "LoginID already exists! Please choose a different one.";
            else {
                //TODO: NEED TO CHANGE THE ID TO BE SELF INCREMENTING!
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
        <title> Edit Player Information </title>

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
                        <label> Player Name: </label><input type = "text" name = "name_input" class = "box" maxlength = "64" value = <?php print $player_row['Name'];?> /><br><br>
                        <label> Birthday (Year-Month-Day): </label><input type = "text" name = "year_bday" class = "box" size = "4" maxlength = "4" onkeypress = "return event.charCode >= 48 && event.charCode <= 57" value = <?php print date('Y', strtotime($player_row['Birthday']));?> />-<input type = "text" name = "month_bday" class = "box" size = "2" maxlength = "2" onkeypress = "return event.charCode >= 48 && event.charCode <= 57" value = <?php print date('m',strtotime($player_row['Birthday']));?> />-<input type = "text" name = "day_bday" class = "box" size = "2" maxlength = "2" onkeypress = "return event.charCode >= 48 && event.charCode <= 57" value = <?php print date('d',strtotime($player_row['Birthday']));?> /><br><br>
                        <label> Address: </label> <input type = "text" name = "address_input" class = "box" maxlength = "128" value = <?php print $player_row['Address'];?> /><br><br>
                        <label> Email: </label> <input type = "text" name = "email_input" class = "box" maxlength = "32" value = <?php print $player_row['Email'];?> /><br><br>
                        <label> Phone Number: </label> <input type = "text" name = "phone_number_input" class = "box" maxlength = "10" onkeypress = "return event.charCode >= 48 && event.charCode <= 57" value = <?php print $player_row['PhoneNumber'];?> /><br><br>
                        <!-- FIX THIS -->
                        <label> PlayPos: (TODO!) </label><br><br> 
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
