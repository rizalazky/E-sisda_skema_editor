<?php
    $conn=mysqli_connect("localhost","root","","svnvbkdl_dbapemasi");
    
    if(!$conn){
        die('Koneksi Gagal'.mysqli_error($conn));
    }
