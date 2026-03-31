<?php
    session_start();
    include 'db.php';
    if($_SESSION['status_login'] != true){
        echo '<script>window.location="login.php"</script>';
    }

    $query = mysqli_query($conn, "SELECT * FROM admin WHERE id_admin = '".$_SESSION['id']."' ");
    $d = mysqli_fetch_object($query);
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
            <h3>profil</h3>
            <div class="box">
            <form action="" method="POST">
                <input type="text" name="user" placeholder="usename" class="input-control" value="<?php echo $d->username ?>" required>
                <input type="submit" name="submit" value="ubah profil" class="btn">
            </form>
            <?php
                if(isset($_POST['submit'])){

                    $user       = $_POST['user'];

                    $update     = mysqli_query($conn, "UPDATE admin SET
                                        username = '".$user."'
                                        WHERE id_admin = '".$d->id_admin."' ");
                    if($update){
                        echo 'berhasil' ;
                    echo '<script>alert("ubah berhasil")</script>';
                    echo '<script>window.location="profil.php</script>';
                    }else{
                        echo 'gagal' .mysqli_error($conn);
                    }
                }
            ?>  
            </div>  

            <h3>ubah password</h3>
            <div class="box">
                <form action="" method="POST">
                <input type="password" name="pass1" placeholder="password baru" class="input-control" required>
                <input type="password" name="pass2" placeholder="confirm password baru" class="input-control" required>
                <input type="submit" name="ubah_password" value="ubah password" class="btn">
                </form>
                <?php
                if(isset($_POST['ubah_password'])){
                        $pass1  = $_POST['pass1'];
                        $pass2  = $_POST['pass2'];

                        if($pass2 != $pass1){
                            echo '<script>alert("Konfirmasi password baru tidak sesuai")</script>';
                        }else{
                            $u_pass = mysqli_query($conn, "UPDATE admin SET
                                        password = '".MD5($pass1)."' 
                                        WHERE id_admin = '".$d->id_admin."' ");
                            if($u_pass){
                                echo '<script>alert("Ubah password berhasil")</script>';
                                echo '<script>window.location="profil.php"</script>';
                            }else{
                                echo 'gagal ' . mysqli_error($conn);
                            }
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
</body>
</html>
