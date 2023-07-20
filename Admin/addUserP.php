<?php

include("../connection.php");
session_start();

if (!isset($_SESSION['USERLEVELID'])) {
    header('location:../index.php');
}

$id = $_POST['id'];
$name = $_POST['name'];
$email = $_POST['email'];
$STATUS_OFF = 0; //---->FOR INACTIVE ACCOUNTS
$STATUS_ON = 1; //---->FOR ACTIVE ACCOUNTS


function checkCustomerUser($conn, $id)
{
    $found = false;
    $sql1 = "SELECT USERID FROM USERS WHERE USERID = :id ";
    $result1 = oci_parse($conn, $sql1);
    oci_bind_by_name($result1, ':id', $id);
    $resultCheck1 = oci_execute($result1);

    while ($row = oci_fetch_assoc($result1)) {
        $easy = $row['USERID'];
        if ($easy == $id) {
            $found = true;
        }
    }
    return $found;
}
if (checkCustomerUser($conn, $id) == true) {
    echo "<script language='javascript'>alert('User ID already exist.');window.location='addUser.php'</script>";
} else {
    
     
        
        $sql = "INSERT INTO USERS (USERID,USERNAME,USEREMAIL) VALUES (:id,:name,:email)";
        $result = oci_parse($conn, $sql);

        oci_bind_by_name($result, ':id', $id);
        oci_bind_by_name($result, ':name', $name);
        oci_bind_by_name($result, ':email', $email);


        $resultCheck = oci_execute($result);
        $result1Row = oci_num_rows($result);

        $user_type_id = array(101, 102, 103, 104);
        for ($i = 0; $i < 4; $i++) {
            if ($i == 4) {
                $sql2 = 'INSERT INTO ACCESSUSER (ACCSTATUS,USERID,USERLEVELID)
                                                                ' . ' 
                 VALUES ( :acc_status, :s_id, :user_type_id)';
                $query2 = oci_parse($conn, $sql2);


                oci_bind_by_name($query2, ':acc_status', $STATUS_ON);
                oci_bind_by_name($query2, ':s_id', $id);
                oci_bind_by_name($query2, ':user_type_id', $user_type_id[$i]);

                $result2 = oci_execute($query2);
                $result2Row = oci_num_rows($query2);
            } else {
                $sql2 = 'INSERT INTO ACCESSUSER (ACCSTATUS,USERID,USERLEVELID)
                                                                                ' . ' 
                 VALUES ( :acc_status, :s_id, :user_type_id)';
                $query2 = oci_parse($conn, $sql2);


                oci_bind_by_name($query2, ':acc_status', $STATUS_ON);
                oci_bind_by_name($query2, ':s_id', $id);
                oci_bind_by_name($query2, ':user_type_id', $user_type_id[$i]);

                $result2 = oci_execute($query2);
                $result2Row = oci_num_rows($query2);
            }
            oci_free_statement($query2);
            oci_free_statement($result);
            if ($result1Row > 0 && $result2Row > 0) {
                oci_commit($conn);
                oci_close($conn);
                echo "<script language = 'javascript'> alert('Staff Registered Successfully!!'); window.location = 'viewUser.php'</script>";
            } else {
                oci_rollback($conn);
                oci_close($conn);
               // echo "<script language = 'javascript'> alert('Staff Registration Failed!!'); window.history.back();</script>";
            }
        }
        
    }
?>