<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: .././");
}
$title = 'Profil';
include '../layout/header.php';

$id_user = $_SESSION['id_user'];
$query = "SELECT * FROM users WHERE id_user = '$id_user'";
$sql = mysqli_query($conn, $query);
$rows = mysqli_fetch_array($sql);
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
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-warning card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <?php if ($rows['avatar'] == null) { ?>
                                    <img class="profile-user-img img-fluid rounded-circle" src="../uploads/avatar/default.jpg" style="object-fit: cover; width: 150px; height: 150px;" alt="User profile picture">
                                <?php } else { ?>
                                    <img class="rounded-circle profile-user-img img-fluid" src="../uploads/avatar/<?= $rows['avatar']; ?>" style="object-fit: cover; width: 150px; height: 150px;" alt="User profile picture">
                                <?php } ?>
                            </div>

                            <h3 class="profile-username text-center font-weight-bold"><?= $rows['fullname']; ?></h3>

                            <p class="text-muted text-center"><?= $rows['job_title']; ?></p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <form action="update-profil.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_user" value="<?= $rows['id_user']; ?>">
                        <div class="form-group">
                            <label for="my-input">Ganti Foto Profil</label>
                            <input id="my-input" class="form-control bg-transparent p-0 h-50" type="hidden" name="gambar_lama" value="<?= $rows['avatar']; ?>">
                            <input id="my-input" class="form-control bg-transparent p-0 h-50" type="file" name="gambar">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="btn-avatar" class="btn btn-sm btn-block btn-success">Update</button>
                        </div>
                    </form>
                    <!-- /.card -->
                </div>
                <div class="col-md-9">
                    <!-- Profile Image -->
                    <div class="card card-success card-outline">
                        <div class="card-body box-profile">
                            <h3 class="text-success h5 font-weight-bold">Update Profil</h3>
                            <hr class="mt-0">
                            <form action="update-profil.php" class="mb-5" method="post">
                                <input type="hidden" name="id_user" value="<?= $rows['id_user']; ?>">
                                <div class="form-group">
                                    <label for="">Nama Lengkap</label>
                                    <input type="text" name="nama" id="" class="form-control" placeholder="Ganti nama" value="<?= $rows['fullname']; ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="">Username</label>
                                    <input type="text" name="username" id="" class="form-control" placeholder="Ganti username" value="<?= $rows['username']; ?>" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-warning" name="btn-username">Update</button>
                                </div>
                            </form>
                            <h3 class="text-success h5 font-weight-bold">Update Password</h3>
                            <hr class="mt-0">
                            <form action="update-profil.php" method="post">
                                <input type="hidden" name="id_user" value="<?= $rows['id_user']; ?>">
                                <div class="form-group">
                                    <label for="">Password Baru</label>
                                    <input type="password" name="password_baru" id="" class="form-control form-password" placeholder="Password Baru" value="">
                                </div>
                                <div class="form-group">
                                    <label for="">Konfirmasi Password Baru</label>
                                    <input type="password" name="konfir_password" id="" class="form-control form-password" placeholder="Konfirmasi Password Baru" value="">
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input show-password" id="show-password">
                                    <label class="form-check-label" for="show-password">Lihat Password</label>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-sm btn-warning" name="btn-updatePassword">Update</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.card -->
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
        $('.show-password').click(function() {
            if ($(this).is(':checked')) {
                $('.form-password').attr('type', 'text');
            } else {
                $('.form-password').attr('type', 'password');
            }
        });
    });
</script>