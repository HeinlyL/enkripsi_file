<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: .././");
}
$title = 'Enkripsi';
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
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold"><i class="fas fa-edit fa-fw"></i>Form Enkripsi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="encrypt-process.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="file">File</label>
                                    <input type="file" name="file" id="file" class="form-control" placeholder="" style="padding: 0; height: 32px;" required>
                                </div>

                                <div class="form-group">
                                    <label for="kata_kunci">Kata Kunci</label>
                                    <input type="password" name="kata_kunci" id="kata_kunci" class="form-control" placeholder="Kata kunci" required>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="show-password">
                                    <label class="form-check-label" for="show-password">Lihat Kata Kunci</label>
                                </div>

                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" id="ketarangan" rows="3" required></textarea>
                                </div>

                                <div class="form-group">
                                    <button type="submit" name="btn-enkripsi" class="btn btn-success btn-sm"><i class="fa fa-lock" aria-hidden="true"></i> Enkripsi File</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

<?php include '../layout/footer.php'; ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#show-password').click(function() {
            if ($(this).is(':checked')) {
                $('#kata_kunci').attr('type', 'text');
            } else {
                $('#kata_kunci').attr('type', 'password');
            }
        });
    });
</script>