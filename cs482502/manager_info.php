<?php
    include("config.php");
    include("manager_view.php");
    session_start();
    $p_ID = $_SESSION['login_user'];
    $manager_query = mysql_query("select * from Manager where ID = '$p_ID';");
    $certificate_query = mysql_query("select * from ManagerCertificate, Manager where Manager.ID = '$p_ID' and ManagerCertificate.ManagerID = Manager.ID;");
    
?>
<html>
     
    <head>

        <style>
            input[type=checkbox]{width:50px; height:50px;}
            div.tab input.vmi{background-color:#32ff32;}
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
                    while($row = mysql_fetch_array($manager_query))
                        print "<tr><td>".$row['ID']."</td><td>".$row['LoginID']."</td><td>".$row['Name']."</td><td>".$row['Password']."</td><td>".$row['Birthday']."</td><td>".$row['Address']."</td><td>".$row['Email']."</td><td>".$row['PhoneNumber']."</td></tr>";
                ?>
            </table>
            <br><br>
            <!-- Table to show the certificates -->
            <table border = '3'>
                <tr>
                    <th colspan='3'> <h3> Manager Certificates </h3> </th>
                </tr>
                <tr>
                    <th> ManagerID </th>
                    <th> CertificateId </th>
                    <th> Check to Download </th>
                </tr>
                    <form method = "post">
                    <?php
                        while($row = mysql_fetch_array($certificate_query)){
                            $element = 0;
                            $blob = $row['Certificate'];
                            $blob_ref = "download{".$element."}";
                            print "<tr><td>".$row['ManagerID']."</td><td>".$row['CertificateId']."</td><td>"."<input type = \"checkbox\" name = \"$blob_ref\" value=1/>"."</td></tr>";
                            $element++;
                        }
                    ?>
                <tr>
                    <th colspan = '3'> <input type = "submit" value = "Download Checked Certificates" name = "download_button" /></th>
                    </form>
                    <?php
                        
                        if(isset($_POST['download_button'])){
                            $num_certificates = mysql_num_rows($certificate_query);
                            for($i = 0; $i < $num_certificates; $i++){
                               $str = "download{".$i."}";
                               print_R($_POST);
                               if(isset($_POST[$str])){
                                    
                               } 
                            }
                        } 
                        unset($_POST['download_button']);
                    ?> 
                </tr> 
            </table>
    <!-- </form> -->
    </body>
    </div>
</html>
