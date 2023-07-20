<?php
include '../connection.php';

$filecode = $_POST['filecode'];
$filedesc = $_POST['filedesc'];
$va = $_POST['va'];



$sql = "INSERT INTO CODEFILE (CODEID,CODEDESC,VIEWID) VALUES (:filecode,:filedesc,:va)";
$query = oci_parse($conn, $sql);

oci_bind_by_name($query, ':filecode', $filecode);
oci_bind_by_name($query, ':filedesc', $filedesc);
oci_bind_by_name($query, ':va', $va);
$result = oci_execute($query);


if ($result > 0) {
	echo "<script language = 'javascript'> alert('File Uploaded'); 
		window.location = 'addFile.php'</script>";
}
else{
	echo "<script language = 'javascript'> alert('File Code already exist! Please change the file code.'); window.history.back();</script>";	
}
