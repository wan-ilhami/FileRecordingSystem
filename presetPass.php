<?php
include("connection.php");
session_start();

if (isset($_POST['forgot'])) {

  $email=$_POST['email'];
  $_SESSION['pemail']=$_POST['email'];
  echo $email;

  $sql = "SELECT * FROM USERS WHERE userEmail = :email ";
  $result = oci_parse($conn, $sql);
  oci_bind_by_name($result,':email',$email);
  $resultCheck = oci_execute($result);
 // echo $result;
  

	

  while($row = oci_fetch_assoc($result))
  {
      $userID= $row['USERID'];
      $_SESSION['userID']=$userID;
      
  
 // echo "<br>UserID: ".$userID;

  echo $_SESSION['userID'];
    $token = bin2hex(random_bytes(10));
     $_SESSION['token']=$token;
    // store token in the password-reset database table against the user's email
    $sql5 = "INSERT INTO RESETPASSWORD(USERID,USEREMAIL,TOKEN) VALUES (:userID,:email, :token)";
    $result5 = oci_parse($conn, $sql5);
    oci_bind_by_name($result5,':userID',$userID);
    oci_bind_by_name($result5,':email',$email);
    oci_bind_by_name($result5,':token',$token);
    $resultCheck5 = oci_execute($result5);
    $url="confirmPass.php?token=" . $token ;
    $to = $email;
    $sub = "Reset your password on File Record System";
    $msg ="Hi There! to enter your new password, Please copy the link given and Search It! Link: " .$url;
   
    // Send email to user with the token in a link they can click on
    if(mail($to, $sub, $msg))
    {
      echo " mail";
        //echo "<script language = 'javascript'> alert('Please check your email.'); window.location = 'index.php'</script>";
    }
    else
    {
      echo "cannot mail";
    }
  
  }
}
 
//########################################################################################################################################################3
  // ENTER A NEW PASSWORD

if (isset($_POST['reset-password'])) {
  $new_pass = $_POST['new_pass'];
  $new_pass_c = $_POST['new_pass_c'];
  
  // Grab to token that came from the email link
  $ntoken = $_SESSION['token'];
  $pmail= $_SESSION['pemail'];
  $userID = $_SESSION['userID'];
  //echo $userID;

  
  
  if ($new_pass != $new_pass_c) 
  {
    echo "<script language = 'javascript'> alert('Password do not match'); window.location = 'confirmPass.php'</script>";

  }
 else{
    // select email address of user from the password_reset table 
    $sql = "SELECT * FROM RESETPASSWORD a JOIN USERS b ON a.USERID=b.USERID WHERE  a.USERID=:userID";
    $result = oci_parse($conn, $sql);
    oci_bind_by_name($result,':userID',$userID);
    $resultCheck = oci_execute($result);
   // echo $resultCheck;
    while($row = oci_fetch_assoc($result)){
    
      //$new_pass = md5($new_pass);
      $sql1 = "UPDATE USERS SET USERPASS='$new_pass' WHERE USEREMAIL=:pmail ";
      $result1 = oci_parse($conn, $sql1);
      oci_bind_by_name($result1,':pmail',$pmail);
      $resultCheck1 = oci_execute($result1);
      //echo $sql1;
      //echo $new_pass;
      //echo $resultCheck1;

      while($row1 = oci_fetch_assoc($result))
      {
        $pass= $row1['USERPASS'];
        //echo $pass;
      }
       //echo "<script language = 'javascript'> alert('You have updated ur new password'); window.location = 'confirmPass.php'</script>";
      $sql2="DELETE FROM RESETPASSWORD where TOKEN=:ntoken";
      $result2 = oci_parse($conn, $sql2);
      oci_bind_by_name($result2,':ntoken',$ntoken);
      $resultCheck2 = oci_execute($result2);
      
       if($resultCheck2)
       {
        echo "<script language = 'javascript'> alert('You have updated Your new Password!'); window.location = 'index.php'</script>";

       }
       else{
        echo "<script language = 'javascript'> alert('doesn't delete'); window.location = 'index.php'</script>";

       }

    }
  }
}



?>
