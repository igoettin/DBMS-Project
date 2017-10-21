<?php
    include("config.php");
    include("manager_view.php");
    session_start();
    $p_ID = $_SESSION['login_user'];
?>

<?php
    if(isset($_POST['return_button']))
        header("location: view_and_modify_trainings.php");
?>

<!doctype html>
<html>
    
    <head>
        <style>
            div.tab input.vamt{background-color:#32ff32;}
            input[type=checkbox]{width:50px;height:50px;}
            input.op{box-sizing: border-box; width:100%; font-size:100%;}
        </style>
    </head>
    <body>
        <?php
            if($_SESSION['update_button'] == 1){
                print "<div style=\"font-size:20px; color:#008200; display:inline-block;\"> All checked trainings have been successfully updated! Click return to go back to the previous screen.</div>";
                unset($_SESSION['update_button']);
            }
            else if($_SESSION['delete_button'] == 1){
                print "<div style=\"font-size:20px; color:#008200\"> All checked trainings have been successfully deleted! Click return to go back to the previous screen.</div>";
                unset($_SESSION['delete_button']);
            }
            else if($_SESSION['add_button'] == 1){
                print "<div style=\"font-size:20px; color:#008200\"> Your new training has been successfully added! Click return to go back to the previous screen.</div>";
                unset($_SESSION['add_button']);
            }
        ?>
        <form method = "post"><input class ="op" type = "submit" value = "Return" name = "return_button"/></form>
   </body>
</html>
