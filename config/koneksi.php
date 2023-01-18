<?php
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $db = 'rumah_sakit';

    $conn = mysqli_connect($servername, $username, $password, $db);

    //cek koneksi
    if (mysqli_connect_errno()) {
        echo 'Koneksi Gagal'.mysqli_connect_error();
    }
    // echo 'Koneksi Berhasil';


?>