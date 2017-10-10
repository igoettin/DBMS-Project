<?php
   include('session.php');
?>
<html">
   
   <head>
      <title>Manager Welcome </title>
   </head>
   
   <body>
      <h1>Welcome Manager<?php echo $login_session; ?></h1> 
      <h2><a href = "logout.php">Sign Out</a></h2>
   </body>
   
</html>
