<?php

    include 'db.php';

    if(isset($_GET['pelaporan'])){
        $delete = mysqli_query($conn, "DELETE FROM input_aspirasi WHERE id_pelaporan = '".$_GET['pelaporan']."' ");
        echo '<script>window.location="pelaporan.php"</script>';
    }

    if(isset($_GET['aspirasi'])){
        $delete = mysqli_query($conn, "DELETE FROM aspirasi WHERE id_aspirasi = '".$_GET['aspirasi']."' ");
        echo '<script>window.location="aspirasi.php"</script>';
    }

    if(isset($_GET['siswa'])){
        $delete = mysqli_query($conn, "DELETE FROM siswa WHERE nis = '".$_GET['siswa']."' ");
        echo '<script>window.location="siswa.php"</script>';
    }

    if(isset($_GET['kategori'])){
        $delete = mysqli_query($conn, "DELETE FROM kategori WHERE id_kategori = '".$_GET['kategori']."' ");
        echo '<script>window.location="kategori.php"</script>';
    }

?>