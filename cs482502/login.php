<!-- This PHP file defines the login page for managers and players. -->
<?php
   include("config.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST") {
        //Get the username and password from text fields
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        //Lookup the provided info in the database
        $player_query = mysql_query("SELECT * FROM Player WHERE LoginID = '$username' and Password = '$password' and RequestFlag = 1;");
        $manager_query = mysql_query("SELECT * FROM Manager WHERE LoginID = '$username' and Password = '$password';");
        $player_row = mysql_fetch_array($player_query);
        $manager_row = mysql_fetch_array($manager_query);
        $p_count = mysql_num_rows($player_query);
        $m_count = mysql_num_rows($manager_query);
        //If login credentials returned a player tuple, login as a player
        if($p_count == 1) {
            $_SESSION['login_user'] = $player_row['ID']; 
            header("location: player_welcome.php");
        //If login credentials returned a manager tuple, login as a manager.
        }else if($m_count == 1){
            $_SESSION['login_user'] = $manager_row['ID'];
            header("location: manager_welcome.php");
        }else{
            $error = "Your Login ID and/or Password is invalid";
        }
   }
?>
<html>
   
   <head>
      <title>Login Page</title>
      
      <style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         
         .box {
            border:#666666 solid 1px;
         }
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">
	
      <div align = "center">
         <h3> Welcome! If you are already registered as a manager or player, please login using the window below. Otherwise, you may select one of the links below to navigate. </h3>
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               
               <form action = "" method = "post">
                  <label>Username: </label><input type = "text" name = "username" class = "box" maxlength = 16 /><br/><br />
                  <label>Password: </label><input type = "password" name = "password" class = "box" maxlength = 8 /><br/><br />
                  <div align = "center"><input type = "submit" value = " Submit "/><br /></div>
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
					
            </div>
				
         </div>
			
      </div>
      <div align = "center"><h3><a href = "request_player_account.php">Request a new player account</a></h3></div>
      <div align = "center"><h3><a href = "create_manager_account.php">Create a new manager account</a></h3></div>
      <div align = "center"><h3><a href = "reset_password.php">Reset Account Password</a></h3></div>
   </body>
</html>
