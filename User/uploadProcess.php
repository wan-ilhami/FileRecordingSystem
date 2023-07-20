<?php

	include '../connection.php';
	session_start();
	if (!isset($_SESSION['USERLEVELID'])) {
		header('location:../index.php');
	  }
	//$c=$_SESSION['searchcode'];
    //echo $c."<br>";
	$codeID=$_POST['codeID'];
	$uploaddate = $_POST['uploaddate'];
    $ID = $_SESSION['USERID'];
	$viewid = 1; // for default access table id;

	
  	$doc_date = strtotime($uploaddate);
 	$doc_date = date('d/m/Y',$doc_date); //-->upload date yg dh tukar format
  	var_dump($doc_date);

	var_dump($codeID);
	echo "<br>";
	var_dump($uploaddate);
	echo "<br>";
	var_dump($ID);
	echo "<br>";
	var_dump($viewid);
	echo "<br>";


	
		$CHECKDATA = "SELECT * FROM USERS WHERE USERID = :USERID";
		$CHECKQUERY = oci_parse($conn,$CHECKDATA);
		oci_bind_by_name($CHECKQUERY,':USERID',$ID);
		$CHECKRESULT = oci_execute($CHECKQUERY);

		if($CHECKRESULT){
			while($row = oci_fetch_assoc($CHECKQUERY)){
				$USERID = (int)$row['USERID'];
			}
		}

		var_dump($USERID);

	
	
		//UPLOAD METHOD FOR  MULTIPLE FILE SIMULTANEOUSLY
		//#####################################################################################################################################
		function resortArray(array $arr){
			$result = array();
		
			foreach($arr as $key => $value){
				for($a=0; $a < count($value); $a++){
					$result[$a][$key] = $value[$a];
				}
			}
			return $result;
		}
	
		$doc = [];
		if(!empty($_FILES['file'])){
			$doc = resortArray($_FILES['file']);
		}
	
		echo "<pre>";print_r($doc); echo "</pre>";
		//#####################################################################################################################################
		foreach($doc as $docs){
		
			$doc_name = $docs['name'];
			$t_name = $docs['tmp_name'];
			$doc_dir = "../Documents/";
			$doc_type = $docs['type'];
            $doc_size = $docs['size'];	
			$doc_loc = $doc_dir . $doc_name;

			

			//$codeID = "FSPU 1/1/2";
			//$ID = 101;
			//$viewid = 1;
			//var_dump($doc_name);
			
			if(!EMPTY($_FILES['file']['name'])){
				if($doc_type == "application/pdf"){

					

					// create a new record (save content of file to column with BLOB type)
					if(move_uploaded_file($t_name,$doc_loc))
					{
						$sqlUpload = "INSERT INTO SUBCODE (SUBCODEDESC,DOCUMENTTYPE,DOCUMENTSIZE,DOCUMENTLOC,UPLOADDATE,CODEID,USERID)
					
					VALUES (:doc_name,:doc_type,:doc_size,:doc_loc,to_date(:doc_date, 'DD-MM-YYYY'),:CODEID,:userid)";

				
		
					$queryUpload = oci_parse($conn, $sqlUpload);
	 
					oci_bind_by_name($queryUpload,':doc_name',$doc_name);
					oci_bind_by_name($queryUpload,':doc_type',$doc_type);
					oci_bind_by_name($queryUpload,':doc_size',$doc_size);
					oci_bind_by_name($queryUpload,':doc_loc',$doc_loc);
					oci_bind_by_name($queryUpload,':doc_date',$doc_date);
					oci_bind_by_name($queryUpload,':CODEID', $codeID);
					oci_bind_by_name($queryUpload,':userid', $USERID);


	
					oci_execute($queryUpload) or die("Error to execute SQL command");
				
					
					oci_free_statement($queryUpload);
					
		
					echo "<script language = 'javascript'> alert('DOCUMENT SUCCESSFULLY UPLOADED!!'); window.location = 'viewDoc.php';</script>";
					}

					


					
					
				}
				else{
					echo "<script language = 'javascript'> alert('ONLY PDF FILE TYPE IS ALLOWED!'); window.history.back();</script>";	
				}
			}
			else{
				echo "<script language = 'javascript'> alert('NO FILE HAS BEEN CHOOSE TO UPLOAD!'); window.history.back();</script>";
			}


			
		}//end of looping(foreach)
	
?>