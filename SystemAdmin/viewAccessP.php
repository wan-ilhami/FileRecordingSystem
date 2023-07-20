<?php
include("../connection.php");

$va= $_POST['va'];
$codeid=$_POST['codeID'];
$codeDesc=$_POST['codeDesc'];
echo $va."<br>";
echo $codeid . "<br>";
echo $codeDesc . "<br>";


 $sql="UPDATE CODEFILE SET VIEWID=:l, CODEDESC=:d WHERE CODEID=:a";
    $result = oci_parse($conn, $sql);
    oci_bind_by_name($result,':a', $codeid);
    oci_bind_by_name($result,':l', $va);
    oci_bind_by_name($result,':d', $codeDesc);
    $resultCheck = oci_execute($result);
        if($resultCheck )
        {
            echo "<script language = 'javascript'> alert('data have been successfully updated'); window.location = 'viewFiles.php';</script>";

        }
        else{
            echo "<script language = 'javascript'> alert('You can't change the file'); window.location = 'viewFiles.php';</script>";

        }
    
    ?>