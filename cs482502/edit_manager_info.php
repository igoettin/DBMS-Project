<!-- This PHP file defines the page that allows a manager to edit his/her information as well as upload a new certificate or re-upload an existing certificate -->
<!doctype html>
<?php
    include("manager_view.php");
    include("check_month_day.php");
    include("config.php");
    session_start();
    $p_ID = $_SESSION['login_user'];
    $manager_row = mysql_fetch_array(mysql_query("select * from Manager where ID = '$p_ID';"));
    if(isset($_POST['submit_info'])){
        $new_password = $_POST['password_input'];
        $new_name = $_POST['name_input'];
        $new_year = ($_POST['year_bday']);
        $new_month = ($_POST['month_bday']);
        $new_day = ($_POST['day_bday']);
        $new_address = ($_POST['address_input']);
        $new_email = ($_POST['email_input']);
        $new_phone_number = ($_POST['phone_number_input']);
        //Update the manager's information if all the given information is valid.
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
            mysql_query("update Manager set Password = '$new_password', Name = '$new_name', Birthday = '$birthday_complete', Address = '$new_address', Email = '$new_email', PhoneNumber = '$new_phone_number' where ID = '$p_ID';") || die(mysql_error());
            $success = "Your account details have been successfully updated!";
            $manager_row = mysql_fetch_array(mysql_query("select * from Manager where ID = '$p_ID';"));
        }
    }
    else if(isset($_POST['upload_cert'])){
        $tmp_name = $_FILES['file']['tmp_name'];
        $file_content = file_get_contents($tmp_name);
        //Check that a file was given for submission
        if(empty($file_content))
            $error_upload = "No certificate given for upload!";
        else{
            //If there is no certificate in the DB for this manager, assign certificate ID to 0. 
            //Otherwise, assign the certificate ID to be the max certificate ID in the DB + 1.
            $max_lookup = mysql_fetch_array(mysql_query("select max(CertificateId) from ManagerCertificate where ManagerID = '$p_ID';"))['max(CertificateId)'];
            if ($max_lookup == null)
                $new_ID = 0;
            else
                $new_ID = $max_lookup + 1;
            //Insert the byte content of the file into the DB for the blob. mysql_escape_string is used so that no errors are caused if the byte content of the image contains string chars.
            mysql_query("insert into ManagerCertificate(ManagerID, CertificateId, Certificate) values('$p_ID','$new_ID','".mysql_escape_string($file_content)."');") || die(mysql_error());
            $success_upload = "Your new certificate has been successfully uploaded!";
        }
    }
    else if(isset($_POST['reupload_cert'])){
        $tmp_name = $_FILES['reupload_file']['tmp_name'];
        $file_content = file_get_contents($tmp_name);
        if(empty($file_content))
            $error_reupload = "No certificate given for reupload!";
        else{
            $cert_id = $_POST['reupload_id'];
            //Update the certificate with new byte content.
            mysql_query("update ManagerCertificate set Certificate = '".mysql_escape_string($file_content)."' where ManagerID = '$p_ID' and CertificateId = '$cert_id';");
            $success_reupload = "Your certificate has been successfully re-uploaded!";
        }

    }

    unset($_POST['submit_info']);
    unset($_POST['upload_cert']);
    unset($_POST['reupload_cert']);

?>
<html>
    <head>
        <title> Edit Manager Information </title>

        <style type = "text/css">
            body {
                font-family: Arial, Helvetica, sans-serif;
                font-size:14px;
            }
            div.tab input.emi{background-color:#32ff32;}
            input.op{box-sizing: border-box; width:100%;font-size:100%;} 
        </style>
    </head>
    <body>
        <br><br>
        <div style = "font-size:13px; color:#cc0000; "><?php echo $error; ?> </div>
        <div style = "font-size:13px; color:#009933; "><?php echo $success; ?> </div>
        <table border = '3'>
                <tr>
                   <th colspan = '6'><h3> Edit Manager Information </h3></h3> 
                </tr>    
                <tr>
                    <th>Name</th>
                    <th>Password</th>
                    <th>Birthday</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                </tr>
                <tr>
                    <form method = "post">
                        <td><input type = "text" name = "name_input" class = "box" maxlength = "64" value = "<?php print $manager_row['Name'];?>" /></td>
                        <td><input type = "password" name = "password_input" class = "box" maxlength = "8" value = "<?php print $manager_row['Password']; ?>"/></td>
                        <td><input type = "text" name = "year_bday" class = "box" size = "4" maxlength = "4" onkeypress = "return event.charCode >= 48 && event.charCode <= 57" value = "<?php print date('Y', strtotime($manager_row['Birthday']));?>" />-<input type = "text" name = "month_bday" class = "box" size = "2" maxlength = "2" onkeypress = "return event.charCode >= 48 && event.charCode <= 57" value = "<?php print date('m',strtotime($manager_row['Birthday']));?>" />-<input type = "text" name = "day_bday" class = "box" size = "2" maxlength = "2" onkeypress = "return event.charCode >= 48 && event.charCode <= 57" value = "<?php print date('d',strtotime($manager_row['Birthday']));?>" /></td>
                        <td><input type = "text" name = "address_input" class = "box" maxlength = "128" value = "<?php print $manager_row['Address'];?>" /></td>
                        <td><input type = "text" name = "email_input" class = "box" maxlength = "32" value = "<?php print $manager_row['Email'];?>" /></td>
                        <td><input type = "text" name = "phone_number_input" class = "box" maxlength = "10" onkeypress = "return event.charCode >= 48 && event.charCode <= 57" value = "<?php print $manager_row['PhoneNumber'];?>" /></td>
                </tr>
                        <tr><th colspan = '6'><input type = "submit" name = "submit_info" value = "  Update Information" class = "op"/></th></tr>
                    </form>
        </table>
        <br><br>
        <div style = "font-size:13px; color:#009933; "><?php echo $success_upload; ?> </div>
        <div style = "font-size:13px; color:#cc0000; "><?php echo $error_upload; ?> </div>
        <!-- Upload new cert table -->
        <table border = '3'>
            <form method = "post" enctype="multipart/form-data">
            <tr>
                <th> Upload a new certificate </th>
            </tr>    
            <tr>
               <td><input type = "file" name = "file" id = "file"></td>
            </tr>
            <tr>
                <td><input type = "submit" value = "Upload Certificate" name = "upload_cert" class = "op"></td>
            </tr>
            </form>
        </table>
        <br><br>
        <!-- Re-upload an existing certificate -->
        <div style = "font-size:13px; color:#009933; "><?php echo $success_reupload; ?> </div>
        <div style = "font-size:13px; color:#cc0000; "><?php echo $error_reupload; ?> </div>
        <table border = '3'>
            <form method = "post" enctype="multipart/form-data">
            <tr>
                <th colspan = '2'> Re-upload an existing certificate </th>
            </tr>    
            <tr>
               <td>
                    <select required name = "reupload_id">
                        <option value = "">None</option>
                        <?php
                            $certificate_query = mysql_query("select CertificateId from ManagerCertificate where ManagerID = '$p_ID';");
                            while($row = mysql_fetch_array($certificate_query)){
                                print "<option value = \"".$row['CertificateId']."\">".$row['CertificateId']."</option>";
                            }
                        ?>
                    </select>
               </td>
               <td><input type = "file" name = "reupload_file" id = "reupload_file"></td>
            </tr>
            <tr>
                <td colspan = '2'><input type = "submit" value = "Re-upload Certificate" name = "reupload_cert" class = "op"></td>
            </tr>
            </form>
        </table>
    </body>

</html>
