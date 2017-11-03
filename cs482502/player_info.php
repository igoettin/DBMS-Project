<?php
    include("player_view.php");
    include("config.php");
    session_start();
    $p_ID = $_SESSION['login_user'];
    $player_query = mysql_query("select * from Player where ID = '$p_ID';");
    $assign_training_query = mysql_query("select * from AssignTraining, Manager where PlayerID = '$p_ID' and AssignTraining.ManagerID = Manager.ID;");
    $stats_query = mysql_query("select * from Stats where PlayerID = '$p_ID';"); 
?>
<html>
    
    <head>
        <title>View Player Info, Assigned Trainings, and Stats </title>
        <style>
            div.tab input.vpi{background-color:#3399ff;}
        </style>
    </head>
    <body>
            <br><br>
            <!-- Player info table -->
            <table border = '3'>
                <tr>
                    <th colspan='9'> <h3> Player Information </h3></th>
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
                    while($row = mysql_fetch_array($player_query)){
                        print "<tr><td>".$row['ID']."</td><td>".$row['LoginID']."</td><td>".$row['Name']."</td><td>";
                        for($i = 0; $i < strlen((string)$row['Password']); $i++) print "*";
                        print "</td><td>".$row['Birthday']."</td><td>".$row['Address']."</td><td>".$row['Email']."</td><td>".$row['PhoneNumber']."</td><td>".$row['PlayPos']."</td></tr>";
                    }
                ?>
            </table>
            <br><br>
            <!-- Table to show the assigned trainings for the player -->
            <table border = '3'>
                <tr>
                    <th colspan='3'> <h3> Assigned Trainings </h3> </th>
                </tr>
                <tr>
                    <th> Training Name </th>
                    <th> ID of manager who assigned the training
                    <th> Name of manager who assigned the training </th>
               </tr>
                <?php
                    while($row = mysql_fetch_array($assign_training_query))
                        print "<tr><td>".$row['TrainingName']."</td><td>".$row['ManagerID']."</td><td>".$row['Name']."</td></tr>";
                ?> 
            </table>
            <br><br>
            <!-- Table to show the stats for the player -->
            <table border = '3'>
                <tr>
                    <th colspan='4'><h3> Player Stats </h3> </th> 
                </tr>
                <tr>
                    <th> Year </th>
                    <th> Total Points </th>
                    <th> ASPG </th>
                </tr>
                <?php
                    while($row = mysql_fetch_array($stats_query))
                        print "<tr><td>".$row['Year']."</td><td>".$row['TotalPoints']."</td><td>".$row['ASPG']."</td><tr>";
                ?>
            </table>
    </body>
</html>
