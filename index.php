<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>FSPU File Recording System - Login</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container" style="margin-top: 150px;">

    <!-- Outer Row -->
    <div  style= " margin: auto; display: block; width:50%;" >

        <class class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0" style="width: 70%; margin: auto; display: block;">
            <!-- Nested Row within Card Body -->
     
                <div class="p-5">
                  <div class="text-center">
                  <img style="width:28%; height:50%;" src="img/logo.png" alt="UiTM logo"> 
                  <img style="width:70%; height:50%;" src="img/FSPU.png" alt="fspu logo">
                  </div>

                  <form action="indexP.php" class="user" method="post">

                    <div class="form-group" style="margin-top:30px;">
                      <input type="text" class="form-control form-control-user" name="id" aria-describedby="emailHelp" placeholder="Staff ID">
                    </div>
                    
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" name="password" placeholder="Password">
                    </div>
                    
                    <button type="submit" class="btn btn-success btn-user btn-block">
                      Login
                    </button>

                    <div class="text-center">
                    <p class="small"></p>
                    <p class="small"><b>Use Your Staff Portal Account to Login</b></p>
                  </div>
                   
                  </form>
                  <hr>
                  <div class="text-center">
                    <p class="small">FSPU File Recording System</p>
                  </div>
                </div>
              
            </div>
          </div>
        </class>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
