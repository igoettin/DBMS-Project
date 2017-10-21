<?php
    include("config.php");
    include("manager_view.php");
    session_start();
    $p_ID = $_SESSION['login_user'];
    $player_query = mysql_query("select * from Player order by Player.Name asc;");
    $stats_query = mysql_query("select * from Stats order by Stats.PlayerID asc;"); 
?>
<html>
    
    <head>
        <style>
            div.tab input.vp{background-color:#32ff32}
        </style>
    </head>
    <body>
    <div class = tabcontent>
            <!-- Player info table -->
            <table border = '3'>
                <tr>
                    <th colspan='9'> <h3> Players Information</h3></th>
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
            <!-- Table to show the stats for the player -->
            <table border = '3'>
                <tr>
                    <th colspan='4'><h3> Statistics for each Player </h3> </th> 
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
    </div>
    </body>
</html>
