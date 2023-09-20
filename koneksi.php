<?php
$host = 'localhost'; //Host yang digunakan Localhost atau 127.0.0.1
$user = 'root'; //Username dari Host yakni root
$pass = ''; //User root tidak menggunakan password
$dbname = 'enkripsi_file'; //Nama Database Aplikasi Enkirpsi dan Dekripsi
$conn = mysqli_connect($host, $user, $pass, $dbname) or die(mysql_error()); //Mencoba terhubung apabila Host, User, dan Pass Benar. Kalau tidak MySQL memberikan Notif Error

// if ($conn) {
//     echo 'Data Berhasi Terhbung';
// }else{
//     echo 'Data gagal Terhbung';
// }
