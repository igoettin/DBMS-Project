<!-- This PHP file defines the page that allows a new manager to create an account. -->
<!doctype html>
<?php
    include("check_month_day.php");
    include("config.php");
    session_start();
    $p_ID = $_SESSION['login_user'];
    if(isset($_POST['go_back_button']))
        header("location: login.php");
    else if(isset($_POST['submit_info'])){
        $new_loginid = $_POST['loginID_input'];
        $login_query = mysql_query("(select LoginID from Manager where LoginID = '$new_loginid') union (select LoginID from Player where LoginID = '$new_loginid');");
        $new_password = $_POST['password_input'];
        $new_name = $_POST['name_input'];
        $new_year = ($_POST['year_bday']);
        $new_month = ($_POST['month_bday']);
        $new_day = ($_POST['day_bday']);
        $new_address = ($_POST['address_input']);
        $new_email = ($_POST['email_input']);
        $new_phone_number = ($_POST['phone_number_input']);
        $play_pos = $_POST['pos'];
        if(empty($new_loginid))
            $error = "No login ID is given!";
        else if(mysql_num_rows($login_query) > 0)
            $error = "The given Login ID is already taken. Please provide a different one.";
        else if(empty($new_password))
            $error = "No password is given!";
        else if(empty($new_name))
            $error = "No manager name is given!";
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
            $max_lookup = mysql_fetch_array(mysql_query("select max(ID) from Manager;"))['max(ID)'];
            if($max_lookup == null)
                $manager_id = 0;
            else
                $manager_id = $max_lookup + 1;
            mysql_query("insert into Manager(ID,LoginID,Name,Password,Birthday,Address,Email,PhoneNumber) values('$manager_id', '$new_loginid', '$new_name', '$new_password', '$birthday_complete', '$new_address',  '$new_email', '$new_phone_number');") || die(mysql_error());
            $success = "Your account has been successfully created!";
        }
    }

?>
<html>
    <head>
        <title> Create Manager Account </title>

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
            <div style = "width:500px; border:1px solid black; " align = "left">
                <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Create Manager Account</b> </div>
                <div style = "margin:30px;">
                    <form method = "post">
                        <label> LoginID: </label><input type = "text" name = "loginID_input" class = "box" maxlength = "16" /> <br><br>
                        <label> Password: </label><input type = "password" name = "password_input" class = "box" maxlength = "8" /><br><br>
                        <label> Manager Name: </label><input type = "text" name = "name_input" class = "box" maxlength = "64" /><br><br>
                        <label> Birthday (YYYY-MM-DD): </label><input type = "text" name = "year_bday" class = "box" size = "4" maxlength = "4" onkeypress = "return event.charCode >= 48 && event.charCode <= 57" />-<input type = "text" name = "month_bday" class = "box" size = "2" maxlength = "2" onkeypress = "return event.charCode >= 48 && event.charCode <= 57" />-<input type = "text" name = "day_bday" class = "box" size = "2" maxlength = "2" onkeypress = "return event.charCode >= 48 && event.charCode <= 57" /><br><br>
                        <label> Address: </label> <input type = "text" name = "address_input" class = "box" maxlength = "128" /><br><br>
                        <label> Email: </label> <input type = "text" name = "email_input" class = "box" maxlength = "32" /><br><br>
                        <label> Phone Number: </label> <input type = "text" name = "phone_number_input" class = "box" maxlength = "10" onkeypress = "return event.charCode >= 48 && event.charCode <= 57" /><br><br>
                        <br>
                        <div style = "font-size:13px; color:#cc0000; "><?php echo $error; ?> </div>
                        <div style = "font-size:13px; color:#0cc719; "><?php echo $success; ?> </div>
                        <br>
                        <input type = "submit" name = "submit_info" value = "  Submit  "/><br/>
                        <input type = "submit" name = "go_back_button" value = "  Go Back  "/><br/>
                    </form>
                </div>
            </div>

        </div>

    </body>

</html>
