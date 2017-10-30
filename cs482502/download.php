<?php
    include("config.php");
    session_start();
    $row = mysql_fetch_array(mysql_query("select Certificate from ManagerCertificate where ManagerID = 14;"));
        header('Content-Disposition: attachment; filename = "sailors2.jpg"');
        echo $row['Certificate'];   

?>
