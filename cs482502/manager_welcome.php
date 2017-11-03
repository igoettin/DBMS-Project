<!-- PHP file that prints the welcome message to the manager when they log in -->
<?php
    include("manager_view.php");
    include("config.php");
    session_start();
    $p_ID = $_SESSION['login_user'];
    //Get the manager name for the given ID so we can output it as part of the welcome message.
    $manager_name = mysql_fetch_array(mysql_query("select Name from Manager where ID = '$p_ID';"))['Name'];
?>
<!doctype html>
<html>
    <title> Manager Welcome </title>
    <body>
        <div align = "center"><h3> Welcome to your manager page, <?php print $manager_name ?>. Please select one of the tabs above to navigate.</h3></div>
    </body>
</html>
