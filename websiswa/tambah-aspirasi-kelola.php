<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }

    $aspirasi = mysqli_query($conn, "SELECT * FROM aspirasi WHERE id_aspirasi = '".$_SESSION['id']."' ");
    $a = mysqli_fetch_object($aspirasi);

    $pelaporan = mysqli_query($conn, "SELECT * FROM input_aspirasi WHERE id_pelaporan = '".$_GET['id']."' ");
    if(mysqli_num_rows($pelaporan) == 0){
        echo '<script>window.location="surat-keluar.php"</script>';
    }
    $p = mysqli_fetch_object($pelaporan);

    $status = $a->status ?? '';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width, initial-scale=1">
    <title>aspirasi</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container">
            <h1><a href="dashboard.php">aspirasi</a></h1>
            <ul>
                <li><a href="dashboard.php">dashboard</a></li>
                <li><a href="profil.php">profil</a></li>
                <li><a href="pelaporan.php">pelaporan</a></li>
                <li><a href="aspirasi.php">aspirasi</a></li>
                <li><a href="siswa.php">siswa</a></li>
                <li><a href="kategori.php">kategori</a></li>
                <li><a href="keluar.php">keluar</a></li>
            </ul>
        </div>
    </header>

    <div class="section">
        <div class="container">
            <h3>tambah aspirasi</h3>
            <div class="box">
            <form action="" method="POST" enctype="multipart/form-data">         
                <input type="text" class="input-control" value="Id : <?php echo $p->id_pelaporan ?> | nis : <?php echo $p->nis ?>" readonly>
                <input type="text" class="input-control" value="Keterangan : <?php echo $p->id_pelaporan ?>" readonly>
                <input type="hidden" name="pelaporan" value="<?php echo $p->id_pelaporan ?>">
                <select class="input-control" name="status" required>
                    <option value="">-- Pilih Status --</option>
                    <option value="menunggu" <?= $status == 'menunggu' ? 'selected' : '' ?>>menunggu</option>
                    <option value="proses"   <?= $status == 'proses'   ? 'selected' : '' ?>>proses</option>
                    <option value="selesai"  <?= $status == 'selesai'  ? 'selected' : '' ?>>selesai</option>
                </select>  
                <input type="text" name="feedback" class="input-control" placeholder="feedback" required>
                <input type="submit" name="submit" value="submit" class="btn">
            </form> 
                <?php
                if(isset($_POST['submit'])){
                    $status       = $_POST['status'];        
                    $pelaporan  = $_POST['pelaporan'];
                    $feedback   = $_POST['feedback'];
                    $tanggal     = date('Y-m-d');

                    $insert = mysqli_query($conn, "INSERT INTO aspirasi VALUES (                     
                                        null,
                                        '".$status."',
                                        '".$pelaporan."',
                                        '".$feedback."',
                                        '".$tanggal."'
                                    )");
                    
                    if($insert){
                        echo '<script>alert("Tambah aspirasi berhasil")</script>';
                        echo '<script>window.location="aspirasi.php"</script>';
                    } else {
                        echo 'Gagal '.mysqli_error($conn);
                    }
                }
            ?>
            </div>  
        </div>
    </div>

    <footer>
        <div class="container">
            <small>Copyright &copy; 2026 - adelia samaira.</small>
        </div>
    </footer>
    <script>
        CKEDITOR.replace( 'deskripsi');
    </script>
</body>
</html>