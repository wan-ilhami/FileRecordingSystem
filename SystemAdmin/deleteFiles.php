<?php
include("../connection.php");
session_start();
if (!isset($_SESSION['USERLEVELID'])) {
    header('location:../index.php');
  }
if(isset($_POST['delete']))
{
    $a=$_POST['delete'];

    $sql = "DELETE FROM CODEFILE WHERE CODEID=:a" ;
	$query = oci_parse($conn,$sql);
	oci_bind_by_name($query,':a',$a);
    $result = oci_execute($query);

    $sql1 = "DELETE FROM SUBCODE WHERE CODEID=:a";
	$query1 = oci_parse($conn,$sql1);
	oci_bind_by_name($query1,':a',$a);
    $result1 = oci_execute($query1);
    if($result && $result1)
        {
           echo "<script language = 'javascript'> alert('Selected Files have been deleted'); window.location = 'viewFiles.php';</script>";

        }
}
?>