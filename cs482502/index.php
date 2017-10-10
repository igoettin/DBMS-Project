<?php
include('config.php');
//$con = mysql_connect("dbclass.cs.nmsu.edu","igoettin","v0PTzY92");

//mysql_select_db("cs482502fa17_igoettin", $con);

//$result = mysql_query("select ID from Player;");

//$numrows = mysql_numrows($result);

/*
while($row = mysql_fetch_array($result)){ 
        echo $row['ID'] . " " . $row['Name'];
        echo "<br />";
}
*/
mysql_close($con);

?> 

<!DOCTYPE HTML>  
<html>
   <head>
      <title></title>
   </head>
<body>  
      <h1>Welcome</h1> 
      <h2><a href = "login.php">Login</a></h2>
      <!-- <h2><a href = "manager_login.php">Manager Login</a></h2> 
      <h2><a href = "staff_login.php">Staff Login</a></h2> -->
</body>
</html>
</html>
