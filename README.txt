##############################################
#CS482/502 Database Management Systems Project
##############################################
The files in this directory contain our solutions to Phase 2 of the CS482/502 Database Project.
The folder cs482502 contains the php files that make up the web page for the project.
More information on the contents of this folder can be found in the sections "Overview of web site design" and "Fulfilled Project Requirements" of this README.
The folder DB_files contains the sql files that are used to setup the database.
These files are similar to the files from Phase 1 of the project, but have been modified to accomodate some of the requirements of the project.
The modifications that have been made are detailed in the "Changes to database SQL files" section of this README.

#############################
#Overview of web site design
#############################
For our web site, we have designed a UNIFIED login system. That is, both players and managers login through the same login screen, and depending on the credentials given, the system will automatically transfer over to the player subsystem or the manager subsystem.
This means that Login IDs must be distinct among players and managers; no player can have the same login ID as a manager.

We have also designed a unified reset password system. Both players and managers can reset their passwords from the login screen by clicking on the "Reset Account Password" link and filling out the necessary details.

After a player or manager logs in, they can navigate their subsystem page by clicking on one of the tabs at the top of the page. They can also logout from the system by clicking the "Logout" tab.


###############################
#Fulfilled Project Requirements
###############################
This section describes, for each requirement in the project instructions, how the requirement is fulfilled on our web site. This section also details how to navigate our web site to see the fulfilled requirement. 

Player Management Subsystem:

    A. Request a new account
        
        From the login screen, click the "Request a new player account" link. This will transfer you to a page that will allow you to request a new player account.
        From there, you can provide a login ID and password for an account, and request the account for approval. 
        Note that the login ID you provide must not exist in either the Manager relation or the Player relation.
        Also, you will not be able to login with a requested player account until a manager approves it.
        If you have an existing player account (i.e. login id and password) you can reset the password for this account by going back to the login screen (i.e. hit the go back button from the request player account page)
        and clicking the "Reset Account Password" link. From there you can reset your account's password.

    B. Log in
        
        Simply use the log in window on the main web site page. 

    C. View

        After logging in as a player, click the "View Player Information, Assigned Trainings, and Player Statistics" tab to view the player's information.
        This includes the player's information from the Player relation, assigned trainings for the player, and the player's statistics.

    D. Edit

        After logging in as a player, click the "Edit Player Information" to edit the player's information as it appears in the Player relation.
        If you want to edit the player's stats, click the "Edit Player Statistics" tab. This page will allow you to add a new statistic, update an existing statistic, or delete an existing statistic.

    E. Logout

        After logging in as a player, click the "Logout" tab to logout and return to the main login page.


Manager administration sub-system:

    A. Create an account

        From the login screen, click the "Create a new manager account" link. This will transfer you to a page that will allow you to create a new manager account.
        Note that the login ID of the new manager must not exist in either the Manager relation or the Player relation.
        If you would like to reset the password for an existing Manager account (i.e. you have the login ID and password for the account) you can reset the password by going back to the login screen (i.e. hit the go back buttomfrom the create a new manager account page) and clicking the "Reset Account Password" link. From there you can reset your account's password.

    B. Log in

        Simply use the log in window on the main web site page.

    C. View

        After logging in as a manager, click the "View Manager Info" tab to view the manager's information. Here you can also download one or several of a manager's certificates. 
        Each certificate is identified by its Certificate ID, along with a thumbnail that shows a preview of what the certificate looks like.
        When a certificate is downloaded, it will be downloaded as a jpeg file (.jpg).

    D. Edit

        After logging in as a manager, click the "Edit Manager Info" tab to edit the manager's information. Here you can also upload a new certificate or re-upload an existing certificate.
        Only jpeg files (.jpg) are accepted as certificates. Other file types are not supported.

    E. View Players

        After logging in as a manager, click the "View Players" tab to view each player's information and each player's statistics. 
        The listing showing the Player's information is ordered by the Player's names. 
    
    F. View, add, update, and delete trainings.

        After logging in as a manager, click the "View and Modify Trainings" tab to view and edit the trainings.
        Trainings cannot be deleted if they are assigned to a player.

    G. View and assign trainings to players.

        After logging in as a manager, click the "Assign Trainings to Players" tab to view assigned trainings and to assign a new training to a player.
        From this page, you can also remove trainings from players as well.

    H. View, add, and update games.

        After logging in as a manager, click the "View and Modify Games" tab to view all games and add/update a game.
   
    I. Assign players to games

        After logging in as a manager, click the "Assign Players to Games" tab to assign a player to an existing game.

    J. Approve players' log-in requests

        After logging in as a manager, click the "Approve player log-in requests" tab to approve player accounts that have been requested.
        From this page, you can also reset the passwords of existing players that have already been approved.

    K. Logout

        After logging in as a manager, click the "Logout" button to logout and return to the main login page.


##############################
#Changes to database SQL files
##############################
We have made two changes to our CreateDB.sql file from what we submitted in phase 1 of the project.
The first change is a new attribute added to the Player relation called RequestFlag.
When a player account is requested, the RequestFlag is set to 0. This prevents the player from logging into his/her account until it is approved by a manager.
Once a manager has approved the account, the RequestFlag is set to 1 and the player can freely log in to the player subsystem.
The second change we've made to the CreateDB.sql file is changing the type of the Certificate attribute in the ManagerCertificate relation.
Previously, the type was set to blob. We have changed it to be longblob so that larger jpeg files can be stored in the database and represented on the web site.

 
