<?php
    include("config.php");
    session_start();
    $row = $_SESSION['download_array'];
    $filename = "certificate".$row['CertificateId'].".jpg";
    header('Content-Disposition: attachment; filename = "'.$filename.'"');
    echo $row['Certificate'];

?>
