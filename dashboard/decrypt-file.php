<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: .././");
}
$title = 'Deskripsi';
$subtitle = 'Deskripsi File';
include '../layout/header.php';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Deskripsi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="./">Home</a></li>
                        <li class="breadcrumb-item active"><a href="deskripsi.php"><?= $title; ?></a></li>
                        <li class="breadcrumb-item active"><?= $subtitle; ?></li>
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
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold"><i class="fas fa-edit fa-fw"></i>Deskripsi File</h3>
                        </div>
                        <div class="card-body ">
                            <?php
                            $id_file = $_GET['id_file'];
                            $query = mysqli_query($conn, "SELECT * FROM file WHERE id_file='$id_file'");
                            $data = mysqli_fetch_array($query);
                            ?>
                            <h3 class="text-center font-weight-bold">Deskripsi File : <i class="text-red "><?= $data['file_name_finish']; ?></i></h3>
                            <form action="decrypt-proses.php" method="post">
                                <div class="table-responsive-lg">
                                    <table id="dataTable" class="table table-sm table-responsive-lg">

                                        <tbody>
                                            <tr>
                                                <th>Nama File Sumber</th>
                                                <td>:</td>
                                                <td><?= $data['file_name_source']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Nama File Enkripsi</th>
                                                <td>:</td>
                                                <td><?= $data['file_name_finish']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Ukuran File</th>
                                                <td>:</td>
                                                <td><?= $data['file_size']; ?> KB</td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Enkripsi</th>
                                                <td>:</td>
                                                <td><?= $data['tgl_upload']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Keterangan</th>
                                                <td>:</td>
                                                <td><?= $data['keterangan']; ?></td>
                                            </tr>
                                            <tr>
                                                <th>Masukan Kata Kunci untuk Mendeskripsi File</th>
                                                <td>:</td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="hidden" name="fileid" value="<?php echo $data['id_file']; ?>">
                                                        <input type="text" name="kata kunci" id="" class="form-control" placeholder="Masukan Kata Kunci" autocomplete="off">
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success btn-sm">Deskripsi File</button>
                                    </div>
                                </div>
                            </form>
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
    <?php if ($_SESSION['error']) { ?>
        var isi = <?= json_encode($_SESSION['error']) ?>;
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Gagal!',
            text: isi,
            showConfirmButton: false,
            timer: 1500
        })
    <?php unset($_SESSION['error']);
    } ?>
</script>

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