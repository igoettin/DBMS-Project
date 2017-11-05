<?php
   $con = mysql_connect('dbclass.cs.nmsu.edu','igoettin','v0PTzY92');
   if(!$con) {
    die('Could not connect: ' . mysql_error());
   }
   mysql_select_db("cs482502fa17_igoettin", $con);
?>
