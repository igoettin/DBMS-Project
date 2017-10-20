<!doctype html>
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

            div.tab button{
                background-color: inherit;
                float: left;
                cursor: pointer;
                padding: 20px 20px;
                transition: 0.4s;
                font-size: 12px;
            }

            div.tab button:hover{background-color: #F78383;} 
            div.tab button.active{background-color: #F52222; outline:none}

            .tabcontent{
                display: none;
                padding: 20px 20px;
                border: 1px solid #c9c7c7;
                border-top: none;
            }
        </style>
    </head>
<body>

    <div class = "tab">
        <button class = "tablinks" onclick="change_menu(event,'View Manager Info')">View Manager Info </button>
        <button class = "tablinks" onclick="change_menu(event,'Edit Manager Info')">Edit Manager Info </button>
        <button class = "tablinks" onclick="change_menu(event,'View Players')">View Players</button>
        <button class = "tablinks" onclick="change_menu(event,'View and Modify Trainings')">View and Modify Trainings </button>
        <button class = "tablinks" onclick="change_menu(event,'Assign Trainings to Players')">Assign Trainings to Players </button>
        <button class = "tablinks" onclick="change_menu(event,'View and Modify Games')">View and Modify Games</button>
        <button class = "tablinks" onclick="change_menu(event,'Assign Players to Games')">Assign Players to Games</button>
        <button class = "tablinks" onclick="change_menu(event,'Approve player log-in requests')">Approve player log-in requests</button>
        <button class = "tablinks" onclick="location.href = 'login.php';">Logout</button>
    </div>

    <div id="View Manager Info" class = "tabcontent">
        <h3>Manager info goes here</h3>
        <?php
            include("index.php");
        ?>
    </div>

    <div id="Edit Manager Info" class = "tabcontent">
        <h3>Edit manager info goes here</h3>
    </div>

    <div id="View Players" class = "tabcontent">
        <h3>Player info goes here</h3>
    </div>

    <div id="View and Modify Trainings" class = "tabcontent">
        <h3>Modify info goes here</h3>
    </div>

    <div id="Assign Trainings to Players" class = "tabcontent">
        <h3>Assign trainings goes here</h3>
    </div>

    <div id="View and Modify Games" class = "tabcontent">
        <h3>Manager info goes here</h3>
    </div>


    <div id="Assign Players to Games" class = "tabcontent">
        <h3>Assign players games go here</h3>
    </div>

    <div id="Approve player log-in requests" class = "tabcontent">
        <h3>Approve log in requests go here</h3>
    </div>

    <script>
        function change_menu(new_event, tab_name) {
            var i, content, links;
            content = document.getElementsByClassName("tabcontent");
            for (i = 0; i < content.length; i++) {
                content[i].style.display = "none";
            }
            links = document.getElementsByClassName("tablinks");
            for (i = 0; i < links.length; i++) {
                links[i].className = links[i].className.replace(" active", "");
            }
            document.getElementById(tab_name).style.display = "block";
            new_event.currentTarget.className += " active";
        }
    </script>
</body>
