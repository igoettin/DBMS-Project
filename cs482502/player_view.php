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
        
            div.tab input:hover{background-color: #66ccff;} 

            .tabcontent{
                padding: 20px 20px;
                border: 1px solid #c9c7c7;
                border-top: none;
            }
        </style>
    </head>
<body>
    <form method = "post">
    <div class = "tab">
        <input type = "submit" name = "vpi" class = "vpi" value = "View Player Information, Assigned Trainings, and Player Statistics"/> 
        <input type = "submit" name = "epi" class = "epi" value = "Edit Player Information"/> 
        <input type = "submit" name = "eps" class = "eps" value = "Edit Player Statistics"/>
        <input type = "submit" name = "lg" class = "lg" value = "Logout"/>
    </div>
    </form>

    <?php
        if(isset($_POST['vpi'])){
            unset($_POST['vpi']);
            header("location: player_info.php");
        }

        if(isset($_POST['epi'])){
            unset($_POST['epi']);
            header("location: edit_player_info.php");
        }
        
        if(isset($_POST['eps'])){
            unset($_POST['eps']);
            header("location: edit_player_stats.php");
        }

        if(isset($_POST['lg'])){
            unset($_POST['lg']);
            header("location: login.php");
        }
    ?>
</body>
