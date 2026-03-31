<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }

    $count_pelaporan = mysqli_query($conn, "SELECT id_pelaporan FROM input_aspirasi");
    $total_pelaporan = mysqli_num_rows($count_pelaporan);

    $count_kategori = mysqli_query($conn, "SELECT id_kategori FROM kategori");
    $total_kategori = mysqli_num_rows($count_kategori);

    $count_aspirasi = mysqli_query($conn, "SELECT id_aspirasi FROM aspirasi");
    $total_aspirasi = mysqli_num_rows($count_aspirasi);

    $count_siswa = mysqli_query($conn, "SELECT nis FROM siswa");
    $total_siswa = mysqli_num_rows($count_siswa);
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
            <h3>dashboard</h3>
            <div class="section">
    <div class="container">
        <div class="box dashboard-wrapper">
            <div class="card">
                    <div class="card-icon color-1">📩</div>
                    <h4>jumlah pelaporan</h4>
                    <p><?php echo $total_pelaporan; ?></p>
                    <a href="pelaporan.php" class="card-btn">Lihat Detail</a>
                </div>

                <div class="card">
                    <div class="card-icon color-2">📤</div>
                    <h4>jumlah kategori</h4>
                    <p><?php echo $total_kategori; ?></p>
                    <a href="kategori.php" class="card-btn">Lihat Detail</a>
                </div>

                <div class="card">
                    <div class="card-icon color-3">📝</div>
                    <h4>jumlah aspirasi</h4>
                    <p><?php echo $total_aspirasi; ?></p>
                    <a href="aspirasi.php" class="card-btn">Lihat Detail</a>
                </div>

                <div class="card">
                    <div class="card-icon color-3">📝</div>
                    <h4>jumlah siswa</h4>
                    <p><?php echo $total_siswa; ?></p>
                    <a href="siswa.php" class="card-btn">Lihat Detail</a>
                </div>

        </div>
    </div>
</div>
        </div>
    </div>

    <footer>
        <div class="container">
            <small>Copyright &copy; 2026 - adelia samaira.</small>
        </div>
    </footer>
</body>
</html>