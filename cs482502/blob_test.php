<?php
   include("config.php");
   include("manager_view.php");
   session_start();
    if(isset($_POST['submit'])){
    $name = $_FILES['file']['name'];
    $_SESSION['filename'] = $name;
    $tmp_name = $_FILES['file']['tmp_name'];
    //$imageType = $_FILES['file']['type'];
    $file_content = file_get_contents($tmp_name);
    //$file_str = (string)$file_content;
	mysql_query("update ManagerCertificate set Certificate = '". mysql_escape_string($file_content)."' where ManagerID = 14;") || die(mysql_error());
    }
    else if(isset($_POST['download'])){
        header("location: download.php");
        #$row = mysql_fetch_array(mysql_query("select Certificate from ManagerCertificate where ManagerID = 14;"));
        #header('Content-Description: File Transfer');
        #header('Content-Type: image/jpeg');
        #header('Content-Disposition: attachment; filename = "sailors2.jpg"');
        #header('Content-Transfer-Encoding: binary');
        #echo $row['Certificate'];        
    }

        
?>


<!DOCTYPE html>
<html>
<body>

<form method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="file" id = "file"><br><br>
    <input type="submit" value="Upload Image" name="submit">
    <input type="submit" value="Download Image" name = "download">
</form>
<?php
    $row = mysql_fetch_array(mysql_query("select * from ManagerCertificate where ManagerID = 14;"));
    echo "<dt><strong>".$name.":</strong</dt><dd>" . '<img src = "data:image/jpeg;base64,'.base64_encode($row['Certificate']). '" width = "290" height = "290">' . "</dd>";

?>
</body>
</html>



