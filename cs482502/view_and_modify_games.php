<!-- This PHP file defines the page that allows a manager to view, add, and update games. -->
<?php
    include("check_month_day.php");
    include("config.php");
    include("manager_view.php");
    session_start();
    $p_ID = $_SESSION['login_user'];
?>

<?php 

    if(isset($_POST['update_button'])){
        $row_num = 0; 
        $new_game_query = mysql_query("select * from Game order by GameID asc;");
        while($row = mysql_fetch_array($new_game_query)){
            if(isset($_POST['update{'.$row_num.'}'])){
                $game_id = $row["GameID"];
                $year_date = $_POST["YEAR{".$row_num."}"];
                $month_date = $_POST["MONTH{".$row_num."}"];
                $day_date = $_POST["DAY{".$row_num."}"];
                $result = $_POST["RESULT{".$row_num."}"];
                $playing_venue = $_POST["PV{".$row_num."}"];
                $opponent_team = $_POST["OPT{".$row_num."}"];
                //Update the game if all the given information is valid.
                if(empty($playing_venue))
                    $error = "Cannot update a game; The playing venue is empty!";
                else if(empty($opponent_team))
                    $error = "Cannot update a game; The opponent team is empty!";
                else if(empty($year_date))
                    $error = "Cannot update a game; The year of the date is empty!";
                else if(empty($month_date))
                    $error = "Cannot update a game; The month of the date is empty!";
                else if(empty($day_date))
                    $error = "Cannot update a game; The day of the date is empty!";
                else if(strlen($year_date) < 4)
                    $error = "Cannot update a game; The year of the date must be 4 digits long.";
                else if(strlen($month_date) < 2)
                    $error = "Cannot update a game; The month of the date must be 2 digits long! \n Append a 0 to single digit months (i.e. 01 for January).";
                else if(strlen($day_date) < 2)
                    $error = "Cannot update a game; The day of the date must be 2 digits long! \n Append a 0 to single digit days (i.e. 01 for 1).";
                else if(check_month_day((int)$month_date, (int)$day_date) == false)
                    $error = "Cannot update a game; The day and month of the date are invalid.";
                else{
                    $date_complete = $year_date."-".$month_date."-".$day_date;
                    mysql_query("update Game set Date = '$date_complete', Result = '$result', PlayingVenue = '$playing_venue', OpponentTeam = '$opponent_team' where GameID = '$game_id';");
                }
            }
            $row_num++;       
        }
    $success = "All checkmarked games have been updated successfully!";
    }
    else if(isset($_POST['add_button'])){
        $year_date = $_POST["year_date"];
        $month_date = $_POST["month_date"];
        $day_date = $_POST["day_date"];
        $result_select = $_POST["result_select"];
        $playing_venue = $_POST["playing_venue"];
        $opponent_team = $_POST["opponent_team"];
        //Add the game if all the information is valid.
        if(empty($year_date))
            $error_add = "Cannot add new game; the year of the date is empty!";
        else if(empty($month_date))
            $error_add = "Cannot add new game; the month of the date is empty!";
        else if(empty($day_date))
            $error_add = "Cannot add new game; the day of the date is empty!";
        else if(strlen($year_date) < 4)
            $error_add = "Cannot add new game; The year of the date must be 4 digits long.";
        else if(strlen($month_date) < 2)
            $error_add = "Cannot add new game; The month of the date must be 2 digits long! \n Append a 0 to single digit months (i.e. 01 for January).";
        else if(strlen($day_date) < 2)
            $error_add = "Cannot add new game; The day of the date must be 2 digits long! \n Append a 0 to single digit days (i.e. 01 for 1).";
        else if(check_month_day((int)$month_date, (int)$day_date) == false)
            $error_add = "Cannot add a game; The day and month of the date are invalid.";
        else if(empty($playing_venue))
            $error_add = "Cannot add a game; The playing venue is empty!";
        else if(empty($opponent_team))
            $error_add = "Cannot add a game; The opponent team is empty!";
        else{
            $date_complete = $year_date."-".$month_date."-".$day_date;
            $max_lookup = mysql_fetch_array(mysql_query("select max(GameID) from Game;"))['max(GameID)'];
            if($max_lookup == null)
                $game_id = 0;
            else
                $game_id = $max_lookup + 1;
            mysql_query("insert into Game(GameID, Date, Result, PlayingVenue, OpponentTeam) values('$game_id','$date_complete','$result_select','$playing_venue','$opponent_team');");
            $success_add = "New game has been successfully added!";
        }
    }
    unset($_POST['update_button']);
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
            <div style = "font-size:13px; color:#008200;"><?php print $success_add; ?></div>
            <div style = "font-size:13px; color:#cc0000;"><?php print $error_add; ?></div>
            <!-- Add new training table -->
            <table border = '3'>
                <tr>
                    <th colspan='4'><h3> Add a new game </h3></th>
                </tr>
                <tr>
                    <th>Date (YYYY-MM-DD)</th>
                    <th>Result</th>
                    <th>Playing Venue</th>
                    <th>Opponent Team</th>
                </tr>
                <form method = "post">
                <tr>
                        <td>
                            <input type = "text" name = "year_date" size = "4" maxlength = "4" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/>
                            -<input type = "text" name = "month_date" size = "2" maxlength = "2" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/>
                            -<input type = "text" name = "day_date" size = "2" maxlength = "2" onekypress="return event.charCode >= 48 && event.charCode <= 57"/>
                        </td>
                        <td>
                            <select name = "result_select" required>
                                <option value = "">None</option>
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
            <div style = "font-size:13px; color:#008200;"><?php print $success; ?></div>
            <div style = "font-size:13px; color:#cc0000;"><?php print $error; ?></div>
            <!-- List of Games table -->
            <table border = '3'>
                <tr>
                    <th colspan='7'> <h3> Games List </h3></th>
                </tr>
                <tr>
                    <th> Game ID </th> 
                    <th> Date </th> 
                    <th> Result </th> 
                    <th> Playing Venue </th>
                    <th> Opponent Team </th>
                    <th> Check to Update </th>
                </tr>
                <?php
                    print "<form method = \"post\">";
                    $row_num = 0;
                    $game_query = mysql_query("select * from Game order by GameID asc;");
                    //For each game in the relation, print it to the table as a row.
                    while($row = mysql_fetch_array($game_query)){
                        $game_ID = $row['GameID'];
                        $year = date('Y',strtotime($row['Date']));
                        $month = date('m',strtotime($row['Date']));
                        $day = date('d',strtotime($row['Date']));
                        $result = $row['Result'];
                        $play_venue = $row['PlayingVenue'];
                        $opt_team = $row['OpponentTeam']; 
                        print "<tr><td>".$game_ID." </td><td><input type = \"text\" name = \"YEAR{".$row_num."}\" size = \"4\" maxlength = \"4\" onkeypress=\"return event.charCode >= 48 && event.charCode <= 57\" value = '$year'/>-<input type = \"text\" name = \"MONTH{".$row_num."}\" size = \"2\" maxlength = \"2\" onkeypress=\"return event.charCode >= 48 && event.charCode <= 57\" value = '$month'/>-<input type = \"text\" name = \"DAY{".$row_num."}\" size = \"2\" maxlength = \"2\" onekeypress=\"return event.charCode >= 48 && event.charCode <= 57\" value = '$day'/></td>";
                               print "<td><select name = \"RESULT{".$row_num."}\">";
                                if($result === "Win"){
                                    print "<option selected = \"selected\" value = \"Win\">Win</option><option value = \"Tie\">Tie</option><option value = \"Lose\">Lose</option>";
                                }else if($result === "Tie"){
                                    print "<option value = \"Win\">Win</option><option value = \"Tie\" selected = \"selected\">Tie</option><option value = \"Lose\">Lose</option>";
                                }else{
                                    print "<option value =\"Win\">Win</option><option value = \"Tie\">Tie</option><option selected = \"selected\" value = \"Lose\">Lose</option>";
                                }
                                print "</select></td>
                                <td style = \"height: 70px\">"."<textarea name =\"PV{".$row_num."}\" maxlength = \"256\">".$play_venue."</textarea> </td>
                                <td><input type = \"text\" name = \"OPT{".$row_num."}\" maxlength = \"32\"/ value = '$opt_team'></td>
                                <td><input type = \"checkbox\" name = \"update{".$row_num."}\" /></td> 
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
