<!-- This PHP file defines the page that allows a manager to assign players to games. -->
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
        $game_select = $_POST['game_select'];
        //Assign the player to the game if the assign action was picked, remove the player from a game if the remove action was picked.
        if($action_select === "assign_action") 
            mysql_query("insert into Play(PlayerID, GameID) values('$player_select','$game_select');");
        else if ($action_select === "remove_action")
            mysql_query("delete from Play where PlayerID = '$player_select' and GameID = '$game_select';");
    }
    unset($_POST['assign_button']);
?>

<!doctype html>
<html>
    
    <head>
        <style>
            div.tab input.aptg{background-color:#32ff32;}
            input[type=checkbox]{width:50px;height:50px;}
            input.op{box-sizing: border-box; width:100%; font-size:100%;}
        </style>
    </head>
    <body>
    <div class = tabcontent>
            <div style = "font-size:13px; color:#cc0000;"><?php print $error_add; ?></div>
            <!-- Assign player to a game table -->
            <table border = '3'>
                <tr>
                    <th colspan='3'><h3> Assign a player to game / Remove a player from a game</h3></th>
                </tr>
                <tr>
                    <th>Action to Perform</th>
                    <th>Player [ID, Login ID, Name]</th>
                    <th>Game [Game ID, Date, Playing Venue, Opponent Team]</th>
                </tr>
                <form method = "post">
                <tr>
                        <td>
                            <select required name = "action_select">
                                <option value = "">None</option>
                                <option value = "assign_action">Assign a player to a game</option>
                                <option value = "remove_action">Remove a player from a game</option>
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
                            <select required name = "game_select">
                                <option value = "">None</option>
                                <?php
                                    $game_query = mysql_query("select * from Game;");
                                    while($row = mysql_fetch_array($game_query)){
                                        $row_value = $row['GameID'];
                                        print "<option value = \"$row_value\">".$row['GameID']."</option>";
                                    }
                                ?>
                            </select>

                        </td>
                </tr>
                <tr>
                        <td colspan = '3'><input type = "submit" name = "assign_button" value = "Add player to the game/Remove player from the game" class = "op"/></td>
                </tr>
                </form>
            </table>
            </br></br>
            <div style = "font-size:13px; color:#cc0000;"><?php print $error; ?></div>
            <!-- List of Trainings table -->
            <table border = '3'>
                <tr>
                    <th colspan='7'> <h3> Player/Game assignment. </h3></th>
                </tr>
                <tr>
                    <th> Player ID </th> 
                    <th> Player Login ID </th> 
                    <th> Player Name </th> 
                    <th> Opponent Team</th>
                    <th> Date </th>
                    <th> Playing Venue </th>
                    <th> Game ID(s) </th>
                </tr>
                <?php
                    print "<form method = \"post\">";
                    $row_num = 0;
                    $start = 1;
                    $play_query = mysql_query("select * from Play order by PlayerID asc, GameID asc;");
                    while($row = mysql_fetch_array($play_query)){
                        //First row in the relation, no other training to append yet.
                        if($start == 1)
                            $start = 0;
                        //If, in the relation, the Player is assigned to multiple games, assign the next game to the row
                        //so that a new row does not have to be created.
                        else if($row['PlayerID'] == $player_ID && $row['GameID'] == $game_ID){
                            $next_game = $row['GameID'];
                            print "</br>".$next_game;
                            continue;
                        //There are no more games that assigned to the current player, end the row.
                        } else{
                            print "</td></tr>";
                        }
                        $player_ID = $row['PlayerID'];
                        $game_ID = $row['GameID'];
                        $player_row = mysql_fetch_array(mysql_query("select * from Player where Player.ID = '$player_ID'"));
                        $game_row = mysql_fetch_array(mysql_query("select * from Game where Game.GameID = '$game_ID'"));
                        print "<tr><td>".$player_row['ID']."</td><td>".$player_row['LoginID']."</td><td>".$player_row['Name']."</td><td>".$game_row['OpponentTeam']."</td><td>".$game_row['Date']."</td><td>".$game_row['PlayingVenue']."</td><td>".$game_ID;
                        
                    }
                   
                ?>
                    </form>
            </table>
            <br><br>
            </table>
    </div>
    </body>
</html>
