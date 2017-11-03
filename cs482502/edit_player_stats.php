<?php
    include("config.php");
    include("player_view.php");
    session_start();
    $p_ID = $_SESSION['login_user'];
    $stats_query = mysql_query("select * from Stats where PlayerID = '$p_ID';");
?>

<?php 
    if(isset($_POST['update_button'])){
        $row_num = 0;
        $new_stats_query = mysql_query("select * from Stats where PlayerID = '$p_ID';");
        while($row = mysql_fetch_array($new_stats_query)){
            if(isset($_POST["update{".$row_num."}"])){
                $old_year = $row['Year'];
                $new_year = $_POST['YEAR{'.$row_num.'}'];
                $total_points = $_POST['TOT{'.$row_num.'}'];
                $aspg = $_POST['ASPG{'.$row_num.'}'];    
                if(empty($new_year)){
                    $error = "Cannot update a statistic, Year is empty! Update aborted.";
                    $stats_query = mysql_query("select * from Stats where PlayerID = '$p_ID';");
                    break;
                }
                else if(empty($total_points)){
                    $error = "Cannot update a statistic, Total Points is empty! Update aborted.";
                    $stats_query = mysql_query("select * from Stats where PlayerID = '$p_ID';");
                    break;
                }
                else if(empty($aspg)){
                    $error = "Cannot update a statistic, ASPG is empty! Update aborted.";
                    $stats_query = mysql_query("select * from Stats where PlayerID = '$p_ID';");
                    break;
                }
                else{
                    mysql_query("update Stats set Year = '$new_year', TotalPoints = '$total_points', ASPG = '$aspg' where PlayerID = '$p_ID' and Year = '$old_year';") || die(mysql_error());
                }
            }
            $row_num++;
        }
        if($row_num == mysql_num_rows($stats_query)){
            $success_update = "All checked statistics have been successfully updated!";
            $stats_query = mysql_query("select * from Stats where PlayerID = '$p_ID';");
        }
    }
    else if(isset($_POST['delete_button'])){
        $row_num = 0;
        $new_stats_query = mysql_query("select * from Stats where PlayerID = '$p_ID';");
        while($row = mysql_fetch_array($new_stats_query)){
            if(isset($_POST["delete{".$row_num."}"])){
                $year = $row['Year'];
                mysql_query("delete from Stats where PlayerID = '$p_ID' and Year = '$year';");
            }
            $row_num++;
        }
        $success_delete = "All checked statistics have been successfully deleted!";
        $stats_query = mysql_query("select * from Stats where PlayerID = '$p_ID';");
    }
    else if(isset($_POST['add_button'])){
        $year = $_POST['add_year'];
        $total_points = $_POST['add_total_points'];
        $aspg = $_POST['add_ASPG'];
        $row = mysql_query("select * from Stats where PlayerID = '$p_ID' and Year = '$year';");
        if(empty($year))
            $error_add = "Cannot add new statistic; the Year is empty!";
        else if(empty($total_points))
            $error_add = "Cannot add new statistic; Total Points is empty!";
        else if(empty($aspg))
            $error_add = "Cannot add new statistic; ASPG is empty!";
        else{
            mysql_query("insert into Stats(PlayerID, Year, TotalPoints, ASPG) values ('$p_ID','$year','$total_points','$aspg');");
            $success_add = "The new statistic has been successfully added!"; 
            $stats_query = mysql_query("select * from Stats where PlayerID = '$p_ID';");
        }
        
    }
    unset($_POST['update_button']);
    unset($_POST['delete_button']);
    unset($_POST['add_button']);
?>

<!doctype html>
<html>
    
    <head>
        <style>
            div.tab input.eps{background-color:#3399ff;}
            input[type=checkbox]{width:50px;height:50px;}
            input.op{box-sizing: border-box; width:100%; font-size:100%;}
        </style>
    </head>
    <body>
    <div class = tabcontent>
            <div style = "font-size:13px; color:#009933; "><?php echo $success_add; ?> </div>
            <div style = "font-size:13px; color:#cc0000;"><?php print $error_add; ?></div>
            <!-- Add new statistic table -->
            <table border = '3'>
                <tr>
                    <th colspan='3'><h3> Add a new statistic </h3></th>
                </tr>
                <tr>
                    <th>Year</th>
                    <th>Total Points</th>
                    <th>ASPG</th>
                </tr>
                <form method = "post">
                <tr>
                        <td><input type = "text" name = "add_year" maxlength = "4" size = "4" onkeypress="return event.charCode >= 48 && event.charCode <= 57"/></td>
                        <td><input type = "text" name = "add_total_points" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength = "9" /></td>
                        <td><input type = "text" name = "add_ASPG" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength = "9"/></td>
                </tr>
                <tr>
                        <td colspan = '3'><input type = "submit" name = "add_button" value = "Add new statistic" class = "op"/></td>
                </tr>
                </form>
            </table>
            </br></br>
            <div style = "font-size:13px; color:#009933;"><?php print $success_update; ?></div>
            <div style = "font-size:13px; color:#009933;"><?php print $success_delete; ?></div>
            <div style = "font-size:13px; color:#cc0000;"><?php print $error; ?></div>
            <!-- List of Statistics table -->
            <table border = '3'>
                <tr>
                    <th colspan='5'> <h3> Update/Delete an existing statistic </h3></th>
                </tr>
                <tr>
                    <th> Year </th> 
                    <th> Total Points </th> 
                    <th> ASPG </th> 
                    <th> Check to Update </th>
                    <th> Check to Delete </th>
                </tr>
                <?php 
                    print "<form method = \"post\">";
                    $row_num = 0;
                    while($row = mysql_fetch_array($stats_query)){
                        $year = $row['Year'];
                        $total_points = $row['TotalPoints'];
                        $ASPG = $row['ASPG'];
                        print "<tr><td><input type = text name =\"YEAR{".$row_num."}\" maxlength = \"4\" size =\"4\" onkeypress=\"return event.charCode >= 48 && event.charCode <= 57\" value ='$year' /></td>"
                              ."<td><input type = text name = \"TOT{".$row_num."}\" maxlength = \"9\" onkeypress=\"return event.charCode >= 48 && event.charCode <= 57\" value = '$total_points'/> </td>"
                              ."<td><input type = text name = \"ASPG{".$row_num."}\" maxlength = \"9\" onkeypress=\"return event.charCode >= 48 && event.charCode <= 57\" value = '$ASPG' /></td>"
                              ."<td><input type = \"checkbox\" name = \"update{".$row_num."}\" /></td>"
                              ."<td><input type = \"checkbox\" name = \"delete{".$row_num."}\" /></td>";
                        $row_num++;
                   }
                  
                ?>
                <tr>
                    
                    <td colspan = '5'> <input type = "submit" name = "update_button" value = "Update statistics" class = "op" />
                                       <input type = "submit" name = "delete_button" value = "Delete statistics" class = "op" /></td>
                    </form>
                </tr>
            </table>
            <br><br>
    </div>
    </body>
</html>
