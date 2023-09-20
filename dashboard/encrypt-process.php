<?php
session_start();
include '../koneksi.php';
include 'AES.php';

if (isset($_POST['btn-enkripsi'])) {
    $key           = mysqli_escape_string($conn, substr(md5($_POST["kata_kunci"]), 0, 16));
    $deskripsi = mysqli_escape_string($conn, $_POST['keterangan']);

    $file_tmpname   = $_FILES['file']['tmp_name'];
    //untuk nama file url
    $file           = rand(1000, 100000) . "-" . $_FILES['file']['name'];
    $new_file_name  = strtolower($file);
    $final_file     = str_replace(' ', '-', $new_file_name);
    //untuk nama file
    $filename       = rand(1000, 100000) . "-" . pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
    $new_filename  = strtolower($filename);
    $finalfile     = str_replace(' ', '-', $new_filename);
    $size           = filesize($file_tmpname);
    $size2          = (filesize($file_tmpname)) / 1024;
    $info           = pathinfo($final_file);
    $file_source        = fopen($file_tmpname, 'rb');
    $ext            = $info["extension"];

    if ($ext == "txt" || $ext == "docx" || $ext == "pptx" || $ext == "xlsx" || $ext == "pdf") {
    } else {
        echo ("<script language='javascript'>
        window.location.href='enkripsi.php';
        window.alert('Maaf, file yang bisa dienkrip hanya word, excel, text, ppt ataupun pdf.');
        </script>");
        exit();
    }

    if ($size2 > 3084) {
        $_SESSION['error']  = 'Maaf, file tidak bisa lebih besar dari 3MB.';
        header("location:enkripsi.php");
        exit();
    }

    $sql1   = "INSERT INTO file VALUES ('', '$final_file', '$finalfile.rda', '', '$size2', '$key', now(), '1', '$deskripsi')";
    $query1  = mysqli_query($conn, $sql1);

    $sql2   = "select * from file where file_url =''";
    $query2  = mysqli_query($conn, $sql2);

    $url   = $finalfile . ".rda";
    $file_url = "../hasil_enkripsi/$url";

    $sql3   = "UPDATE file SET file_url ='$file_url' WHERE file_url=''";
    $query3  = mysqli_query($conn, $sql3);

    $file_output        = fopen($file_url, 'wb');

    $mod    = $size % 16;
    if ($mod == 0) {
        $banyak = $size / 16;
    } else {
        $banyak = ($size - $mod) / 16;
        $banyak = $banyak + 1;
    }

    if (is_uploaded_file($file_tmpname)) {
        ini_set('max_execution_time', -1);
        ini_set('memory_limit', -1);
        $aes = new AES($key);

        for ($bawah = 0; $bawah < $banyak; $bawah++) {
            $data    = fread($file_source, 16);
            $cipher  = $aes->encrypt($data);
            fwrite($file_output, $cipher);
        }
        fclose($file_source);
        fclose($file_output);

        $_SESSION['sukses']  = 'File berhasil dienkripsikan';
        header("location:enkripsi.php");
    } else {
        $_SESSION['error']  = 'File mengalamai masalah';
        header("location:enkripsi.php");
    }
}
