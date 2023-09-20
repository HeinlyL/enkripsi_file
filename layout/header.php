<?php
include '../koneksi.php';
$user = $_SESSION['id_user'];
$query = "SELECT * FROM users WHERE id_user = '$user'";
$sql = mysqli_query($conn, $query);
$rows = mysqli_fetch_array($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SI-ENKRIPSI | <?= $title; ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">

    <!-- Custom styles for this page -->
    <link href="../assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../assets/sweetalert/sweetalert2.min.css">
    <script src="../assets/sweetalert/sweetalert2.all.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light navbar-white text-black elevation-3" style=" border: 0;">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="./" class="nav-link">Home</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Messages Dropdown Menu -->
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item">
                    <a class="nav-link" href="../dashboard/logout.php" role="button">
                        <i class="fas fa-sign-out-alt fa-fw"></i>Logout
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-light-white bg-yellow" style=" color: white;">
            <!-- Brand Logo -->
            <a href="./" class="brand-link" style="border-bottom: 2px solid white;">
                <img src=" ../assets/dist/img/itb.png" alt="AdminLTE Logo" class="brand-image">
                <span class="brand-text font-weight-bold">EnkripsiFILE</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="border-bottom: 1px solid white;">
                    <div class="image">
                        <?php if ($rows['avatar'] == null) { ?>
                            <img class="img-profile rounded-circle mt-2" style="object-fit: cover;" src="../uploads/avatar/default.jpg" />
                        <?php } else { ?>
                            <img class="img-profile rounded-circle mt-2" style="object-fit: cover; width: 40px; height: 40px;" src="../uploads/avatar/<?= $rows['avatar']; ?>" />
                        <?php } ?>
                    </div>
                    <div class="info">
                        <a href="../dashboard/profil.php" class="d-block font-weight-bold"><?= $rows['fullname']; ?>
                            <small class="text-xs d-block"><?= $rows['job_title']; ?></small>
                        </a>

                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav  nav-sidebar flex-column">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="./" class="nav-link">
                                <i class="fas fa-tachometer-alt nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="enkripsi.php" class="nav-link">
                                <i class="fas fa-lock nav-icon"></i>
                                <p>Enkripsi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="deskripsi.php" class="nav-link">
                                <i class="fas fa-unlock nav-icon"></i>
                                <p>Deskripsi</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>