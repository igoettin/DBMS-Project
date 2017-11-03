<!-- This PHP file defines the page that shows a manager's information when they are loggin in -->
<?php
    include("config.php");
    include("manager_view.php");
    session_start();
    $p_ID = $_SESSION['login_user'];
    $manager_query = mysql_query("select * from Manager where ID = '$p_ID';");
    $cert_query = mysql_query("select * from ManagerCertificate, Manager where Manager.ID = '$p_ID' and ManagerCertificate.ManagerID = Manager.ID order by CertificateId;");
    $num_rows = mysql_num_rows($cert_query);
    //If a download button was pressed, download the corresponding certificate as an attachment.
    for($c = 0; $c < $num_rows; $c++){
        $str = "download{".$c."}";
        if(isset($_POST[$str])){
            for($i = 0; $i <= $c; $i++){
                $row = mysql_fetch_array($cert_query);
            }
            $_SESSION['download_array'] = $row;
            header("location: download.php");
        }
    }
    unset($_POST['download_button']);
                    
?>
<html>
     
    <head>

        <style>
            input[type=checkbox]{width:50px; height:50px;}
            div.tab input.vmi{background-color:#32ff32;}
            input.op{box-sizing: border-box; width:100%;font-size:100%;}
        </style>

    </head>
    <div class = tabcontent>
    <body>
    <!-- <form target = "frame" method = "post" action = "manager_view.php"> -->
            <!-- Manager info table -->
            <table border = '3'>
                <tr>
                    <th colspan='8'> <h3> Manager Information</h3></th>
                </tr>
                <tr>
                    <th> ID </th>
                    <th> LoginID </th> 
                    <th> Name </th> 
                    <th> Password </th>
                    <th> Birthday </th> 
                    <th> Address </th> 
                    <th> Email </th> 
                    <th> PhoneNumber </th> 
                </tr>
                <?php
                    while($row = mysql_fetch_array($manager_query)){
                        print "<tr><td>".$row['ID']."</td><td>".$row['LoginID']."</td><td>".$row['Name']."</td><td>";
                        for($i = 0; $i < strlen((string)$row['Password']); $i++) print "*";
                        print "</td><td>".$row['Birthday']."</td><td>".$row['Address']."</td><td>".$row['Email']."</td><td>".$row['PhoneNumber']."</td></tr>";
                    }
                ?>
            </table>
            <br><br>
            <!-- Table to show the certificates -->
            <table border = '3'>
                <tr>
                    <th colspan='4'> <h3> Manager Certificates </h3> </th>
                </tr>
                <tr>
                    <th> ManagerID </th>
                    <th> CertificateId </th>
                    <th> Check to Download </th>
                    <th> Certificate Preview</th>
                </tr>
                    <form method = "post" enctype = "multipart/form-data">
                    <?php
                        $element = 0;
                        //For each row in the certificate query, add a row in the table. Each row will have a corresponding download button and thumbnail for the certificate.
                        $certificate_query = mysql_query("select * from ManagerCertificate, Manager where Manager.ID = '$p_ID' and ManagerCertificate.ManagerID = Manager.ID order by CertificateId;");
                        while($row = mysql_fetch_array($certificate_query)){
                            $blob = $row['Certificate'];
                            $blob_ref = "download{".$element."}";
                            print "<tr><td>".$row['ManagerID']."</td><td>".$row['CertificateId']."</td><td>"."<input type = \"submit\" name = \"$blob_ref\" value = \"Download Certificate\" class = \"op\" />"."</td><td><dd>".'<img src = "data:image/jpeg;base64,'.base64_encode($row['Certificate']).'" width = "150" height = "150"'."</dd></td></tr>";
                            $element++;
                        }
                    ?>
                    </form>
            </table>
    </body>
    </div>
</html>
