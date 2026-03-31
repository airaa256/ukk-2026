<?php
    include 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aspirasi - Selamat Datang</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;700&display=swap" rel="stylesheet">
</head>
<body> 
    <header>
        <div class="container">
            <h1><a href="index.php">aspirasi</a></h1>
            <ul>
                <li><a href="index.php">home</a></li>
                <li><a href="input-aspirasi.php">input aspirasi</a></li>
                <li><a href="aspirasi-siswa.php">aspirasi</a></li>
                <li><a href="login.php">login</a></li>
            </ul>
        </div>
    </header>

    <div class="section">
    <div class="container">
        
        <div class="hero">
            <h2>ASPIRASI</h2>
            <p>Suarakan pendapatmu untuk sekolah yang lebih baik.</p>
            <a href="input-aspirasi.php" class="btn-large">Sampaikan Aspirasi Sekarang →</a>
        </div>

        <div class="hero" >
            <h3>Cara Kerja</h3>
            <p>Langkah mudah untuk menyampaikan suara Anda:</p>

            <div class="flex-group">
                <div class="step">
                    <div class="circle">1</div>
                    <h4>Isi Form</h4>
                    <p>Masukkan NIS dan detail aspirasi kamu pada halaman input.</p>
                </div>
                <div class="step">
                    <div class="circle">2</div>
                    <h4>Peninjauan</h4>
                    <p>Pihak sekolah akan memverifikasi dan meninjau setiap pesan masuk.</p>
                </div>
                <div class="step">
                    <div class="circle">3</div>
                    <h4>Tindak Lanjut</h4>
                    <p>Perubahan atau solusi akan diterapkan berdasarkan masukanmu.</p>
                </div>
            </div>

            <div style="background: var(--bg-light); padding: 25px; border-radius: var(--radius); margin-top: 40px;">
                <h4>Siap membuat perubahan?</h4>
                <p>Suara kamu adalah langkah awal menuju sekolah yang lebih baik.</p>
                <a href="input-aspirasi.php" class="btn">Mulai Tulis Aspirasi</a>
            </div>
        </div>

    </div>
</div>

    <footer>
        <div class="container">
            <small>Copyright &copy; 2026 - adelia samaira</small>
        </div>
    </footer>
</body>
</html>