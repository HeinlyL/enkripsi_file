<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: .././");
}
$title = 'Dashboard';
include '../layout/header.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $title; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="./">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">User</span>
                            <span class="info-box-number">
                                <?php
                                $query = mysqli_query($conn, "SELECT count(*) totaluser FROM users");
                                $datauser = mysqli_fetch_array($query);
                                ?>
                                <?= $datauser['totaluser']; ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-lock"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Enkripsi</span>
                            <span class="info-box-number">
                                <?php
                                $query = mysqli_query($conn, "SELECT count(*) totalencrypt FROM file WHERE status='1'");
                                $dataencrypt = mysqli_fetch_array($query);
                                ?>
                                <?= $dataencrypt['totalencrypt']; ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-unlock"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Deskripsi</span>
                            <span class="info-box-number">
                                <?php
                                $query = mysqli_query($conn, "SELECT count(*) totaldecrypt FROM file WHERE status='2'");
                                $datadecrypt = mysqli_fetch_array($query);
                                ?>
                                <?= $datadecrypt['totaldecrypt']; ?>
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body ">
                            <div class="table-responsive-lg">
                                <table id="dataTable" class="table table-hover table-responsive-lg">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Username</th>
                                            <th>Nama File</th>
                                            <th>Nama File Enkripsi</th>
                                            <th>Ukuran File</th>
                                            <th>Tanggal</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysqli_query($conn, "SELECT * FROM file ORDER BY id_file DESC ");
                                        while ($data = mysqli_fetch_array($query)) { ?>
                                            <tr>
                                                <td>#</td>
                                                <td><?= $data['file_name_source']; ?></td>
                                                <td><?= $data['file_name_finish']; ?></td>
                                                <td><?= $data['file_size']; ?></td>
                                                <td><?= $data['tgl_upload']; ?></td>
                                                <td class="text-center">
                                                    <?php if ($data['status'] == 1) {
                                                        echo "<span class='badge badge-success'>Enkripsi</span>";
                                                    } elseif ($data['status'] == 2) {
                                                        echo "<span class='badge badge-warning'>Deskripsi</span>";
                                                    } else {
                                                        echo "<span class='badge badge-danger'>Status Tidak Diketahui</span>";
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <a href="delete.php?&id=<?= $data['id_file']; ?>&file_url=<?= $data['file_url']; ?>" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="bottom" title="Hapus File"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        <?php if ($data['status'] == 1) { ?>
                                                            <a href="download.php?&url=<?= $data['file_url']; ?>" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="bottom" title="Download File Enkripsi"><i class="fa fa-download" aria-hidden="true"></i></a>
                                                        <?php } ?>
                                                    </div>

                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Default box -->

                <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
    <?php if ($_SESSION['sukses']) { ?>
        var isi = <?= json_encode($_SESSION['sukses']) ?>;
        Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Berhasil!',
            text: isi,
            showConfirmButton: false,
            timer: 1500
        })
    <?php unset($_SESSION['sukses']);
    } ?>
</script>


<?php include '../layout/footer.php'; ?>