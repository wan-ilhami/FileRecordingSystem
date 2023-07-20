<?php
    session_start();
    include 'connection.php';

   
        $staff_id = $_POST['id'];
        $password = $_POST['password'];
        
         $flag = true;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt_array($curl, array(
            CURLOPT_PORT => "444",
            CURLOPT_URL => "https://integrasi.uitm.edu.my:444/stars/login/json/" . $staff_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{\n\t\"password\": \"" . $password . "\"\n}",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: a5f640ca-aedf-6572-f4ef-b6ae06cad9eb",
                "token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjoiY2xhc3Nib29raW5nIn0._dTe9KRNSHSBMybfC4Gs6Brv6vO2HxQ8CWp9lOtI0hk"
            ),
        ));

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $json = json_decode($response, TRUE);

    var_dump($response);


    if ($json['status'] == "true") {
      

  
        if ($flag) {

            $st_id = $staff_id;

            $sql = "SELECT * FROM ACCESSUSER A JOIN USERS U ON A.USERID=U.USERID JOIN USERLEVEL UL ON A.USERLEVELID = UL.USERLEVELID WHERE A.USERID = :st_id AND A.ACCSTATUS = 1";
            $query = oci_parse($conn, $sql);

            oci_bind_by_name($query, ':st_id', $st_id);

            oci_execute($query);
            $result = oci_fetch_all($query, $res);

            echo $result;
            

            oci_execute($query);

            if ($result > 0) {
                $row = oci_fetch_assoc($query);
                 $_SESSION['USERLEVELDESC']= $row['USERLEVELDESC'];
                 $_SESSION['USERNAME'] = $row['USERNAME'];
                $level = $_SESSION['USERLEVELID'] = $row['USERLEVELID'];
                $_SESSION['USERID'] = $row['USERID'];


                switch ($level) {
                    case 1:
                        echo "<script language = 'javascript'> alert('~ LOGGED IN AS SYSTEM ADMIN ~');window.location = 'SystemAdmin/dashboard.php';</script>";
                        break;

                    case 2:
                        echo "<script language = 'javascript'> alert('~ LOGGED IN AS ADMIN ~');window.location = 'Admin/dashboard.php';</script>";
                        break;

                    case 3:
                        echo "<script language = 'javascript'> alert('~ LOGGED IN AS MODERATOR ~');window.location = 'Moderator/dashboard.php';</script>";
                        break;

                    case 4:
                        echo "<script language = 'javascript'> alert('~ LOGGED IN AS USER ~');window.location = 'User/dashboard.php';</script>";
                        break;

                    default:
                        header('location: index.php?Access_Denied');
                        break;
                }
            } else {
                header('location: index.php?Access_Denied');
            }
        } else {
            header('location: index.php?invalid_user');
        }
   }


?>