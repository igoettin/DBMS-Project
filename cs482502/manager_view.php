<!doctype html>
<?php
    include("config.txt");
    session_start();
?>
<html>
    <head>
        <style>
            body{font-family: "Helvetica", sans-serif;}
            input.middle:focus{outline-width: 0;}
            div.tab{
                overflow: hidden;
                border: 2px solid #555559;
                background-color: #c9c7c7;
            }

            div.tab input{
                background-color: inherit;
                float: left;
                cursor: pointer;
                padding: 20px 20px;
                transition: 0.4s;
                font-size: 12px;
            }
            
            div.tab button.vmi{background-color: #32ff32;}
        
            div.tab input:hover{background-color: #99ff99;} 

            .tabcontent{
                /*display: none;*/
                padding: 20px 20px;
                border: 1px solid #c9c7c7;
                border-top: none;
            }
        </style>
    </head>
<body>
    <form method = "post">
    <div class = "tab">
        <input type = "submit" name = "vmi" class = "vmi" value = "View Manager Info"/> 
        <input type = "submit" name = "emi" class = "emi" value = "Edit Manager Info"/> 
        <input type = "submit" name = "vp" class = "vp" value = "View Players"/>
        <input type = "submit" name = "vamt" class = "vamt" value = "View and Modify Trainings"/>
        <input type = "submit" name = "attp" class = "attp" value = "Assign Trainings to Players"/> 
        <input type = "submit" name = "vamg" class = "vamg" value = "View and Modify Games"/>
        <input type = "submit" name = "aptg" class = "aptg" value = "Assign Players to Games"/>
        <input type = "submit" name = "ap" class = "ap" value = "Approve player log-in requests"/>
        <input type = "submit" name = "lg" class = "lg" value = "Logout"/>
    </div>
    </form>

    <?php
        
        if(isset($_POST['vamg'])){
            unset($_POST['vamg']);
            header("location: view_and_modify_games.php");
        }
 
        if(isset($_POST['attp'])){
            unset($_POST['attp']);
            header("location: assign_trainings_to_players.php");
        }

        if(isset($_POST['vmi'])){
            unset($_POST['vmi']);
            header("location: manager_info.php");
        }
        if(isset($_POST['vp'])){
            unset($_POST['vmi']);
            header("location: view_players.php");
        }
        if(isset($_POST['vamt'])){
            unset($_POST['vamt']);
            header("location: view_and_modify_trainings.php");
        }

        if(isset($_POST['lg'])){
            unset($_POST['lg']);
            header("location: login.php");
        }
    ?>
<!--
    <div id="View Manager Info" class = "tabcontent">
        <h3>Manager info goes here</h3>
    </div>
    
    <div id="Edit Manager Info" class = "tabcontent">
    </div>

    <div id="View Players" class = "tabcontent">
    </div>

    <div id="View and Modify Trainings" class = "tabcontent">
    </div>

    <div id="Assign Trainings to Players" class = "tabcontent">
    </div>

    <div id="View and Modify Games" class = "tabcontent">
    </div>

    <div id="Assign Players to Games" class = "tabcontent">
    </div>

    <div id="Approve player log-in requests" class = "tabcontent">
    </div>
-->
</body>
