<?php
    include("config.php");
    session_start();
    $p_ID = $_SESSION['login_user'];
    $player_query = mysql_query("select * from Player where ID = '$p_ID';");
    $assign_training_query = mysql_query("select * from AssignTraining where PlayerID = '$p_ID';");
    $stats_query = mysql_query("select * from Stats where PlayerID = '$p_ID';"); 
?>
<html>
    
    <head>
        <title>Player Welcome </title>
    </head>
    <body>
        <h1>Welcome <?php print mysql_fetch_array(mysql_query("select Name from Player where ID = '$p_ID';"))['Name']."!"; ?></h1> 
            <!-- Player info table -->
            <table border = '3'>
                <tr>
                    <th colspan='9'> <h3> Player Information | <a href = "edit_player.php">Edit Info</a></h3></th>
                </tr>
                <tr>
                    <th> ID </th> 
                    <th> LoginID </th> 
                    <th> Name </th> 
                    <th> Password </th>
                    <th> Birthday </th> 
                    <th> Address </th> 
                    <th> Email </th> 
                    <th> PhoneNumber </th> 
                    <th> PlayPos </th>
                </tr>
                <?php
                    while($row = mysql_fetch_array($player_query))
                        print "<tr><td>".$row['ID']."</td><td>".$row['LoginID']."</td><td>".$row['Name']."</td><td>".$row['Password']."</td><td>".$row['Birthday']."</td><td>".$row['Address']."</td><td>".$row['Email']."</td><td>".$row['PhoneNumber']."</td><td>".$row['PlayPos']."</td></tr>";
                ?>
            </table>
            <br><br>
            <!-- Table to show the assigned trainings for the player -->
            <table border = '3'>
                <tr>
                    <th colspan='3'> <h3> Assigned Trainings </h3> </th>
                </tr>
                <tr>
                    <th> PlayerID </th>
                    <th> ManagerID </th>
                    <th> TrainingName </th>
                </tr>
                <?php
                    while($row = mysql_fetch_array($assign_training_query))
                        print "<tr><td>".$row['PlayerID']."</td><td>".$row['ManagerID']."</td><td>".$row['TrainingName']."</td></tr>";
                ?> 
            </table>
            <br><br>
            <!-- Table to show the stats for the player -->
            <table border = '3'>
                <tr>
                    <th colspan='4'><h3> Player Stats </h3> </th> 
                </tr>
                <tr>
                    <th> PlayerID </th>
                    <th> Year </th>
                    <th> TotalPoints </th>
                    <th> ASPG </th>
                </tr>
                <?php
                    while($row = mysql_fetch_array($stats_query))
                        print "<tr><td>".$row['PlayerID']."</td><td>".$row['Year']."</td><td>".$row['TotalPoints']."</td><td>".$row['ASPG']."</td><tr>";
                ?>
            </table>
        <h2><a href = "logout.php">Log Out</a></h2>
    </body>
</html>
