<?php
   include("config.php");
   session_start();
   
  $name = $_FILES['file']['name'];

  $tmp_name = $_FILES['file']['tmp_name'];

   $imageType = $_FILES['file']['type'];

   $file_content = file_get_contents($tmp_name);
  

	mysql_query("update ManagerCertificate set Certificate = '$file_content' WHERE ManagerID = 14;") || die(mysql_error());



?>


<!DOCTYPE html>
<html>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="file"><br><br>
    <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>

