<?php
session_start();
include 'koneksi.php';

// $error = '';
if (isset($_POST['btn-login'])) {
    if (empty($_POST['username']) || empty($_POST['password'])) {
        // echo "<script language=\"JavaScript\">\n";
        // echo "alert('Username or Password Tidak Valid!');\n";
        // echo "window.location='login.php'";
        // echo "</script>";
        // $error = "Username or Password Tidak Valid!";
        $_SESSION['error'] = 'Username atau password tidak benar';
        header('location:index.php');
    } else {

        $user = mysqli_real_escape_string($conn, $_POST['username']);
        $pass = mysqli_real_escape_string($conn, $_POST['password']);

        $query = "SELECT username,password,id_user FROM users WHERE username='$user' AND password=md5('$pass')";
        $sql = mysqli_query($conn, $query);
        $rows = mysqli_fetch_array($sql);
        if ($rows) {
            $_SESSION['username'] = $user;
            $_SESSION['id_user'] = $rows['id_user'];
            header("location: dashboard/");
        } else {
            // echo "<script language=\"JavaScript\">\n";
            // echo "alert('Username atau Password Salah!');\n";
            // echo "window.location='./'";
            // echo "</script>";
            $_SESSION['error'] = 'Username atau password salah';
            header('location:index.php');
        }
    }
}
