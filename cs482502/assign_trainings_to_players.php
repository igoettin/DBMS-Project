<!-- This PHP file defines the page that allows a manager to assign trainings to players. -->
<?php
    include("config.php");
    include("manager_view.php");
    session_start();
    $p_ID = $_SESSION['login_user'];
?>

<?php 
    if(isset($_POST['assign_button'])){
        $action_select = $_POST['action_select'];
        $player_select = $_POST['player_select'];
        $training_select = $_POST['training_select'];
        //Assign the new training if the assign action was selected, delete an existing training if the remove action was selected.
        if($action_select === "assign_action") 
            mysql_query("insert into AssignTraining(PlayerID, ManagerID, TrainingName) values('$player_select','$p_ID','$training_select');");
        else if ($action_select === "remove_action")
            mysql_query("delete from AssignTraining where PlayerID = '$player_select' and ManagerID = '$p_ID' and TrainingName = '$training_select';");
    }
    unset($_POST['assign_button']);
?>

<!doctype html>
<html>
    
    <head>
        <style>
            div.tab input.attp{background-color:#32ff32;}
            input[type=checkbox]{width:50px;height:50px;}
            input.op{box-sizing: border-box; width:100%; font-size:100%;}
        </style>
    </head>
    <body>
    <div class = tabcontent>
            <div style = "font-size:13px; color:#cc0000;"><?php print $error_add; ?></div>
            <!-- Assign new training to a player table -->
            <table border = '3'>
                <tr>
                    <th colspan='3'><h3> Assign a new training to a player / Remove existing training assigned to a player</h3></th>
                </tr>
                <tr>
                    <th>Action to Perform</th>
                    <th>Player [ID, Login ID, Name]</th>
                    <th>New Training</th>
                </tr>
                <form method = "post">
                <tr>
                        <td>
                            <select required name = "action_select">
                                <option value = "">None</option>
                                <option value = "assign_action">Assign new training</option>
                                <option value = "remove_action">Remove existing training</option>
                            </select>
                        </td>
                        <td>
                            <select required name = "player_select"> 
                                <option value = "">None</option>
                                <?php
                                    $player_query = (mysql_query("select * from Player;"));
                                    while($row = mysql_fetch_array($player_query)){
                                        $row_value = $row['ID'];
                                        print "<option value = \"$row_value\">[".$row['ID'].", ".$row['LoginID'].", ".$row['Name']."]</option>";
                                    }
                                ?>
                            </select>
                        </td>
                        <td>
                            <select required name = "training_select">
                                <option value = "">None</option>
                                <?php
                                    $training_query = mysql_query("select * from Training;");
                                    while($row = mysql_fetch_array($training_query)){
                                        $row_value = $row['TrainingName'];
                                        print "<option value = \"$row_value\">".$row['TrainingName']."</option>";
                                    }
                                ?>
                            </select>

                        </td>
                </tr>
                <tr>
                        <td colspan = '3'><input type = "submit" name = "assign_button" value = "Assign new training/Remove existing training" class = "op"/></td>
                </tr>
                </form>
            </table>
            </br></br>
            <div style = "font-size:13px; color:#cc0000;"><?php print $error; ?></div>
            <!-- List of Trainings table -->
            <table border = '3'>
                <tr>
                    <th colspan='7'> <h3> List of trainings that were assigned to players by a manager. </h3></th>
                </tr>
                <tr>
                    <th> Player ID </th> 
                    <th> Player Login ID </th> 
                    <th> Player Name </th> 
                    <th> Manager ID</th>
                    <th> Manager LoginID </th>
                    <th> Manager Name </th>
                    <th> Assigned Training(s) </th>
                </tr>
                <?php
                    print "<form method = \"post\">";
                    $row_num = 0;
                    $start = 1;
                    //Fill the table with the assigned trainings from the DB.
                    $assign_query = mysql_query("select * from AssignTraining order by PlayerID asc, ManagerID asc;");
                    while($row = mysql_fetch_array($assign_query)){
                        //Initially (i.e. start of loop), we only consider the first row of the relation, so directly print it out.
                        if($start == 1)
                            $start = 0;
                        //If a player is assigned to more than one training by the same manager,
                        //append the training to the last cell in the table so that an extra row is not created.
                        else if($row['PlayerID'] == $player_ID && $row['ManagerID'] == $manager_ID){
                            $next_training = $row['TrainingName'];
                            print "</br>".$next_training;
                            continue;
                        //End the table row, no more trainings were assigned to the current player by the current manager.
                        } else{
                            print "</td></tr>";
                        }
                        $player_ID = $row['PlayerID'];
                        $manager_ID = $row['ManagerID'];
                        $training_name = $row['TrainingName'];
                        $player_row = mysql_fetch_array(mysql_query("select * from Player where Player.ID = '$player_ID'"));
                        $manager_row = mysql_fetch_array(mysql_query("select * from Manager where Manager.ID = '$manager_ID'"));
                        print "<tr><td>".$player_row['ID']."</td><td>".$player_row['LoginID']."</td><td>".$player_row['Name']."</td><td>".$manager_row['ID']."</td><td>".$manager_row['LoginID']."</td><td>".$manager_row['Name']."</td><td>".$training_name;
                        
                    }
                   
                ?>
                    </form>
            </table>
            <br><br>
            </table>
    </div>
    </body>
</html>
