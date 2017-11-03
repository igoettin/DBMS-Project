<!-- This PHP file defines the welcome page for the player after they log in -->
<?php
    include("player_view.php");
    include("config.php");
    session_start();
    $p_ID = $_SESSION['login_user'];
    //Fetch the player name from the DB so we can print it on the page.
    $player_name = mysql_fetch_array(mysql_query("select Name from Player where ID = '$p_ID';"))['Name'];
?>
<!doctype html>
<html>
    <title> Player Welcome </title>
    <body>
        <div align = "center"><h3> Welcome to your player page, <?php print $player_name ?>. Please select one of the tabs above to navigate.</h3></div>
    </body>
</html>
