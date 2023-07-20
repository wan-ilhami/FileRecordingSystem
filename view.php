<?php
	include 'connection.php'; 
	session_start();
	//$id = base64_decode($_GET['id']);

	$encryptedID = myUrlEncode($_GET['id']);
	echo $encryptedID;
	function myUrlEncode($string) {
		$entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
		$replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
		return str_replace($entities, $replacements, urlencode($string));
	}

	echo $encryptedID;
	
	/*##########ENCRYPTING DOC_ID*#############*/
		
		$encryption_iv = '11223344';
	
	// Store cipher method 
		$ciphering = "BF-CBC"; 
		// Use OpenSSl encryption method 
		$iv_length = openssl_cipher_iv_length($ciphering); 
		$options = 0; 
		// Store the decryption key 
		$decryption_key = openssl_digest(php_uname(), 'MD5', TRUE); 
		// Descrypt the string 
		$doc_id = $decryption = openssl_decrypt ($encryptedID, $ciphering, 
					$decryption_key, $options, $encryption_iv);
				
	/*##########ENCRYPTING DOC_ID*#############*/
	echo $doc_id;
	
	$sql = "SELECT * FROM SUBCODE WHERE SUBCODEID = :doc_id";
	$query = oci_parse($conn,$sql);
	oci_bind_by_name($query, ':doc_id',$doc_id);
    $result = oci_execute($query);
    
    while($row = oci_fetch_assoc($query)){
        $file = 'Documents/';
        $filename = $row['SUBCODEDESC'];

		$test = explode('@', $filename);
		$test = $test[1];
		
        header('Content-type: application/pdf');
        header('Content-Disposition: inline; filename="' . $test . '"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        @readfile($file.$filename); 
    }
	
	
?>

