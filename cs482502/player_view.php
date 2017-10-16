<?php
    include("config.php");
    session_start();
    $player_query = $_SESSION['login_user'];
    echo $player_query;
?>
<html>
    
    <head>
        <title>Player Welcome </title>
    </head>
    <body>
        <h1>Welcome Player</h1> 
     
            <table border = '3'>
                <tr>
                    <th colspan= '9'> <h3> Player Information | <a href = "edit_player.php">Edit Info</a></h3></th>
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
                    while($row = mysql_fetch_array($_SESSION['login_user']))
                        print "<tr><td>".$row['ID']."</td><td>".$row['LoginID']."</td><td>".$row['Name']."</td><td>".$row['Password']."</td><td>".$row['Birthday']."</td><td>".$row['Address']."</td><td>".$row['Email']."</td><td>".$row['PhoneNumber']."</td><td>".$row['PlayPos']."</td></tr>";
                ?>
            </table>
        <h2><a href = "logout.php">Log Out</a></h2>
    </body>
</html>
