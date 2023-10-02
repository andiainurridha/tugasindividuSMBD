<?php
    $connect = mysqli_connect("localhost","root","","stokbarang");

    if (mysqli_connect_errno()) {
        echo "Gagal terhubung ke server: " . mysqli_connect_error();
        exit();
      }
?>