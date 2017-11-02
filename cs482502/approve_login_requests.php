<?php
    include("config.php");
    include("manager_view.php");
    session_start();
    $p_ID = $_SESSION['login_user'];
?>

<?php 
    if(isset($_POST['approve_button'])){
        $row_num = 0;
        $new_player_query = mysql_query("select * from Player where RequestFlag = 0;");
        while($row = mysql_fetch_array($new_player_query)){
            if(isset($_POST["approve{".$row_num."}"])){  
                $login_id = $row['LoginID'];
                mysql_query("update Player set RequestFlag = 1 where LoginID = '$login_id';") || die(mysql_error()); 
            }
            $row_num++;
        }
        $success = "All checked login IDs have been approved!";
    }
    else if(isset($_POST['update_button'])){
        $row_num = 0;
        $player_query = mysql_query("select * from Player where RequestFlag = 1;");
        while($row = mysql_fetch_array($player_query)){
            if(isset($_POST["update{".$row_num."}"])){
                $login_id = $row['LoginID'];
                $password = $_POST['password{'.$row_num.'}'];
                echo $password;
                mysql_query("update Player set Password = '$password' where LoginID = '$login_id';");
            }
            $row_num++;
        }
        $success_update = "All checked passwords have been reset!";
    }
    unset($_POST['update_button']);
    unset($_POST['approve_button']);
?>

<!doctype html>
<html>
    
    <head>
        <style>
            div.tab input.ap{background-color:#32ff32;}
            input[type=checkbox]{width:50px;height:50px;}
            input.op{box-sizing: border-box; width:100%; font-size:100%;}
        </style>
    </head>
    <body>
    <div class = tabcontent>
            <div style = "font-size:13px; color:#008200;"><?php print $success; ?></div>        
            <!-- Approve table -->
            <table border = '3'>
                <tr>
                    <th colspan='2'> <h3> Approve new player login </h3></th>
                </tr>
                <tr>
                    <th> LoginID </th> 
                    <th> Check to approve </th> 
                </tr>
                <?php
                    print "<form method = \"post\">";
                    $row_num = 0;
                    $player_query = mysql_query("select * from Player where RequestFlag = 0");
                    while($row = mysql_fetch_array($player_query)){
                        $login_id = $row['LoginID'];
                        print "<tr><td>".$login_id." </td>
                               <td><input type = \"checkbox\" name = \"approve{".$row_num."}\" /></td></tr>";
                        $row_num++;
                   }
                   
                ?>
                <tr>
                    <td colspan = '2'> <input type = "submit" name = "approve_button" value = "Approve login IDs" class = "op" /></td>
                    </form>
                </tr>
            </table>
            <br><br>
            <!-- Reset password table-->
            <div style = "font-size:13px; color:#008200;"><?php print $success_update; ?></div>   
            <table border = '3'>
                <tr>
                    <th colspan='3'> <h3> Reset approved player passwords </h3></th>
                </tr>
                <tr>
                    <th> LoginID </th> 
                    <th> New Password </th> 
                    <th> Check to update </th>
                </tr>
                <?php
                    print "<form method = \"post\">";
                    $row_num = 0;
                    $player_query = mysql_query("select * from Player where RequestFlag = 1");
                    while($row = mysql_fetch_array($player_query)){
                        $login_id = $row['LoginID'];
                        print "<tr><td>".$login_id." </td>
                               <td><input type = \"text\" name = \"password{".$row_num."}\" class = \"box\" maxlength = \"8\"/></td>
                               <td><input type = \"checkbox\" name = \"update{".$row_num."}\" /></td></tr>";
                        $row_num++;
                   }
                   
                ?>
                <tr>
                    <td colspan = '3'> <input type = "submit" name = "update_button" value = "Reset passwords" class = "op" /></td>
                    </form>
                </tr>
            </table>

            </table>
    </div>
    </body>
</html>
