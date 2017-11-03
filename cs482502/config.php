<!-- Configuration PHP file for connecting to the server and linking the page up with the database -->
<?php
   //Connect to the database server;
   $con = mysql_connect('dbclass.cs.nmsu.edu','igoettin','v0PTzY92');
   if(!$con) {
    die('Could not connect: ' . mysql_error());
   }
   //Select the cs482502fa17_igoettin as the database we want to use
   mysql_select_db("cs482502fa17_igoettin", $con);
?>
