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
            <h3>kategori</h3>

            <div class="box">
                <form action="" method="POST" class="filter-form">
                    <div class="filter-inputs-wrapper">
                        <div class="filter-group">
                            <label>Tambah kategori</label>
                            <div class="filter-inputs">
                                <input type="text" name="kategori" placeholder="keterangan kategori" required>
                                <input type="submit" name="submit" value="submit" class="btn-filter">
                            </div>
                        </div>
                    </div>
                </form> 
                <?php
                if(isset($_POST['submit'])){
                    $kategori       = $_POST['kategori'];        

                    $insert = mysqli_query($conn, "INSERT INTO kategori VALUES (                     
                                        null,
                                        '".$kategori."'
                                    )");
                    
                    if($insert){
                        echo '<script>alert("Tambah kategori berhasil")</script>';
                        echo '<script>window.location="kategori.php"</script>';
                    } else {
                        echo 'Gagal '.mysqli_error($conn);
                    }
                }
            ?>
            </div>

            <div class="box">
                <table border="0" cellspacing="0" class="table" >
                    <thead>
                        <tr>
                            <th width="60px">Id</th>
                            <th>keterangan</th>
                            <th width="150px">aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $no = 1;
                            $kategori = mysqli_query($conn, "SELECT * FROM kategori ORDER BY id_kategori DESC");
                            if(mysqli_num_rows($kategori) > 0){
                            while($row = mysqli_fetch_array($kategori)){
                        ?>
                        <tr>
                            <td><?php echo $row['id_kategori'] ?></td>
                            <td><?php echo $row['ket_kategori'] ?></td>
                            <td>
                                <div class="btn-container">
                                <a href="edit-kategori.php?id=<?php echo $row['id_kategori'] ?>" class="edit">edit</a><a href="proses-hapus.php?kategori=<?php echo $row['id_kategori'] ?>" class="hapus" onclick="return confirm ('are you sure ?')">hapus</a>
                                </div>
                            </td>
                        </tr>
                        <?php }}else{ ?>
                            <tr>
                                <td colspan="3" >tidak ada data</td>
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