<!-- This PHP file allows attachments (i.e. certificates) to be downloaded to the manager's computer. -->
<?php
    include("config.php");
    session_start();
    //Get the row that in the relation that has the certificate.
    $row = $_SESSION['download_array'];
    //Set the filename for the image that will be downloaded.
    $filename = "certificate".$row['CertificateId'].".jpg";
    //Download the image as an attachment.
    header('Content-Disposition: attachment; filename = "'.$filename.'"');
    echo $row['Certificate'];

?>
