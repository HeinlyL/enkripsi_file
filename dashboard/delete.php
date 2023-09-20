<?php
session_start();
include '../koneksi.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM file WHERE id_file='$id'") or die(mysql_error($conn));

$_SESSION['sukses'] = 'File berhasil dihapus';
header("location:index.php");
