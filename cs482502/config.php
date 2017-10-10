<?php
   define('DB_SERVER', 'dbclass.cs.nmsu.edu');
   define('DB_USERNAME', 'igoettin');
   define('DB_PASSWORD', 'v0PTzY92');
   define('DB_DATABASE', 'cs482502fa17_igoettin');
   $con = mysql_connect('dbclass.cs.nmsu.edu','igoettin','v0PTzY92');
   if(!$con) {
    die('Could not connect: ' . mysql_error());
   }
   mysql_select_db("cs482502fa17_igoettin", $con);
?>
