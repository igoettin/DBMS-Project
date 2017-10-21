<?php
    include("config.php");
    include("manager_view.php");
    session_start();
    $p_ID = $_SESSION['login_user'];
?>

<?php 
    if(isset($_POST['assign_button'])){
        $player_select = $_POST['player_select'];
        $training_select = $_POST['training_select'];
        mysql_query("insert into AssignTraining(PlayerID, ManagerID, TrainingName) values('$player_select','$p_ID','$training_select');");
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
                    <th colspan='2'><h3> Assign a new training to a player </h3></th>
                </tr>
                <tr>
                    <th>Player [ID, LoginID, Name]</th>
                    <th>New Training</th>
                </tr>
                <form method = "post">
                <tr>
                        <td>
                            <select required name = "player_select"> 
                                <option value = "">None</option>
                                <?php
                                    $player_query = (mysql_query("select * from Player;"));
                                    while($row = mysql_fetch_array($player_query)){
                                        print "<option value = ".$row['ID'].">[".$row['ID'].", ".$row['LoginID'].", ".$row['Name']."]</option>";
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
                                        print "<option value = ".$row['TrainingName'].">".$row['TrainingName']."</option>";
                                    }
                                ?>
                            </select>

                        </td>
                </tr>
                <tr>
                        <td colspan = '3'><input type = "submit" name = "assign_button" value = "Assign new training" class = "op"/></td>
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
                    <th> Player LoginID </th> 
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
                    $assign_query = mysql_query("select * from AssignTraining order by PlayerID asc, ManagerID asc;");
                    while($row = mysql_fetch_array($assign_query)){
                        if($start == 1)
                            $start = 0;
                        else if($row['PlayerID'] == $player_ID && $row['ManagerID'] == $manager_ID){
                            $next_training = $row['TrainingName'];
                            print "</br>".$next_training;
                            continue;
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
