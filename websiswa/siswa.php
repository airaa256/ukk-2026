<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }
    
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
            <h3>siswa</h3>

            <div class="box">
                <form action="" method="POST" class="filter-form">
                    <div class="filter-inputs-wrapper">
                        <div class="filter-group">
                            <label>Tambah Siswa</label>
                            <div class="filter-inputs">
                                <input type="number" name="nis" placeholder="Masukkan nis" required>
                                <input type="text" name="kelas" placeholder="Masukkan Kelas" required>
                                <input type="submit" name="submit" value="submit" class="btn-filter">
                            </div>
                        </div>
                    </div>
                </form> 
                <?php
                if(isset($_POST['submit'])){
                    $nis       = $_POST['nis'];
                    $kelas     = $_POST['kelas'];       

                    $check = mysqli_query($conn, "SELECT nis FROM siswa WHERE nis = '$nis'");
                    if(mysqli_num_rows($check) > 0){
                        echo '<script>alert("nis sudah ada")</script>';
                    } else {
                        $insert = mysqli_query($conn, "INSERT INTO siswa (nis, kelas) VALUES ('$nis', '$kelas')");
                        if($insert){
                            echo '<script>alert("Tambah siswa berhasil")</script>';
                            echo '<script>window.location="siswa.php"</script>';
                            exit;
                        } else {
                            echo 'Gagal '.mysqli_error($conn);
                        }
                    }
                }
            ?>
            </div>

            <div class="box">
                <table border="0" cellspacing="0" class="table" >
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>nis</th>
                            <th>kelas</th>
                            <th width="150px">aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            $siswa = mysqli_query($conn, "SELECT * FROM siswa ORDER BY nis DESC");
                            if(mysqli_num_rows($siswa) > 0){
                            while($row = mysqli_fetch_array($siswa)){
                        ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['nis'] ?></td>
                            <td><?php echo $row['kelas'] ?></td>
                            <td>
                                <div class="btn-container">
                                <!-- <a href="edit-siswa.php?id=<?php echo $row['nis'] ?>">edit</a> -->
                                <a href="edit-siswa.php?id=<?php echo $row['nis'] ?>" class="edit">edit</a><a href="proses-hapus.php?siswa=<?php echo $row['nis'] ?>" class="hapus" onclick="return confirm ('are you sure ?')">hapus</a>
                                </div>
                            </td>
                        </tr>
                        <?php }}else{ ?>
                            <tr>
                                <td colspan="6" >tidak ada data</td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>
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