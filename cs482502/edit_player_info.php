<!-- This PHP file defines the page that allows a player to edit his/her information -->
<!doctype html>
<?php
    include("player_view.php");
    include("check_month_day.php");
    include("config.php");
    session_start();
    $p_ID = $_SESSION['login_user'];
    $player_row = mysql_fetch_array(mysql_query("select * from Player where ID = '$p_ID';"));
    if(isset($_POST['go_back_button']))
        header("location: player_view.php");
    else if(isset($_POST['submit_info'])){
        $new_password = $_POST['password_input'];
        $new_name = $_POST['name_input'];
        $new_year = ($_POST['year_bday']);
        $new_month = ($_POST['month_bday']);
        $new_day = ($_POST['day_bday']);
        $new_address = ($_POST['address_input']);
        $new_email = ($_POST['email_input']);
        $new_phone_number = ($_POST['phone_number_input']);
        $play_pos = $_POST['pos'];
        if(empty($new_password))
            $error = "No password is given!";
        else if(empty($new_name))
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
        else if(strlen($new_year) < 4)
            $error = "The year of your birthday must be 4 digits long!";
        else if(strlen($new_month) < 2)
            $error = "The month of your birthday must be 2 digits long! \n Append a 0 to single digit months (i.e. 01 for January).";
        else if(strlen($new_day) < 2)
            $error = "The day of your birthday must be 2 digits long! \n Append a 0 to single digit days (i.e. 01 for 1).";
        else if(check_month_day((int)$new_month, (int)$new_day) == false)
            $error = "The day and month of your birthday are invalid.";
        else {
            $birthday_complete = $new_year."-".$new_month."-".$new_day;
            //If no errors were found, update the player's info with the new data.
            mysql_query("update Player set Password = '$new_password', Name = '$new_name', Birthday = '$birthday_complete', Address = '$new_address', Email = '$new_email', PhoneNumber = '$new_phone_number', PlayPos = '$play_pos' where ID = '$p_ID';") || die(mysql_error());
            $success = "Your account details have been successfully updated!";
            $player_row = mysql_fetch_array(mysql_query("select * from Player where ID = '$p_ID';"));
        }
    }

    //Function to check if the player's current play pos matches the given position
    //This is used for setting the default value of the playpos dropdown.
    function checkPlayPos($given_pos){
        $player_ID = $_SESSION['login_user'];
        $play_pos = mysql_fetch_array(mysql_query("select * from Player where ID = '$player_ID';"))['PlayPos'];
        if(!strcmp($play_pos,$given_pos))
            echo "selected=\"selected\"";
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
            
            div.tab input.epi{background-color:#3399ff;}
            input.op{box-sizing: border-box; width:100%; font-size:100%;}
        </style>
    </head>
    <body>
        <br><br>
        <div style = "font-size:13px; color:#cc0000; "><?php echo $error; ?> </div>
        <div style = "font-size:13px; color:#0cc719; "><?php echo $success; ?> </div>
        <table border = "3">
            <tr><th colspan = '7'><h3> Edit Player Information </h3></th></tr>
            <tr>
                <th>Password</th>
                <th>Player Name</th>
                <th>Birthday (YYYY-MM-DD)</th>
                <th>Address</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>PlayPos</th>
            </tr> 
            <tr>
                <form method = "post">
                <td><input type = "password" name = "password_input" class = "box" maxlength = "8" value = "<?php print $player_row['Password']; ?>" /></td>
                <td><input type = "text" name = "name_input" class = "box" maxlength = "64" value = "<?php print $player_row['Name'];?>" /></td>
                <td><input type = "text" name = "year_bday" class = "box" size = "4" maxlength = "4" onkeypress = "return event.charCode >= 48 && event.charCode <= 57" value = "<?php print date('Y', strtotime($player_row['Birthday']));?>" />-<input type = "text" name = "month_bday" class = "box" size = "2" maxlength = "2" onkeypress = "return event.charCode >= 48 && event.charCode <= 57" value = "<?php print date('m',strtotime($player_row['Birthday']));?>" />-<input type = "text" name = "day_bday" class = "box" size = "2" maxlength = "2" onkeypress = "return event.charCode >= 48 && event.charCode <= 57" value = "<?php print date('d',strtotime($player_row['Birthday']));?>" /></td>
                <td><input type = "text" name = "address_input" class = "box" maxlength = "128" value = "<?php print $player_row['Address'];?>" /></td>
                <td><input type = "text" name = "email_input" class = "box" maxlength = "32" value = "<?php print $player_row['Email'];?>" /></td>
                <td><input type = "text" name = "phone_number_input" class = "box" maxlength = "10" onkeypress = "return event.charCode >= 48 && event.charCode <= 57" value = "<?php print $player_row['PhoneNumber'];?>" /></td>
                <td><select name = "pos">
                        <option value = "point guard" <?php checkPlayPos("point guard"); ?>> Point Guard</option>
                        <option value = "shooting guard" <?php checkPlayPos("shooting guard"); ?>> Shooting Guard</option>
                        <option value = "small forward" <?php checkPlayPos("small forward"); ?>> Small Forward </option>
                        <option value = "power forward" <?php checkPlayPos("power forward"); ?>> Power Forward </option>
                        <option value = "center" <?php checkPlayPos("center"); ?> > Center </option>
                </select></td>
            </tr>
            <tr>
                <td colspan = '7'>
                    <input type = "submit" name = "submit_info" value = "Update player information" class = "op"/>
                </td>
                </form>
            </tr>
        </table>
    </body>
</html>
