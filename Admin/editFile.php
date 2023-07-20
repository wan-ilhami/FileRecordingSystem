<?php

include("../connection.php");
session_start();
$desc = $_SESSION['USERLEVELDESC'];
$levelid = $_SESSION['USERLEVELID'];
$ID = $_SESSION['USERID'];
$NAME = $_SESSION['USERNAME'];

if (!isset($_SESSION['USERLEVELID'])) {
    header('location:../index.php');
  }
  else if (isset($_SESSION['USERLEVELID'])){
    if($_SESSION['USERLEVELID'] == 1){
      header('location:../SystemDEV/dashboard.php');
    }
    else if($_SESSION['USERLEVELID'] == 3){
      header('location:../Moderator/dashboard.php');
    }
    else if($_SESSION['USERLEVELID'] == 4){
      header('location:../User/dashboard.php');
    }
  }


if (isset($_POST['codeID'])) {
    foreach ($_POST['codeID'] as $b)
        $codeID = $b;
} else {
    echo "You can't enter this file";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <style>
        .jarakInput {
            margin-top: 20px;
        }

        .inputBox {
            width: 80%;
            margin: auto;
            display: block;
        }

        .inputDrop {
            margin: auto;
            display: block;
            margin-left: 40%;
        }

        .labelInput {
            margin-left: 10%;
        }
    </style>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>FSPU File Recording System - Edit File</title>

    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-icon">
                    <img style="height:60%; width:60%; margin-top:80%; margin-bottom:30p;" src="../img/logo.png" alt="FSPU LOGO">
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider" style="margin-top:57%;">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- Files -->
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFiles" aria-expanded="true" aria-controls="collapseFiles">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Files</span>
                </a>
                <div id="collapseFiles" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item active" href="viewFiles.php">View Files</a>
                        <a class="collapse-item" href="viewVolume.php">View Document</a>
                        <a class="collapse-item" href="addFile.php">Add Files</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Files -->
            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item ">
                <a class="nav-link collapsed " href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true" aria-controls="collapseUser">
                    <i class="fas fa-fw fa-laugh-wink"></i>
                    <span>Users</span>
                </a>
                <div id="collapseUser" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="viewUser.php">View User</a>
                        <a class="collapse-item" href="addUser.php">Add User</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <h1 class="h3 mb-2 text-gray-800">Faculty of Architecture, Planning and Surveying</h1>

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>


                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo  $NAME; ?></span>
                                <img class="img-profile rounded-circle" src="../img/admin icon.png">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    My Profile
                                </a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">


                    </div>

                    <!-- Content Row -->
                    <div class="row">


                        <div class="card shadow mb-4" style="width: 40%; margin:auto; display:block;">

                            <?php
                            $sql = "SELECT * FROM CODEFILE WHERE CODEID=:b ";
                            $result = oci_parse($conn, $sql);
                            oci_bind_by_name($result, ':b', $codeID);
                            $resultCheck = oci_execute($result);

                            if ($resultCheck) {
                                while ($row = oci_fetch_assoc($result)) {
                            ?>

                                    <div class="card-header py-3" style="text-align:center;">
                                        <h3>Edit File</h3>
                                    </div>
                                    <div class="card-body">

                                        <form action="viewAccessP.php" method="post">

                                            <label class="labelInput" for="File Code"><b>File Code</b></label><br>
                                            <input class="inputBox" type="text" name="codeID" value="<?php echo $row['CODEID'] ?>" readonly /><br>

                                            <label class="labelInput" style=" margin-top:10px;" for="File Name"><b>File Name</b></label><br>
                                            <input class="inputBox" type="text" name="codeDesc" value="<?php echo $row['CODEDESC'] ?>" />

                                            <label class="inputBox" style=" margin-top:20px;">Select View Access for this file</label>
                                            <div class="inputBox" style=" margin-top:10px;">
                                                <select name="va" class="form-control" id="sel1" style="width:40%; ">
                                                    <option value=1> 1 - All</option>
                                                    <option value=2> 2 - Confidential</option>
                                                </select>

                                            </div>

                                            <button style="margin: auto; display:block; margin-top:-37px; margin-bottom:30px; margin-left:70%; width:20%; " class="btn btn-success" type="submit">Change</button>
                                        </form>
                                        <form action="deleteFiles.php" method="POST">
                                            <input type="hidden" name="delete" value="<?php echo $row['CODEID'] ?>">
                                            <button class="btn btn-danger btn-circle" onclick="return confirm('Are you sure you want to delete this File?')" type="submit" style="cursor: pointer; margin:auto;display:block;"><i class="fa fa-trash"></i></button>
                                        </form>
                                <?php
                                }
                            }
                                ?>
                                    </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; FSPU File Recording System 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../js/demo/chart-area-demo.js"></script>
    <script src="../js/demo/chart-pie-demo.js"></script>

</body>

</html>