<?php
    include("config.php");
    include("manager_view.php");
    session_start();
    $p_ID = $_SESSION['login_user'];
    $training_query = mysql_query("select * from Training order by TrainingName asc;");
?>

<?php 
    if(isset($_POST['update_button'])){
        $row_num = 0;
        $new_training_query = mysql_query("select * from Training order by TrainingName asc;");
        while($row = mysql_fetch_array($new_training_query)){
            if(isset($_POST["update{".$row_num."}"])){
                $training_name = $row['TrainingName'];
                $instruction = $_POST['INS{'.$row_num.'}'];
                $time_period = $_POST['TP{'.$row_num.'}'];    
                if(empty($instruction)){
                    $error = "Cannot update the '$training_name' training, Instruction is empty! Update aborted.";
                    $training_query = mysql_query("select * from Training order by TrainingName asc;");
                    break;
                }
                else if(empty($time_period)){
                    $error = "Cannot update the '$training_name' training, TimePeriodInHour is empty! Update aborted.";
                    $training_query = mysql_query("select * from Training order by TrainingName asc;");
                    break;
                }
                else{
                    mysql_query("update Training set Instruction = '$instruction', TimePeriodInHour = '$time_period' where TrainingName = '$training_name';") || die(mysql_error());
                }
            }
            $row_num++;
        }
        if($row_num == mysql_num_rows($training_query)){
            $success_update = "All checked trainings have been successfully updated!";
            $training_query = mysql_query("select * from Training order by TrainingName asc;");
        }
    }
    else if(isset($_POST['delete_button'])){
        $row_num = 0;
        $new_training_query = mysql_query("select * from Training order by TrainingName asc;");
        while($row = mysql_fetch_array($new_training_query)){
            if(isset($_POST["delete{".$row_num."}"])){
                $training_name = $row['TrainingName'];
                mysql_query("delete from Training where TrainingName = '$training_name';");
            }
            $row_num++;
        }
        $success_delete = "All checked trainings have been successfully deleted!";
        $training_query = mysql_query("select * from Training order by TrainingName asc;");
    }
    else if(isset($_POST['add_button'])){
        $training_name = $_POST['add_name'];
        $instruction = $_POST['add_instruction'];
        $time_period = $_POST['add_hours'];
        $row = mysql_query("select * from Training where TrainingName = '$training_name';");
        if(empty($training_name))
            $error_add = "Cannot add new training; the TrainingName is empty!";
        else if(empty($instruction))
            $error_add = "Cannot add new training; the Instruction is empty!";
        else if(empty($time_period))
            $error_add = "Cannot add new training; the TimePeriodInHour is empty!";
        else if(mysql_num_rows($row) > 0)
            $error_add = "Cannot add new training; the TrainingName already exists! It must be unique.";
        else{
            mysql_query("insert into Training(TrainingName,Instruction,TimePeriodInHour) values('$training_name','$instruction','$time_period')");
            $success_add = "The new training has been successfully added!"; 
            $training_query = mysql_query("select * from Training order by TrainingName asc;");
        }
        
    }
    unset($_POST['update_button']);
    unset($_POST['delete_button']);
    unset($_POST['add_button']);
?>

<!doctype html>
<html>
    
    <head>
        <style>
            div.tab input.vamt{background-color:#32ff32;}
            input[type=checkbox]{width:50px;height:50px;}
            input.op{box-sizing: border-box; width:100%; font-size:100%;}
        </style>
    </head>
    <body>
    <div class = tabcontent>
            <div style = "font-size:13px; color:#009933; "><?php echo $success_add; ?> </div>
            <div style = "font-size:13px; color:#cc0000;"><?php print $error_add; ?></div>
            <!-- Add new training table -->
            <table border = '3'>
                <tr>
                    <th colspan='3'><h3> Add a new training </h3></th>
                </tr>
                <tr>
                    <th>Training Name</th>
                    <th>Instruction</th>
                    <th>Time Period In Hour</th>
                </tr>
                <form method = "post">
                <tr>
                        <td><input type = "text" name = "add_name" maxlength = "16"/></td>
                        <td><textarea name = "add_instruction" maxlength = "256"></textarea></td>
                        <td><input type = "text" name = "add_hours" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength = "9"/></td>
                </tr>
                <tr>
                        <td colspan = '3'><input type = "submit" name = "add_button" value = "Add new training" class = "op"/></td>
                </tr>
                </form>
            </table>
            </br></br>
            <div style = "font-size:13px; color:#009933;"><?php print $success_update; ?></div>
            <div style = "font-size:13px; color:#009933;"><?php print $success_delete; ?></div>
            <div style = "font-size:13px; color:#cc0000;"><?php print $error; ?></div>
            <!-- List of Trainings table -->
            <table border = '3'>
                <tr>
                    <th colspan='5'> <h3> Trainings List (Update/Delete) </h3></th>
                </tr>
                <tr>
                    <th> TrainingName </th> 
                    <th> Instruction </th> 
                    <th> TimePeriodInHour </th> 
                    <th> Check to Update </th>
                    <th> Check to Delete </th>
                </tr>
                <?php
                    print "<form method = \"post\">";
                    $row_num = 0;
                    while($row = mysql_fetch_array($training_query)){
                        $training_name = $row['TrainingName'];
                        $instruction = $row['Instruction'];
                        $time_period = $row['TimePeriodInHour'];
                        print "<tr><td>".$training_name." </td>
                                <td style = \"height: 70px\">"."<textarea name =\"INS{".$row_num."}\" maxlength = \"256\">".$instruction."</textarea> </td>
                                <td>"."<input type = \"text\" name =\"TP{".$row_num."}\"value =\"".$time_period."\" onkeypress=\"return event.charCode >= 48 && event.charCode <= 57\" maxlength = \"9\"/></td>"
                                ."<td><input type = \"checkbox\" name = \"update{".$row_num."}\" /></td>";
                        print"<td>";
                        $check_deletion = mysql_num_rows(mysql_query("select * from Player, AssignTraining, Training where Player.ID = AssignTraining.PlayerID and AssignTraining.TrainingName = '$training_name';"));
                        if($check_deletion > 0)
                            print "Cannot delete training; already assigned to a player.";
                        else
                            print "<input type = \"checkbox\" name = \"delete{".$row_num."}\"/>";
                        print "</td>";
                        $row_num++;
                   }
                   
                ?>
                <tr>
                    
                    <td colspan = '5'> <input type = "submit" name = "update_button" value = "Update trainings" class = "op" />
                                       <input type = "submit" name = "delete_button" value = "Delete trainings" class = "op" /></td>
                    </form>
                </tr>
            </table>
            <br><br>
    </div>
    </body>
</html>
