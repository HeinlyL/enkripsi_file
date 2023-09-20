<?php
session_start();
include '../koneksi.php';
if (isset($_POST['btn-avatar'])) {
    $iduser = $_POST['id_user'];
    $gambar_lama = $_POST['gambar_lama'];

    $filename = $_FILES['gambar']['name'];
    $tmp_name = $_FILES['gambar']['tmp_name'];

    if ($filename !== '') {
        $type1 = explode('.', $filename);
        $type2 = $type1[1];

        $newname = 'avatar' . time() . '.' . $type2;

        $type_diizinkan = array('jpg', 'jpeg', 'png');

        if (!in_array($type2, $type_diizinkan)) {
            $_SESSION['error'] = 'Format file tidak diizinkan';
            header('location:profil.php');
        } else {
            unlink('../uploads/avatar/' . $gambar_lama);
            move_uploaded_file($tmp_name, '../uploads/avatar/' . $newname);
            $nama_gambar = $newname;
        }
    } else {
        $nama_gambar = $gambar_lama;
    }
    $update = mysqli_query($conn, "UPDATE users SET 
    avatar = '" . $nama_gambar . "' 
    WHERE id_user = '" . $iduser . "'
    ");

    if ($update) {
        $_SESSION['sukses'] = 'Foto profil berhsil diupdate';
        header('location:profil.php');
    } else {
        $_SESSION['error'] = 'Foto profil tidaK berhasil diupdate';
        header('location:profil.php?id_user=' . $iduser);
        exit();
    }
}


if (isset($_POST['btn-username'])) {
    $iduser = $_POST['id_user'];
    $username = $_POST['username'];
    $nama = $_POST['nama'];

    $update = mysqli_query($conn, "UPDATE users SET
    username = '" . $username . "',
    fullname = '" . ucwords($nama) . "'
    WHERE id_user = '" . $iduser . "'
    ");

    if ($update) {
        $_SESSION['sukses'] = 'Profil berhsil diupdate';
        header('location:profil.php');
    } else {
        $_SESSION['error'] = 'Profil tidaK berhasil diupdate';
        header('location:profil.php');
        exit();
    }
}







if (isset($_POST['btn-updatePassword'])) {
    $iduser = $_POST['id_user'];
    $password_baru = $_POST['password_baru'];
    $konfir_password = $_POST['konfir_password'];

    if ($konfir_password != $password_baru) {
        $_SESSION['error'] = 'Konfirmasi password baru tidak sesuai';
        header('location:profil.php');
    } else {
        $update_password = mysqli_query($conn, "UPDATE users SET
        password = '" . md5($password_baru) . "'
        WHERE id_user = '" . $iduser . "'
        ");

        if ($update_password) {
            $_SESSION['sukses'] = 'Profil berhsil diupdate';
            header('location:profil.php');
        } else {
            $_SESSION['error'] = 'Profil tidaK berhasil diupdate';
            header('location:profil.php');
            exit();
        }
    }
}
