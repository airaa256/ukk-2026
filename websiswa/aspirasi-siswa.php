<?php
    include 'db.php';

    // --- NIS FILTER LOGIC ---
    $where = " WHERE 1=1 "; 
    if(!empty($_GET['search_nis'])){
        $nis = mysqli_real_escape_string($conn, $_GET['search_nis']);
        $where .= " AND input_aspirasi.nis = '$nis' ";
    }

    $ida = mysqli_query($conn, "SELECT * FROM aspirasi 
        LEFT JOIN input_aspirasi USING (id_pelaporan) 
        $where ORDER BY id_aspirasi DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - Aspirasi</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;700&display=swap" rel="stylesheet">
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
            <h3>Monitoring Aspirasi</h3>
            
            <div class="box">
                <form action="" method="GET" class="filter-form">
                    <div class="filter-inputs-wrapper">
                        <div class="filter-group">
                            <label>Cek Status via NIS</label>
                            <input type="number" name="search_nis" placeholder="Masukkan NIS Anda..." value="<?php echo @$_GET['search_nis'] ?>" style="max-width: 200px;">
                        </div>
                    </div>
                    <div class="filter-actions-wrapper">
                        <button type="submit" class="btn-filter">Cari</button>
                        <a href="index.php" class="btn-reset">Reset</a>
                    </div>
                </form>
            </div>

            <div class="box" style="padding: 15px;">
                <div class="table-responsive">
                    <table border="0" cellspacing="0" class="table" style="width: 100%; table-layout: fixed;">
                        <thead>
                            <tr>
                                <th style="width: 60px;">ID</th>
                                <th style="width: 130px;">Tanggal</th>
                                <th style="width: 100px;">NIS</th>
                                <th style="width: 130px;">Status</th>
                                <th>Feedback Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(mysqli_num_rows($ida) > 0){
                                    while ($row = mysqli_fetch_array($ida)) {
                            ?>
                            <tr>
                                <td align="center"><strong><?php echo $row['id_aspirasi'] ?></strong></td>
                                <td align="center"><?php echo date('d/m/Y', strtotime($row['tanggal_input'])) ?></td>
                                <td align="center"><?php echo $row['nis'] ?></td>
                                <td align="center">
                                    <span class="status-badge status-<?php echo $row['status'] ?>">
                                        <?php echo strtoupper($row['status']) ?>
                                    </span>
                                </td>
                                <td style="text-align:left; word-wrap:break-word; white-space:normal;">
                                    <?php echo !empty($row['feedback']) ? $row['feedback'] : '<i>Belum ada feedback</i>'; ?>
                                </td>
                            </tr>
                            <?php }} else { ?>
                            <tr>
                                <td colspan="5" align="center" style="padding: 30px;">Data tidak ditemukan.</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
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