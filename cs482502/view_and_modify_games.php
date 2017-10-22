<?php
    include("config.php");
    include("manager_view.php");
    session_start();
    $p_ID = $_SESSION['login_user'];
    $game_query = mysql_query("select * from Game order by GameID asc;");
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
            $_SESSION['update_button'] = 1;
            header("location: vamt_success.php");
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
        $_SESSION['delete_button'] = 1;
        header("location: vamt_success.php");
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
            $_SESSION['add_button'] = 1;
            header("location: vamt_success.php");
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
            div.tab input.vamg{background-color:#32ff32;}
            input[type=checkbox]{width:50px;height:50px;}
            input.op{box-sizing: border-box; width:100%; font-size:100%;}
        </style>
    </head>
    <body>
    <div class = tabcontent>
            <div style = "font-size:13px; color:#cc0000;"><?php print $error_add; ?></div>
            <!-- Add new training table -->
            <table border = '3'>
                <tr>
                    <th colspan='4'><h3> Add a new game </h3></th>
                </tr>
                <tr>
                    <th>Date (YYYY-MM-DD)</th>
                    <th>Result</th>
                    <th>PlayingVenue</th>
                    <th>OpponentTeam</th>
                </tr>
                <form method = "post">
                <tr>
                        <td>
                            <input type = "text" name = "year_date" size = "4" maxlength = "4" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/>
                            -<input type = "text" name = "month_date" size = "2" maxlength = "2" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/>
                            -<input type = "text" name = "day_date" size = "2" maxlength = "2" onekypress="return event.charCode >= 48 && event.charCode <= 57"/>
                        </td>
                        <td>
                            <select required>
                                <option name = "result_select"/>None</option>
                                <option value = "Win">Win</option>
                                <option value = "Tie">Tie</option>
                                <option value = "Lose">Lose</option>
                            </select>
                        </td>
                        <td><textarea name = "playing_venue" maxlength = "256"></textarea></td>
                        <td><input type = "text" name = "opponent_team" maxlength = "32"</td>
                </tr>
                <tr>
                        <td colspan = '4'><input type = "submit" name = "add_button" value = "Add new game" class = "op"/></td>
                </tr>
                </form>
            </table>
            </br></br>
            <div style = "font-size:13px; color:#cc0000;"><?php print $error; ?></div>
            <!-- List of Games table -->
            <table border = '3'>
                <tr>
                    <th colspan='7'> <h3> Games List </h3></th>
                </tr>
                <tr>
                    <th> GameID </th> 
                    <th> Date </th> 
                    <th> Result </th> 
                    <th> PlayingVenue </th>
                    <th> OpponentTeam </th>
                    <th> Check to Update </th>
                </tr>
                <?php
                    print "<form method = \"post\">";
                    $row_num = 0;
                    while($row = mysql_fetch_array($game_query)){
                        $game_ID = $row['GameID'];
                        $year = date('Y',strtotime($row['Date']));
                        $month = date('m',strtotime($row['Date']));
                        $day = date('d',strtotime($row['Date']));
                        $result = $row['Result'];
                        $play_venue = $row['PlayingVenue'];
                        $opt_team = $row['OpponentTeam']; 
                        print "<tr><td>".$game_ID." </td><td><input type = \"text\" name = \"YEAR{".$row_num."}\" size = \"4\" maxlength = \"4\" onkeypress=\"return event.charCode >= 48 && event.charCode <= 57\" />-<input type = \"text\" name = \"MONTH{".$row_num."}\" size = \"2\" maxlength = \"2\" onkeypress=\"return event.charCode >= 48 && event.charCode <= 57\" />-<input type = \"text\" name = \"DAY{".$row_num."}\" size = \"2\" maxlength = \"2\" onekeypress=\"return event.charCode >= 48 && event.charCode <= 57\" /></td>";
                               print "<td><select name = \"RESULT{".$row_num."}\">";
                                if($result === "Win"){
                                    print "<option selected = \"selected\" value = \"Win\">Win</option><option value = \"Tie\">Tie</option><option value = \"Lose\">Lose</option>";
                                }else if($result === "Tie"){
                                    print "<option value = \"Win\">Win</option><option value = \"Tie\" selected = \"selected\">Tie</option><option value = \"Lose\">Lose</option>";
                                }else{
                                    print "<option value =\"Win\">Win</option><option value = \"Tie\">Tie</option><option selected = \"selected\" value = \"Lose\">Lose</option>";
                                }
                                print "</select></td>
                                <td style = \"height: 70px\">"."<textarea name =\"PV{".$row_num."}\" maxlength = \"256\"></textarea> </td>
                                <td><input type = \"text\" name = \"OPT{".$row_num."}\" maxlength = \"32\"/></td>
                                <td><input type = \"checkbox\" name = \"UPDATE_GAME{".$row_num."}\" /></td> 
                        </tr>";
                        $row_num++;
                   }
                   
                ?>
                <tr>
                    
                    <td colspan = '7'> <input type = "submit" name = "update_button" value = "Update games" class = "op" /></td>
                    </form>
                </tr>
            </table>
            <br><br>
            </table>
    </div>
    </body>
</html>
