<?php
include("../connection.php");
session_start();
if (!isset($_SESSION['USERLEVELID'])) {
    header('location:../index.php');
  }
if(isset($_POST['delete']))
{
    $a=$_POST['delete'];

    $sql = "DELETE FROM SUBCODE WHERE SUBCODEID=:a";
	$query = oci_parse($conn,$sql);
	oci_bind_by_name($query,':a',$a);
    $result = oci_execute($query);
    
    if($result)
        {
           echo "<script language = 'javascript'> alert('Document selected have been deleted'); window.location = 'viewDoc.php';</script>";

        } 
}
    
?>