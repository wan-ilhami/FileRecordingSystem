<?php
include("../connection.php");
session_start();
if (!isset($_SESSION['USERLEVELID'])) {
    header('location:../index.php');
  }
    $a=$_POST['staffID'];
    $userid = $_SESSION['USERID'];
    $accessID = $_SESSION['ACCESSID'];
    echo $accessID;
   
    if(isset($_POST['submit']))
    {
    $l=$_POST['level'];
    echo "Edit"."<br>".$a."<br>";
    echo $l;
    
    $sql="UPDATE ACCESSUSER SET USERLEVELID=:l WHERE USERID=:a";
    $result = oci_parse($conn, $sql);
    oci_bind_by_name($result,':a',$a);
    oci_bind_by_name($result,':l',$l);
    $resultCheck = oci_execute($result);
    
        if($resultCheck && $userid == $a)
        {
           echo "<script language = 'javascript'> alert('You have been log out!'); window.location = '../logout.php';</script>";

        }
        
        else{
            echo "<script language = 'javascript'> alert('data have been successfully updated'); window.location = 'viewUser.php';</script>";

        }
    }
    
    if(isset($_POST['delete']))
    {

    

    echo "delete"."<br>".$a."<br>";
    $sql="DELETE FROM USERS WHERE USERID=:a";
    $result = oci_parse($conn, $sql);
    oci_bind_by_name($result,':a',$a);
    $resultCheck = oci_execute($result);

    $sql2="DELETE FROM ACCESSUSER WHERE ACCESSID=:b";
        $result2 = oci_parse($conn, $sql2);
        oci_bind_by_name($result2,':b',$accessID);
        $resultCheck2 = oci_execute($result2); 
        
    
        if($resultCheck && $resultCheck2)
        {
           echo "<script language = 'javascript'> alert('User selected have been deleted'); window.location = 'viewUser.php';</script>";

        }
    }



?>