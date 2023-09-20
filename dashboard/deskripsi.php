<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: .././");
}
$title = 'Deskripsi';
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
                <div class="col-md-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body ">
                            <div class="table-responsive-lg">

                                <table id="dataTable" class="table table-hover table-responsive-lg">
                                    <thead class="text-center">
                                        <tr>
                                            <th>Nama File Sumber</th>
                                            <th>Nama File Enkripsi</th>
                                            <th>Path File</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = mysqli_query($conn, "SELECT * FROM file ");
                                        while ($data = mysqli_fetch_array($query)) { ?>
                                            <tr>
                                                <td><?= $data['file_name_source']; ?></td>
                                                <td><?= $data['file_name_finish']; ?></td>
                                                <td><?= $data['file_url']; ?></td>
                                                <td class="text-center">
                                                    <?php if ($data['status'] == 1) {
                                                        echo "<span class='badge badge-success '>Enkripsi</span>";
                                                    } elseif ($data['status'] == 2) {
                                                        echo "<span class='badge badge-warning '>Deskripsi</span>";
                                                    } else {
                                                        echo "<span class='btn btn-danger btn-sm'>Status Tidak Diketahui</span>";
                                                    }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <?php
                                                        $a = $data['id_file'];
                                                        if ($data['status'] == 1) { ?>
                                                            <a href="decrypt-file.php?id_file=<?= $a; ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Deskripsi File"><i class="fas fa-edit fa-fw"></i></a>
                                                        <?php } elseif ($data['status'] == 2) { ?>
                                                            <span class="text-red"><i class="fas fa-times-circle"></i></span>
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


<!-- /.content-wrapper -->
<?php include '../layout/footer.php'; ?>